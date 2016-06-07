<?php
namespace App\Http\Controllers\Front;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use FrontRepository;
use Redis;
class HomeController extends Controller
{
    public function index()
    {
    	// Redis::executeRaw(['SET', 'foo2', '5']);
    	// dd(Redis::executeRaw(['SET', 'foo1', '32']));
    	// dd(Redis::lpush('id',[1,2,3,4]));
    	// $str = ['tank','zhang','ying','li'];
    	// $source = ['89','40','60','100'];
    	// for ($i=0; $i < count($str); $i++) { 
    	// 	Redis::command('SET',['name_'.($i+1),$str[$i]]);
    	// 	Redis::command('SET',['score_'.($i+1),$source[$i]]);
    	// 	// Redis::set('score_'.$i+1,$source[$i]);
    	// }
    	// 获取浏览量最高的文章
    	// dd(Redis::sort('article:id',['BY'=>'article:view_*','SORT'=>'DESC','LIMIT'=> [0,10]]));
    	// dd(Redis::command('INCR',['article:view_5']));
    	// dd(Redis::command('lrange',['article:id',0,-1]));

        // 获取标签
        // dd(FrontRepository::tags());

    	$articles = FrontRepository::getArticles();
    	$cate = FrontRepository::getAllCategory();
    	return view('front.home.index')->with(compact(['articles','cate']));
    }
}
