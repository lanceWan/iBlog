<?php
namespace App\Repositories\front;
use App\Models\Category;
use Cache;
class FrontRepository
{
	/**
	 * 获取分类数据
	 * @author 晚黎
	 * @date   2016-04-20T17:10:54+0800
	 * @return [type]                   [description]
	 */
	public function getCategories()
	{
		//判断是否缓存menu数据
		if (Cache::has('frontMenu')) {
			return Cache::get('frontMenu');
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
		$categories = Category::where('status',config('admin.global.status.active'))
					->orderBy('sort','desc')
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
			//缓存数据
			Cache::forever('frontMenu', $cateList);
			return $cateList;
		}
		return [];
	}
	
}