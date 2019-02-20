<?php

Route::get('{locale}/home', 								[ 'as' => 'home',						'uses' => 'HomeController@index']);

Route::get('{locale}/about-us/mission-and-vision', 			[ 'as' => 'mission-and-vision',			'uses' => 'AboutUsController@missionAndVision']);
Route::get('{locale}/about-us/the-senior-minister', 		[ 'as' => 'the-senior-minister',		'uses' => 'AboutUsController@theSeniorMinister']);
Route::get('{locale}/about-us/message-from-minister', 		[ 'as' => 'message-from-minister',		'uses' => 'AboutUsController@messageFromMinister']);
Route::get('{locale}/about-us/organization-chart', 			[ 'as' => 'organization-chart',		'uses' => 'AboutUsController@orgainizationChart']);

Route::get('{locale}/public-services/{slug}', 				[ 'as' => 'public-services',			'uses' => 'PublicServiceController@index']);
Route::get('{locale}/public-works/{slug}', 					[ 'as' => 'public-works',				'uses' => 'PublicWorkController@index']);
Route::get('{locale}/documents', 							[ 'as' => 'documents-blank',			'uses' => 'DocumentController@index']);
Route::get('{locale}/documents/{category}', 				[ 'as' => 'documents',					'uses' => 'DocumentController@index']);
Route::get('{locale}/project-view/{id}', 					[ 'as' => 'project-view',					'uses' => 'PublicWorkController@viewProject']);

Route::get('{locale}/news', 								[ 'as' => 'news-blank',					'uses' => 'NewsController@index']);
Route::get('{locale}/news/{category}', 						[ 'as' => 'news',						'uses' => 'NewsController@index']);
Route::get('{locale}/read/{id}', 							[ 'as' => 'news-detail',				'uses' => 'NewsController@detail']);

Route::get('{locale}/prosts', 								[ 'as' => 'posts',					'uses' => 'NewsController@posts']);
Route::get('{locale}/post/{id}', 							[ 'as' => 'post',					'uses' => 'NewsController@post']);


Route::get('{locale}/contact-us/{slug}', 					[ 'as' => 'contact-us',					'uses' => 'ContactUsController@index']);
Route::put('{locale}/send-message', 						[ 'as' => 'send-message',				'uses' => 'ContactUsController@sendMessage']);





