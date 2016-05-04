<?php
/**
 * 分类路由
 */
$router->group(['prefix' => 'cate'], function($router){
	$router->get('sort', 'CategoryController@sort');
	$router->get('/{id}/mark/{status}', 'CategoryController@mark')
		   ->where([
		   	'id' => '[0-9]+',
		   	'status' => config('admin.global.status.trash').'|'.
		   				config('admin.global.status.audit').'|'.
		   				config('admin.global.status.active')
		  	]);
});

$router->resource('cate', 'CategoryController');