<?php
namespace App\Repositories\admin;
use App\Models\Article;
use App\Models\Tag;
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
		$article = new Article;
		$data = $request->all();
		//是否上传了文章封面
		if ($request->hasFile('img')) {
			$data['img'] = $this->uploadImage($request->file('img'));
		}
		$data['content_html'] = $data['editor-html-code'];
		$data['content_mark'] = $data['editor-markdown-doc'];
		if ($article->fill($data)->save()) {
			//新增标签
			if ($data['new_tag']) {
				$tags = explode(',', $data['new_tag']);
				$ids = [];
				foreach ($tags as $v) {
					$tag = Tag::firstOrCreate([
						'name' => $v
						]);
					$ids[] = $tag->id;
				}
				$article->tag()->sync($ids);
			}
			//已选择标签
			if (isset($data['tag']) && !empty($data['tag'])) {
				$article->tag()->sync($data['tag']);
			}
			Flash::success(trans('alerts.articles.created_success'));
			return true;
		}
		Flash::error(trans('alerts.articles.created_error'));
		return false;
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
		$article = Article::with('tag')->find($id);
		if ($article) {
			if ($article->tag) {
				$tagIds = array_column($article->tag->toArray(), 'id');
				$article->tag = $tagIds;
			}
			return $article;
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
		$article = Article::find($id);
		if ($article) {
			if ($article->fill($request->all())->save()) {
				Flash::success(trans('alerts.articles.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.articles.updated_error'));
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
		$article = Article::find($id);
		if ($article) {
			$article->status = $status;
			if ($article->save()) {
				Flash::success(trans('alerts.articles.updated_success'));
				return true;
			}
			Flash::error(trans('alerts.articles.updated_error'));
			return false;
		}
		abort(404);
	}

	public function destroy($id)
	{
		$isDelete = Article::destroy($id);
		if ($isDelete) {
			Flash::success(trans('alerts.articles.deleted_success'));
			return true;
		}
		Flash::error(trans('alerts.articles.deleted_error'));
		return false;
	}

	/**
	 * 上传图片到七牛
	 * @author 晚黎
	 * @date   2016-05-07T11:05:27+0800
	 * @param  [type]                   $request [description]
	 * @return [type]                            [description]
	 */
	private function uploadImage($file)
	{
		$disk = QiniuStorage::disk('qiniu');
		$fileName = md5($file->getClientOriginalName().time().rand()).'.'.$file->getClientOriginalExtension();
		$bool = $disk->put(config('admin.global.imagePath').$fileName,file_get_contents($file->getRealPath()));
		if ($bool) {
			$path = $disk->downloadUrl(config('admin.global.imagePath').$fileName);
			return $path;
		}
		return '';
	}
}