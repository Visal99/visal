<?php


//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Role
Route::group(['as' => 'role.',  'prefix' => 'role'], function () {
	Route::get('/', 				['as' => 'index', 			'uses' => 'RoleController@index']);
	Route::get('/{id}', 			['as' => 'edit', 			'uses' => 'RoleController@edit']);
	Route::post('/', 				['as' => 'update', 			'uses' => 'RoleController@update']);
	Route::get('/create', 			['as' => 'create', 			'uses' => 'RoleController@create']);
	Route::put('/', 				['as' => 'store', 			'uses' => 'RoleController@store']);
	Route::delete('/{id}', 			['as' => 'trash', 			'uses' => 'RoleController@trash']);
	Route::post('update-status', 	['as' => 'update-status', 	'uses' => 'RoleController@updateStatus']);
	Route::get('/{id}/accesses', 	['as' => 'accesses', 		'uses' => 'RoleController@accesses']);
	Route::get('/accesses/check', 	['as' => 'check', 			'uses' => 'RoleController@check']);
	

});



			