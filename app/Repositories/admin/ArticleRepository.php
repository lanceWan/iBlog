<?php
namespace App\Repositories\admin;
use App\Models\Article;
use Carbon\Carbon;
use Flash;
use zgldh\QiniuStorage\QiniuStorage;
/**
* 文章仓库
*/
class ArticleRepository
{
	/**
	 * datatable获取数据
	 * @date   2016-05-06
	 * @author 晚黎
	 * @return [type]     [description]
	 */
	public function ajaxIndex()
	{
		$draw = request('draw', 1);/*获取请求次数*/
		$start = request('start', config('admin.golbal.list.start')); /*获取开始*/
		$length = request('length', config('admin.golbal.list.length')); ///*获取条数*/

		$search_pattern = request('search.regex', true); /*是否启用模糊搜索*/
		
		$title = request('title' ,'');
		$intro = request('intro' ,'');
		$status = request('status' ,'');
		$created_at_from = request('created_at_from' ,'');
		$created_at_to = request('created_at_to' ,'');
		$updated_at_from = request('updated_at_from' ,'');
		$updated_at_to = request('updated_at_to' ,'');
		$orders = request('order', []);

		$article = new Article;

		/*文章名称搜索*/
		if($title){
			if($search_pattern){
				$article = $article->where('title', 'like', $title);
			}else{
				$article = $article->where('title', $title);
			}
		}

		/*文章搜索*/
		if($intro){
			if($search_pattern){
				$article = $article->where('intro', 'like', $intro);
			}else{
				$article = $article->where('intro', $intro);
			}
		}
		
		/*状态搜索*/
		if ($status) {
			$article = $article->where('status', $status);
		}

		/*文章创建时间搜索*/
		if($created_at_from){
			$article = $article->where('created_at', '>=', getTime($created_at_from));	
		}
		if($created_at_to){
			$article = $article->where('created_at', '<=', getTime($created_at_to, false));	
		}

		/*文章修改时间搜索*/
		if($updated_at_from){
			$uafc = new Carbon($updated_at_from);
			$article = $article->where('created_at', '>=', getTime($updated_at_from));	
		}
		if($updated_at_to){
			$article = $article->where('created_at', '<=', getTime($updated_at_to, false));	
		}

		$count = $article->count();


		if($orders){
			$orderName = request('columns.' . request('order.0.column') . '.name');
			$orderDir = request('order.0.dir');
			$article = $article->orderBy($orderName, $orderDir);
		}

		$article = $article->offset($start)->limit($length);
		$articles = $article->get();

		if ($articles) {
			foreach ($articles as &$v) {
				$v['actionButton'] = $v->getActionButtonAttribute();
			}
		}
		return [
			'draw' => $draw,
			'recordsTotal' => $count,
			'recordsFiltered' => $count,
			'data' => $articles,
		];
	}

	/**
	 * 添加文章
	 * @date   2016-05-06
	 * @author 晚黎
	 * @param  [type]     $request [description]
	 * @return [type]              [description]
	 */
	public function store($request)
	{
		// $permission = new Article;
		// $data = $request->all();
		//是否上传了文章封面
		if ($request->hasFile('img')) {
			// echo "123444";exit();
			$disk = QiniuStorage::disk('qiniu');
			$file = $request->file('img');

			dd($file);
			$bool = $disk->put($file->getClientOriginalName(),'ivv');
			dd($bool);
		}
		echo "没有文件";exit();
		// $data['content_html'] = $request->editor-html-code;
		// $data['content_mark'] = $request->editor-markdown-doc;
		// $data['intro'] = '';
		// if ($permission->fill($request->all())->save()) {
		// 	Flash::success(trans('alerts.permissions.created_success'));
		// 	return true;
		// }
		// Flash::error(trans('alerts.permissions.created_error'));
		// return false;
	}
	/**
	 * 修改视图
	 * @author 晚黎
	 * @date   2016-04-12T16:48:46+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function edit($id)
	{
		$permission = Permission::find($id);
		if ($permission) {
			return $permission;
		}
		abort(404);
	}
	/**
	 * 修改文章
	 * @author 晚黎
	 * @date   2016-04-12T17:24:53+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	public function update($request,$id)
	{
		$permission = Permission::find($id);
		if ($permission) {
			if ($permission->fill($request->all())->save()) {
				Flash::success(trans('alerts.permissions.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.permissions.updated_error'));
			return false;
		}
		abort(404);
	}

	/**
	 * 修改文章状态
	 * @author 晚黎
	 * @date   2016-04-13T09:35:34+0800
	 * @param  [type]                   $id     [description]
	 * @param  [type]                   $status [description]
	 * @return [type]                           [description]
	 */
	public function mark($id,$status)
	{
		$permission = Permission::find($id);
		if ($permission) {
			$permission->status = $status;
			if ($permission->save()) {
				Flash::success(trans('alerts.permissions.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.permissions.updated_error'));
			return false;
		}
		abort(404);
	}

	public function destroy($id)
	{
		$isDelete = Permission::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.permissions.deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.permissions.deleted_error'));
		return false;
	}

	/**
	 * 获取所有文章并分组
	 * @author 晚黎
	 * @date   2016-04-13T13:30:34+0800
	 * @return [type]                   [description]
	 */
	public function findPermissionWithArray()
	{
		$permission = Permission::where('status',config('admin.global.status.active'))->get();
		$array = [];
		if ($permission) {
			foreach ($permission as $v) {
				array_set($array, $v->slug, ['id' => $v->id,'name' => $v->name,'desc' => $v->description,'key' => str_random(10)]);
			}
		}
		return $array;
	}
}