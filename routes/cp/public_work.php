<?php
//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Award

Route::group([], function () {
	Route::get('/', 				['as' => 'index', 			'uses' => 'PublicWorkController@index']);
	Route::get('/{id}', 			['as' => 'edit', 			'uses' => 'PublicWorkController@edit']);
	Route::post('/', 				['as' => 'update', 			'uses' => 'PublicWorkController@update']);
	Route::get('/create', 			['as' => 'create', 			'uses' => 'PublicWorkController@create']);
	Route::put('/', 				['as' => 'store', 			'uses' => 'PublicWorkController@store']);
	Route::delete('/{id}', 			['as' => 'trash', 			'uses' => 'PublicWorkController@trash']);
	Route::post('statuse', 			['as' => 'update-statuse', 	'uses' => 'PublicWorkController@updateStatus']);
	Route::post('/order', 			['as' => 'order', 			'uses' => 'PublicWorkController@order']);
	Route::post('update-featured', 	['as' => 'update-featured', 	'uses' => 'PublicWorkController@updateFeatured']);
	
	Route::group(['as' => 'project.'], function () {
		Route::get('/{id}/project', 				    ['as' => 'index', 			'uses' => 'ProjectController@index']);
		Route::get('/{id}/project/create', 				['as' => 'create', 			'uses' => 'ProjectController@create']);
		Route::put('/project', 							['as' => 'store', 			'uses' => 'ProjectController@store']);
		Route::get('/{id}/project/{project_id}', 		['as' => 'edit', 			'uses' => 'ProjectController@edit']);
		Route::post('status', 							['as' => 'update-status', 	'uses' => 'ProjectController@updateStatus']);
		Route::post('/project', 					    ['as' => 'update', 			'uses' => 'ProjectController@update']);
		Route::post('/orders', 					    	['as' => 'orders', 			'uses' => 'ProjectController@order']);
		Route::delete('/project/{project_id}', 		    ['as' => 'trash', 			'uses' => 'ProjectController@trash']);
	});
});	