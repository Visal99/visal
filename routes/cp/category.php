<?php
//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Award

Route::group([], function () {
	Route::get('/', 				['as' => 'index', 			'uses' => 'CategoryController@index']);
	Route::get('/{id}', 			['as' => 'edit', 			'uses' => 'CategoryController@edit']);
	Route::post('/', 				['as' => 'update', 			'uses' => 'CategoryController@update']);
	Route::get('/create', 			['as' => 'create', 			'uses' => 'CategoryController@create']);
	Route::put('/', 				['as' => 'store', 			'uses' => 'CategoryController@store']);
	Route::delete('/{id}', 			['as' => 'trash', 			'uses' => 'CategoryController@trash']);
	Route::post('status', 			['as' => 'update-status', 	'uses' => 'CategoryController@updateStatus']);
	Route::post('order', 			['as' => 'order', 			'uses' => 'CategoryController@order']);
	
});	