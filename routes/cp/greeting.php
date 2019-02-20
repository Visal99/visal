<?php
//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Award

Route::group([], function () {
	Route::get('/', 				['as' => 'index', 			'uses' => 'GreetingController@index']);
	Route::get('/{id}', 			['as' => 'edit', 			'uses' => 'GreetingController@edit']);
	Route::post('/', 				['as' => 'update', 			'uses' => 'GreetingController@update']);
	Route::get('/create', 			['as' => 'create', 			'uses' => 'GreetingController@create']);
	Route::put('/', 				['as' => 'store', 			'uses' => 'GreetingController@store']);
	Route::delete('/{id}', 			['as' => 'trash', 			'uses' => 'GreetingController@trash']);
	Route::post('status', 			['as' => 'update-status', 	'uses' => 'GreetingController@updateStatus']);
	Route::post('order', 			['as' => 'order', 			'uses' => 'GreetingController@order']);
	Route::post('update-featured', 	['as' => 'update-featured', 'uses' => 'GreetingController@updateFeatured']);
	
});	