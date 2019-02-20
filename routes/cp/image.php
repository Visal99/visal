<?php

Route::get('/', 				['as' => 'index', 			'uses' => 'ImagesController@index']);
Route::get('/{id}', 			['as' => 'edit', 			'uses' => 'ImagesController@showEditForm']);
Route::post('/', 				['as' => 'update', 			'uses' => 'ImagesController@update']);
Route::get('/create', 			['as' => 'create', 			'uses' => 'ImagesController@create']);
Route::put('/', 				['as' => 'store', 			'uses' => 'ImagesController@store']);
Route::delete('/{id}', 			['as' => 'trash', 			'uses' => 'ImagesController@trash']);
Route::post('update-status', 	['as' => 'update-status', 	'uses' => 'ImagesController@updateStatus']);
