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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::group(['domain'=>'admin.laravel.com','namespace'=>'Admin'], function(){
    //Route::get('/', 'IndexController@index');//后台登陆路由
    Route::any('login', 'LoginController@login');
    Route::get('code', 'LoginController@code');
    //Route::get('/getcode', 'LoginController@getcode');
    //Route::any('/crypt', 'LoginController@crypt');
});

Route::group(['domain'=>'admin.laravel.com','namespace'=>'Admin','middleware'=>['admin.login']], function(){
    Route::get('/', 'IndexController@index');//后台登陆路由
    Route::get('quit', 'LoginController@quit');
    Route::any('pass', 'IndexController@pass');
});

Route::get('/','Home\IndexController@index');

//使用路由分组
Route::prefix('article')->group(function(){
	Route::get('index','ArticleController@index');
	Route::get('create','ArticleController@create');
	//可以对id进行约束，也可以在"app/Providers/RouteServiceProvider.php"中进行全局约束
	//Route::get('edit/{id}','ArticleController@edit')->where('id','[0-9]+');
	Route::get('edit/{id}','ArticleController@edit');
});

