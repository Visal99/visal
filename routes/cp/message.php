<?php
//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Award

Route::group([], function () {
	Route::get('/', 				['as' => 'index', 			'uses' => 'MessageController@index']);
	Route::get('/{id}', 			['as' => 'edit', 			'uses' => 'MessageController@edit']);
	Route::post('/', 				['as' => 'update', 			'uses' => 'MessageController@update']);
	Route::delete('/{id}', 			['as' => 'trash', 			'uses' => 'MessageController@trash']);
	
});	