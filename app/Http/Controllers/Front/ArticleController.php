<?php
namespace App\Http\Controllers\Front;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use FrontRepository;
class ArticleController extends Controller
{
    public function show($id)
    {
    	$article = FrontRepository::showArticle($id);
    	$category = FrontRepository::getArticleCategory($article->category_id);
    	return view('front.article.show')->with(compact(['article','category']));
    }
}
