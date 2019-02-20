<?php
//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Award

Route::group([], function () {
	Route::get('/', 				['as' => 'index', 			'uses' => 'WebsiteController@index']);
	Route::get('/{id}', 			['as' => 'edit', 			'uses' => 'WebsiteController@edit']);
	Route::post('/', 				['as' => 'update', 			'uses' => 'WebsiteController@update']);
	Route::get('/create', 			['as' => 'create', 			'uses' => 'WebsiteController@create']);
	Route::put('/', 				['as' => 'store', 			'uses' => 'WebsiteController@store']);
	Route::delete('/{id}', 			['as' => 'trash', 			'uses' => 'WebsiteController@trash']);
	Route::post('status', 			['as' => 'update-status', 	'uses' => 'WebsiteController@updateStatus']);
	Route::post('order', 			['as' => 'order', 			'uses' => 'WebsiteController@order']);
	
});	