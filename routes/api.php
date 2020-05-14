<?php

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::post('logout', 'AuthController@logout')->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function() {

	Route::apiResource('posts', 'PostController');
	Route::get('post/by-user/{userId}', 'PostController@getPostsUser');
	Route::post('post/photo', 'PostController@storePhoto');
	Route::post('post/des-photo', 'PostController@destroyPhoto');

	Route::apiResource('comments', 'CommentController')->except(['index', 'show']);
	Route::get('comments/post/{postId}', 'CommentController@commentPost');

	Route::apiResource('likes', 'LikeController')->only(['store', 'destroy']);
	Route::get('likes/post/{postId}', 'LikeController@likePost');

	Route::apiResource('users', 'UserController')->except('index');
	Route::post('users/des-avatar', 'UserController@destroyAvatar');

	Route::get('search/people', 'SearchController@newPeople');
	Route::get('search/people/{query}', 'SearchController@people');

});
