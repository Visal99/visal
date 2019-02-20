<?php
//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Award

Route::group([], function () {
	Route::get('/', 				['as' => 'index', 			'uses' => 'DocumentCategoryController@index']);
	Route::get('/{id}', 			['as' => 'edit', 			'uses' => 'DocumentCategoryController@edit']);
	Route::post('/', 				['as' => 'update', 			'uses' => 'DocumentCategoryController@update']);
	Route::get('/create', 			['as' => 'create', 			'uses' => 'DocumentCategoryController@create']);
	Route::put('/', 				['as' => 'store', 			'uses' => 'DocumentCategoryController@store']);
	Route::delete('/{id}', 			['as' => 'trash', 			'uses' => 'DocumentCategoryController@trash']);
	Route::post('status', 			['as' => 'update-status', 	'uses' => 'DocumentCategoryController@updateStatus']);
	Route::post('order', 			['as' => 'order', 			'uses' => 'DocumentCategoryController@order']);
	
});	