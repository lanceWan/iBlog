<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use ArticleRepository;
use TagRepository;

class ArticleController extends Controller
{
    public function index()
    {
    	return view('admin.article.list');
    }

    public function ajaxIndex()
    {
    	$data = ArticleRepository::ajaxIndex();
    	return response()->json($data);
    }
    /**
     * 添加权限视图
     * @author 晚黎
     * @date   2016-04-12T09:56:23+0800
     * @return [type]                   [description]
     */
    public function create()
    {
        $tags = TagRepository::findAllTag();
    	return view('admin.article.create')->with(compact('tags'));
    }

    /**
     * 添加文章
     * @date   2016-05-06
     * @author 晚黎
     * @param  ArticleRequest $request [description]
     * @return [type]                     [description]
     */
    public function store(ArticleRequest $request)
    {
    	ArticleRepository::store($request);
    	return redirect('admin/article');
    }

    /**
     * 修改文章视图
     * @author 晚黎
     * @date   2016-05-08T11:00:11+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function edit($id)
    {
        $tags = TagRepository::findAllTag();
    	$article = ArticleRepository::edit($id);
    	return view('admin.article.edit')->with(compact(['article','tags']));
    }
    /**
     * 修改文章
     * @author 晚黎
     * @date   2016-05-08T11:00:37+0800
     * @param  ArticleRequest           $request [description]
     * @param  [type]                   $id      [description]
     * @return [type]                            [description]
     */
    public function update(ArticleRequest $request,$id)
    {
    	ArticleRepository::update($request,$id);
    	return redirect('admin/article');
    }

    /**
     * 修改文章状态
     * @author 晚黎
     * @date   2016-05-08T11:00:53+0800
     * @param  [type]                   $id     [description]
     * @param  [type]                   $status [description]
     * @return [type]                           [description]
     */
    public function mark($id,$status)
    {
    	ArticleRepository::mark($id,$status);
        return redirect('admin/article');
    }

    /**
     * 删除文章
     * @author 晚黎
     * @date   2016-05-08T11:01:06+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function destroy($id)
    {
        ArticleRepository::destroy($id);
        return redirect('admin/article');
    }
}
