<?php
//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Award

Route::group([], function () {
	Route::get('/', 				['as' => 'index', 			'uses' => 'PopupController@index']);
	Route::get('/{id}', 			['as' => 'edit', 			'uses' => 'PopupController@edit']);
	Route::post('/', 				['as' => 'update', 			'uses' => 'PopupController@update']);
	Route::get('/create', 			['as' => 'create', 			'uses' => 'PopupController@create']);
	Route::put('/', 				['as' => 'store', 			'uses' => 'PopupController@store']);
	Route::delete('/{id}', 			['as' => 'trash', 			'uses' => 'PopupController@trash']);
	Route::post('status', 			['as' => 'update-status', 	'uses' => 'PopupController@updateStatus']);
	Route::post('order', 			['as' => 'order', 			'uses' => 'PopupController@order']);
	Route::post('update-featured', 	['as' => 'update-featured', 'uses' => 'PopupController@updateFeatured']);
	
});	