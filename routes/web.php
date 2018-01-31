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

//数据接口
Route::prefix('/')->namespace('Home')->group(function () {
    Route::get('/','ArticleController@index');//设置根目录
    Route::get('home/{type}','ArticleController@home');//栏目分类
    Route::get('search','ArticleController@search');//栏目分类
    Route::get('mood','MoodController@index');//时间轴
    Route::get('content/{id}','ArticleController@content')->where('id', '[0-9]+');//栏目分类
    Route::get('label/{tag_id}','ArticleController@label')->where('tag_id', '[0-9]+');//标签搜索

});
//直接定义路由
// Route::get('/article/index','ArticleController@index');

//登陆页面
Route::get('/login888',function (){
    return view('Admin/login');
});
/**
 * 后台路由
 */
Route::prefix('dwhq')->namespace('Admin')->group(function () {
    Route::post('login', 'LoginController@index');
    //article控制器名称
    Route::prefix('article')->group(function () {
        //create方法名称 where定义id为纯数字
        Route::get('create/{id}/{name}', 'ArticleController@create')->where('id', '[0-9]+');
    });

});
