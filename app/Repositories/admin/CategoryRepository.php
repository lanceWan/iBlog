<?php
namespace App\Repositories\admin;
use App\Models\Category;
use Cache;
use Flash;
class CategoryRepository
{
	/**
	 * 获取分类数据
	 * @author 晚黎
	 * @date   2016-04-20T17:10:54+0800
	 * @return [type]                   [description]
	 */
	public function index()
	{
		if (Cache::has(config('admin.global.cache.category'))) {
			return Cache::get(config('admin.global.cache.category'));
		}
		$cateList = $this->setCateListCache();
		return $cateList;
	}
	/**
	 * 递归迭代分类关系
	 * @date   2016-05-05
	 * @author 晚黎
	 * @param  [type]     $categories [description]
	 * @param  integer    $pid        [description]
	 * @return [type]                 [description]
	 */
	private function sortCategory($categories,$pid = 0){
		$arr = [];
		foreach($categories as $k =>  $v){
			if($v['pid'] == $pid){
	            $arr[$k] = $v;
	            $arr[$k]['child'] = self::sortCategory($categories,$v['id']);
	        }
	    }
		return $arr;
	}
	/**
	 * 缓存分类数据
	 * @date   2016-05-05
	 * @author 晚黎
	 */
	public function setCateListCache()
	{
		$categories = Category::orderBy('sort','desc')
					->orderBy('id','asc')
					->get()
					->toArray();
		
		if ($categories) {
			$cateList = $this->sortCategory($categories);
			//子分类进行排序
			foreach ($cateList as &$v) {
	    		if ($v['child']) {
	    			$sort = array_column($v['child'],'sort');
	    			arsort($sort);
	    			array_multisort($sort,SORT_DESC,$v['child']);
	    		}
	    	}
			Cache::forever(config('admin.global.cache.category'), $cateList);
			return $cateList;
		}
		return [];
	}
	/**
	 * 获取分类数据
	 * @date   2016-05-05
	 * @author 晚黎
	 * @param  [type]     $id [description]
	 * @return [type]         [description]
	 */
	public function edit($id)
	{
		$cate = Category::find($id)->toArray();
		if ($cate) {
			$cate['update'] = url('admin/cate/'.$id);
    		$cate['msg'] = trans('alerts.categories.laod_success');
			return $cate;
		}
		abort(404);
	}
	/**
	 * 修改分类数据
	 * @date   2016-05-05
	 * @author 晚黎
	 * @param  [type]     $request [description]
	 * @param  [type]     $id      [description]
	 * @return [type]              [description]
	 */
	public function update($request,$id)
	{
		$category = Category::find($id);
		if ($category) {
			$pid = $category->pid;
			$sort = $category->sort;
			$isUpdate = $category->fill($request->all())->save();
			if ($isUpdate) {
				$this->clearCache();
				Flash::success(trans('alerts.categories.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.categories.updated_error'));
			return false;
		}
		abort(404);
	}
	/**
	 * 添加分类
	 * @date   2016-05-05
	 * @author 晚黎
	 * @param  [type]     $request [description]
	 * @return [type]              [description]
	 */
	public function store($request)
	{
		$categories = new Category;
		if ($categories->fill($request->all())->save()) {
			// 分类发生变化，更新分类数组
			$this->clearCache();
			Flash::success(trans('alerts.categories.created_success'));
			return true;
		}
		Flash::error(trans('alerts.categories.created_error'));
		return false;
	}

	/**
	 * 分类排序
	 * @author 晚黎
	 * @date   2016-04-20T15:43:19+0800
	 * @return [type]                   [description]
	 */
	public function sort()
	{
		$currentItemId = request('currentItemId',0);
		$itemParentId = request('itemParentId',0);

		if (!$currentItemId) {
			return ['status' => false,'msg' => trans('alerts.categories.currentItem_error')];
		}
		$category = Category::find($currentItemId);
		if ($category) {
			$category->pid = $itemParentId;
			if ($category->save()) {
				//更新分类缓存数据
				$this->clearCache();
				return ['status' => true,'msg' => trans('alerts.categories.updated_success')];
			}
			return ['status' => false,'msg' => trans('alerts.categories.updated_error')];
		}
		abort(404);
	}
	/**
	 * 删除分类
	 * @date   2016-05-05
	 * @author 晚黎
	 * @param  [type]     $id [description]
	 * @return [type]         [description]
	 */
	public function destroy($id)
	{
		$isDestroy = Category::destroy($id);
		if ($isDestroy) {
			//更新缓存数据
			$this->clearCache();
			Flash::success(trans('alerts.categories.deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.categories.deleted_error'));
		return false;
	}
	/**
	 * 更新缓存
	 * @author 晚黎
	 * @date   2016-05-13T15:45:53+0800
	 * @return [type]                   [description]
	 */
	private function clearCache()
	{
		//更新缓存数据
		$this->setCateListCache();
		Cache::forget(config('admin.global.cache.front'));
		Cache::forget(config('admin.global.cache.article_cate'));
	}
}