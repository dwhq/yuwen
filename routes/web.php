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

//判断登陆

Route::prefix('/')->namespace('Admin')->group(function () {
    Route::post('login', 'LoginController@index');
});
Route::get('errors',function (){
    return view('post/create');
});
/**
 * 后台路由
 */
Route::prefix('admin')->namespace('Admin')->middleware('token')->group(function () {
    Route::get('index', 'HomeController@index');
    //编辑网站信息
    Route::get('info', 'InfoController@index');
    Route::post('redact', 'InfoController@Store');
    Route::group(['prefix' => 'article'], function () {
        //文章列表
        Route::get('list', 'ArticleController@List');
        //添加文章
        Route::get('create', 'ArticleController@create');
        Route::post('store', 'ArticleController@store');
        //后台查看文章
        Route::get('look/{u_id}', 'ArticleController@look');
        //删除文章
        Route::get('delect/{u_id}', 'ArticleController@delect');
        //修改文章
        Route::get('alter/{u_id}', 'ArticleController@alter')->where('u_id', '[0-9]+');
        Route::post('amend', 'ArticleController@amend');
    });
//    Route::prefix('article')->group(function () {
//        //create方法名称 where定义id为纯数字
//
//    });

});
//上传文件 到时候重新写中间件吧
Route::prefix('upload')->namespace('Upload')->middleware('token')->group(function () {
    Route::post('upload', 'UploadController@upload');
    Route::get('get', 'UploadController@get');
});
//Route::prefix('/laravel-u-editor-server/server')->namespace('Stevenyangecho\UEditor')->middleware('token')->group(function () {
//    Route::post('upload', 'laravel-u-editor/src/Controller.php@server');
//});