<?php
namespace App\Repositories\front;
use App\Models\Category;
use App\Models\Article;
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
		if (Cache::has(config('admin.global.cache.front'))) {
			return Cache::get(config('admin.global.cache.front'));
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
			Cache::forever(config('admin.global.cache.front'), $cateList);
			return $cateList;
		}
		return [];
	}

	/**
	 * 获取文章
	 * @date   2016-05-09
	 * @author 晚黎
	 * @return [type]     [description]
	 */
	public function getArticles()
	{
		$articles = Article::with(['tag','category'])->where('status',config('admin.global.status.active'))->orderBy('created_at','desc')->paginate(config('admin.global.paginate'));

		return $articles;
	}

	public function showArticle($id)
	{
		$article = Article::with('tag')->find($id);
		if ($article) {
			$article->category = $this->getArticelCategory($article->category_id);
			// 添加访问次数
			if (Cache::has(config('admin.global.cache.view').$article->id)) {
				Cache::increment(config('admin.global.cache.view').$article->id);
			}else{
				Cache::forever(config('admin.global.cache.view').$article->id ,'1');
			}
			return $article;
		}
		abort(404);
	}

	/**
	 * 获取文章的分类
	 * @author 晚黎
	 * @date   2016-05-13T15:27:07+0800
	 * @param  [type]                   $category_id [description]
	 * @return [type]                                [description]
	 */
	public function getArticelCategory($category_id)
	{
		if (Cache::has(config('admin.global.cache.article_cate'))) {
			$cate = Cache::get(config('admin.global.cache.article_cate'));
			return $cate[$category_id];
		}
		$categories = Category::all()->keyBy('id');
		if ($categories) {
			$temp = [];
			foreach ($categories as $key => $cate) {
				$temp[$cate->id] = $cate->name;
			}
			Cache::forever(config('admin.global.cache.article_cate'),$temp);
			return $temp[$category_id];
		}
		return '';
	}
	
}