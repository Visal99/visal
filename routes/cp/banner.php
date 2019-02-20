<?php
//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Award

Route::group([], function () {
	Route::get('/', 				['as' => 'index', 			'uses' => 'BannerController@index']);
	Route::get('/{id}', 			['as' => 'edit', 			'uses' => 'BannerController@edit']);
	Route::post('/', 				['as' => 'update', 			'uses' => 'BannerController@update']);
	Route::get('/create', 			['as' => 'create', 			'uses' => 'BannerController@create']);
	Route::put('/', 				['as' => 'store', 			'uses' => 'BannerController@store']);
	Route::delete('/{id}', 			['as' => 'trash', 			'uses' => 'BannerController@trash']);
	Route::post('status', 			['as' => 'update-status', 	'uses' => 'BannerController@updateStatus']);
	Route::post('order', 			['as' => 'order', 			'uses' => 'BannerController@order']);
	
});	