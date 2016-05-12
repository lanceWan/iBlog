<?php
/**
 * 文章路由
 */
$router->group(['prefix' => 'article'], function($router){
	$router->get('ajaxIndex', 'ArticleController@ajaxIndex');
	$router->post('upload', 'ArticleController@upload');
	$router->get('/{id}/mark/{status}', 'ArticleController@mark')
		   ->where([
		   	'id' => '[0-9]+',
		   	'status' => config('admin.global.status.trash').'|'.
		   				config('admin.global.status.audit').'|'.
		   				config('admin.global.status.active')
		  	]);
});

$router->resource('article', 'ArticleController');