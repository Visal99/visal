<?php
//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Gallery

Route::group([], function () {
	Route::get('/', 				['as' => 'index', 			'uses' => 'AutomationController@index']);
	Route::get('/{id}', 			['as' => 'edit', 			'uses' => 'AutomationController@edit']);
	Route::post('/', 				['as' => 'update', 			'uses' => 'AutomationController@update']);
	Route::get('/create', 			['as' => 'create', 			'uses' => 'AutomationController@create']);
	Route::put('/', 				['as' => 'store', 			'uses' => 'AutomationController@store']);
	Route::delete('/{id}', 			['as' => 'trash', 			'uses' => 'AutomationController@trash']);
	Route::post('status', 			['as' => 'update-status', 	'uses' => 'AutomationController@updateStatus']);
	Route::post('/order-automation', 			['as' => 'order-automation', 			'uses' => 'AutomationController@order']);

	
	Route::group(['as' => 'location.'], function () {
		Route::get('/{id}/location', 				['as' => 'index', 			'uses' => 'LocationController@index']);
		Route::get('/{id}/location/create', 		['as' => 'create', 			'uses' => 'LocationController@create']);
		Route::put('/location', 							['as' => 'store', 			'uses' => 'LocationController@store']);
		Route::get('/{id}/location/{location_id}', 	['as' => 'edit', 			'uses' => 'LocationController@edit']);
		Route::post('/location', 					    ['as' => 'update', 			'uses' => 'LocationController@update']);
		Route::post('/order-location', 					    ['as' => 'order-location', 			'uses' => 'LocationController@order']);
		Route::delete('/location/{location_id}',  	['as' => 'trash', 			'uses' => 'LocationController@trash']);
	});
	Route::group(['as' => 'faq.'], function () {
		Route::get('/{id}/faq', 				    ['as' => 'index', 			'uses' => 'FaqController@index']);
		Route::get('/{id}/faq/create', 				['as' => 'create', 			'uses' => 'FaqController@create']);
		Route::put('/faq', 							['as' => 'store', 			'uses' => 'FaqController@store']);
		Route::get('/{id}/faq/{faq_id}', 			['as' => 'edit', 			'uses' => 'FaqController@edit']);
		Route::post('/faq', 					    ['as' => 'update', 			'uses' => 'FaqController@update']);
		Route::post('/order', 					    ['as' => 'order', 			'uses' => 'FaqController@order']);
		Route::delete('/faq/{faq_id}', 		    	['as' => 'trash', 			'uses' => 'FaqController@trash']);
	});
});	