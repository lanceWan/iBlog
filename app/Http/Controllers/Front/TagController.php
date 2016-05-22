<?php
namespace App\Http\Controllers\Front;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use FrontRepository;
class TagController extends Controller
{
    public function show($id)
    {
    	$tag = FrontRepository::findTagById($id);
    	$articles = FrontRepository::showArticlesByTag($id);
    	return view('front.tag.show')->with(compact(['tag','articles']));
    }
}
