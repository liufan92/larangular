<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// HOME PAGE ===================================  
Route::get('/', function () {
    return view('index');
});

// API ROUTES ==================================  
Route::group(['prefix' => 'api'], function(){
	Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
	Route::post('authenticate', 'AuthenticateController@authenticate');
	Route::post('register', 'AuthenticateController@create');
	Route::resource('articles', 'ArticleController', array('only'=> array('index', 'store', 'update', 'destroy')));
	Route::resource('comments', 'CommentController', array('only'=> array('index', 'store', 'destroy')));
});


