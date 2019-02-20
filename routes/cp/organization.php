<?php
//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Award

Route::group([], function () {
	Route::get('/', 				['as' => 'index', 			'uses' => 'OrganizationController@index']);
	Route::get('/{id}', 			['as' => 'edit', 			'uses' => 'OrganizationController@edit']);
	Route::post('/', 				['as' => 'update', 			'uses' => 'OrganizationController@update']);
	Route::get('/create', 			['as' => 'create', 			'uses' => 'OrganizationController@create']);
	Route::put('/', 				['as' => 'store', 			'uses' => 'OrganizationController@store']);
	Route::delete('/{id}', 			['as' => 'trash', 			'uses' => 'OrganizationController@trash']);
	Route::post('status', 			['as' => 'update-status', 	'uses' => 'OrganizationController@updateStatus']);
	Route::post('order', 			['as' => 'order', 			'uses' => 'OrganizationController@order']);
	
});	