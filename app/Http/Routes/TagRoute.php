<?php
/**
 * 标签路由
 */
$router->group(['prefix' => 'tag'], function($router){
	$router->get('ajaxIndex', 'TagController@ajaxIndex');
	$router->get('/{id}/mark/{status}', 'TagController@mark')
		   ->where([
		   	'id' => '[0-9]+',
		   	'status' => config('admin.global.status.trash').'|'.
		   				config('admin.global.status.audit').'|'.
		   				config('admin.global.status.active')
		  	]);
});

$router->resource('tag', 'TagController');