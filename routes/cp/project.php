<?php
//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Award

Route::group([], function () {
	Route::get('/', 				['as' => 'index', 			'uses' => 'ProjectController@index']);
	Route::get('/{id}', 			['as' => 'edit', 			'uses' => 'ProjectController@edit']);
	Route::post('/', 				['as' => 'update', 			'uses' => 'ProjectController@update']);
	Route::get('/create', 			['as' => 'create', 			'uses' => 'ProjectController@create']);
	Route::put('/', 				['as' => 'store', 			'uses' => 'ProjectController@store']);
	Route::delete('/{id}', 			['as' => 'trash', 			'uses' => 'ProjectController@trash']);
	Route::post('status', 			['as' => 'update-status', 	'uses' => 'ProjectController@updateStatus']);
	Route::post('order', 			['as' => 'order', 			'uses' => 'ProjectController@order']);
	
});	