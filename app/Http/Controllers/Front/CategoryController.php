<?php
namespace App\Http\Controllers\Front;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use FrontRepository;
class CategoryController extends Controller
{
	/**
	 * 显示分类下面的文章
	 * @author 晚黎
	 * @date   2016-05-18T17:21:03+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
    public function show($id)
    {
    	$articles = FrontRepository::getArticlesByCategory($id);
    	$category = FrontRepository::getArticleCategory($id);
    	return view('front.cate.show')->with(compact(['articles','category']));
    }
}
