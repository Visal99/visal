<?php
//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Award

Route::group([], function () {
	Route::get('/', 				['as' => 'index', 			'uses' => 'PressController@index']);
	Route::get('/feature', 				['as' => 'feature', 			'uses' => 'PressController@feature']);
	Route::get('/{id}', 			['as' => 'edit', 			'uses' => 'PressController@edit']);
	Route::post('/', 				['as' => 'update', 			'uses' => 'PressController@update']);
	Route::get('/create', 			['as' => 'create', 			'uses' => 'PressController@create']);
	Route::put('/', 				['as' => 'store', 			'uses' => 'PressController@store']);
	Route::delete('/{id}', 			['as' => 'trash', 			'uses' => 'PressController@trash']);
	Route::post('status', 			['as' => 'update-status', 	'uses' => 'PressController@updateStatus']);
	Route::post('/order', 			['as' => 'order', 			'uses' => 'PressController@order']);
	Route::post('update-featured', 	['as' => 'update-featured', 	'uses' => 'PressController@updateFeatured']);
	
	Route::group(['as' => 'image.'], function () {
		Route::get('/{id}/image', 				    	['as' => 'index', 			'uses' => 'ImageController@index']);
		Route::get('/{id}/image/create', 				['as' => 'create', 			'uses' => 'ImageController@create']);
		Route::put('/image', 							['as' => 'store', 			'uses' => 'ImageController@store']);
		Route::get('/{id}/image/{image_id}', 			['as' => 'edit', 			'uses' => 'ImageController@edit']);
		Route::post('/image', 					    	['as' => 'update', 			'uses' => 'ImageController@update']);
		Route::post('/orders', 					    	['as' => 'orders', 			'uses' => 'ImageController@order']);
		Route::delete('/image/{image_id}', 		    	['as' => 'trash', 			'uses' => 'ImageController@trash']);
		Route::post('image-featured', 					['as' => 'image-featured', 	'uses' => 'ImageController@updateFeatured']);
	});
});	