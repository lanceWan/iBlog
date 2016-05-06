<?php
namespace App\Repositories\admin;
use App\Models\Tag;
// use App\Models\ArticleTag;
use Carbon\Carbon;
use Flash;
/**
* 用户仓库
*/
class TagRepository
{
	/**
	 * datatable获取数据
	 * @author 晚黎
	 * @date   2016-04-13T21:14:37+0800
	 * @return [type]                   [description]
	 */
	public function ajaxIndex()
	{
		$draw = request('draw', 1);/*获取请求次数*/
		$start = request('start', config('admin.golbal.list.start')); /*获取开始*/
		$length = request('length', config('admin.golbal.list.length')); ///*获取条数*/

		$search_pattern = request('search.regex', true); /*是否启用模糊搜索*/
		
		$name = request('name' ,'');
		$created_at_from = request('created_at_from' ,'');
		$created_at_to = request('created_at_to' ,'');
		$updated_at_from = request('updated_at_from' ,'');
		$updated_at_to = request('updated_at_to' ,'');
		$orders = request('order', []);

		$tag = new Tag;

		/*标签名称搜索*/
		if($name){
			if($search_pattern){
				$tag = $tag->where('name', 'like', $name);
			}else{
				$tag = $tag->where('name', $name);
			}
		}

		/*标签创建时间搜索*/
		if($created_at_from){
			$tag = $tag->where('created_at', '>=', getTime($created_at_from));	
		}
		if($created_at_to){
			$tag = $tag->where('created_at', '<=', getTime($created_at_to, false));	
		}

		/*标签修改时间搜索*/
		if($updated_at_from){
			$uafc = new Carbon($updated_at_from);
			$tag = $tag->where('created_at', '>=', getTime($updated_at_from));	
		}
		if($updated_at_to){
			$tag = $tag->where('created_at', '<=', getTime($updated_at_to, false));	
		}

		$count = $tag->count();


		if($orders){
			$orderName = request('columns.' . request('order.0.column') . '.name');
			$orderDir = request('order.0.dir');
			$tag = $tag->orderBy($orderName, $orderDir);
		}

		$tag = $tag->offset($start)->limit($length);
		$tags = $tag->get();

		if ($tags) {
			foreach ($tags as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute(false);
			}
		}
		
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $tags,
		];
	}

	/**
	 * 添加标签
	 * @date   2016-05-06
	 * @author 晚黎
	 * @param  [type]     $request [description]
	 * @return [type]              [description]
	 */
	public function store($request)
	{
		$tag = new Tag;

		if ($tag->fill($request->all())->save()) {
			Flash::success(trans('alerts.tags.created_success'));
			return true;
		}
		Flash::error(trans('alerts.tags.created_error'));
		return false;
	}
	/**
	 * 修改标签
	 * @date   2016-05-06
	 * @author 晚黎
	 * @param  [type]     $id [description]
	 * @return [type]         [description]
	 */
	public function edit($id)
	{
		$tag = Tag::find($id);
		if ($tag) {
			return $tag;
		}
		abort(404);
	}
	/**
	 * 修改标签信息
	 * @date   2016-05-06
	 * @author 晚黎
	 * @param  [type]     $request [description]
	 * @param  [type]     $id      [description]
	 * @return [type]              [description]
	 */
	public function update($request,$id)
	{
		$tag = Tag::find($id);
		if ($tag) {
			if ($tag->fill($request->all())->save()) {
				Flash::success(trans('alerts.tags.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.tags.updated_error'));
			return false;
		}
		abort(404);
	}


	/**
	 * 删除标签
	 * @date   2016-05-06
	 * @author 晚黎
	 * @param  [type]     $id [description]
	 * @return [type]         [description]
	 */
	public function destroy($id)
	{
		$isDelete = Tag::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.tags.deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.tags.deleted_error'));
		return false;
	}

	/**
	 * 查出所有的标签
	 * @date   2016-05-06
	 * @author 晚黎
	 * @return [type]     [description]
	 */
	public function findAllTag()
	{
		return Tag::all();
	}
}