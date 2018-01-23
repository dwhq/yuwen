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

Route::get('/', function () {
    return view('Home/index');
});

//->middleware('token')  添加中间件
//Route::prefix('/')->namespace('Home')->group(function () {
//    Route::get('/', 'ArticleController@index');
//    Route::get('index', 'ArticleController@index');
//});

/**
 * 路由分组
 */
Route::prefix('article')->group(function () {
    Route::get('index', 'ArticleController@index');
    Route::get('create', 'ArticleController@create');
});

//namespace 控制器文件名
//Route::prefix('admin/article')->namespace('Admin')->group(function () {
//    Route::get('index', 'ArticleController@index');
//});
//嵌套路由
Route::prefix('admin')->namespace('Admin')->group(function () {
    //article控制器名称
    Route::prefix('article')->group(function () {
        Route::get('index/{id}', 'ArticleController@index');
        //create方法名称 where定义id为纯数字
        Route::get('create/{id}/{name}', 'ArticleController@create')->where('id', '[0-9]+');
    });

});
//数据接口
Route::prefix('home')->namespace('Home')->group(function () {
    Route::prefix('Index')->group(function () {
        Route::get('column', 'IndexController@column');
        Route::get('info', 'IndexController@info    ');
    });
});
//直接定义路由
// Route::get('/article/index','ArticleController@index');
