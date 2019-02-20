<?php
//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Award

Route::group([], function () {
	Route::get('/', 				['as' => 'index', 			'uses' => 'ContactController@index']);
	Route::get('/{id}', 			['as' => 'edit', 			'uses' => 'ContactController@edit']);
	Route::post('/', 				['as' => 'update', 			'uses' => 'ContactController@update']);
	Route::get('/create', 			['as' => 'create', 			'uses' => 'ContactController@create']);
	Route::put('/', 				['as' => 'store', 			'uses' => 'ContactController@store']);
	Route::delete('/{id}', 			['as' => 'trash', 			'uses' => 'ContactController@trash']);
	Route::post('status', 			['as' => 'update-status', 	'uses' => 'ContactController@updateStatus']);
	Route::post('/order', 			['as' => 'order', 			'uses' => 'ContactController@order']);
	Route::post('update-featured', 	['as' => 'update-featured', 	'uses' => 'ContactController@updateFeatured']);
	
	Route::group(['as' => 'message.'], function () {
		Route::get('/{id}/message', 				    ['as' => 'index', 			'uses' => 'MessageController@index']);
		Route::get('/{id}/message/create', 				['as' => 'create', 			'uses' => 'MessageController@create']);
		Route::put('/message', 							['as' => 'store', 			'uses' => 'MessageController@store']);
		Route::get('/{id}/message/{message_id}', 		['as' => 'edit', 			'uses' => 'MessageController@edit']);
		Route::post('/message', 					    ['as' => 'update', 			'uses' => 'MessageController@update']);
		//Route::post('/orders', 					    	['as' => 'orders', 			'uses' => 'MessageController@order']);
		Route::delete('/message/{message_id}', 		    ['as' => 'trash', 			'uses' => 'MessageController@trash']);
	});

	Route::group(['as' => 'department.'], function () {
		Route::get('/{id}/department', 				    ['as' => 'index', 			'uses' => 'DepartmentController@index']);
		Route::post('/sub-order', 						['as' => 'sub-order', 			'uses' => 'DepartmentController@order']);
	});
});	