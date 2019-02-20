<?php
//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Award

Route::group([], function () {
	Route::get('/', 				['as' => 'index', 			'uses' => 'DocumentController@index']);
	Route::get('/{id}', 			['as' => 'edit', 			'uses' => 'DocumentController@edit']);
	Route::post('/', 				['as' => 'update', 			'uses' => 'DocumentController@update']);
	Route::get('/create', 			['as' => 'create', 			'uses' => 'DocumentController@create']);
	Route::put('/', 				['as' => 'store', 			'uses' => 'DocumentController@store']);
	Route::delete('/{id}', 			['as' => 'trash', 			'uses' => 'DocumentController@trash']);
	Route::post('status', 			['as' => 'update-status', 	'uses' => 'DocumentController@updateStatus']);
	Route::post('order', 			['as' => 'order', 			'uses' => 'DocumentController@order']);
	
	Route::get('/{id}/public-service', 		['as' => 'public-service', 			'uses' => 'DocumentController@publicService']);
	Route::get('/check-public-service', 		['as' => 'check-public-service', 		'uses' => 'DocumentController@checkPublicService']);
	Route::get('/{id}/public-work', 		['as' => 'public-work', 			'uses' => 'DocumentController@publicWork']);
	Route::get('/check-public-work', 		['as' => 'check-public-work', 		'uses' => 'DocumentController@checkPublicWork']);
});	