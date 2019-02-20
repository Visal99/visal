<?php
//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Award

Route::group([], function () {
	Route::get('/', 				['as' => 'index', 			'uses' => 'BiographyController@index']);
	Route::get('/{id}', 			['as' => 'edit', 			'uses' => 'BiographyController@edit']);
	Route::post('/', 				['as' => 'update', 			'uses' => 'BiographyController@update']);
	Route::get('/create', 			['as' => 'create', 			'uses' => 'BiographyController@create']);
	Route::put('/', 				['as' => 'store', 			'uses' => 'BiographyController@store']);
	Route::delete('/{id}', 			['as' => 'trash', 			'uses' => 'BiographyController@trash']);
	Route::post('status', 			['as' => 'update-status', 	'uses' => 'BiographyController@updateStatus']);
	Route::post('order', 			['as' => 'order', 			'uses' => 'BiographyController@order']);
	
});	