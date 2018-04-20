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

//前台github第三方登陆
Route::prefix('login')->namespace('Home')->group(function () {
//    Route::match(['get', 'post'], 'github','LoginController@handleProviderCallback');
    Route::any('github', 'LoginController@handleProviderCallback');
    Route::get('loginGithub/{service}', 'LoginController@redirectToProvider');
});
//namespace 控制器文件名
//Route::prefix('admin/article')->namespace('Admin')->group(function () {
//    Route::get('index', 'ArticleController@index');
//});
//嵌套路由

//数据接口
Route::prefix('/')->namespace('Home')->group(function () {
    Route::get('/', 'ArticleController@index');//设置根目录
    Route::get('home/{type}', 'ArticleController@home');//栏目分类
    Route::get('search', 'ArticleController@search');//栏目分类
    Route::get('mood', 'MoodController@index');//时间轴
    Route::get('qrcode', 'IndexController@qrcode');//二维码
    Route::get('content/{id}', 'ArticleController@content')->where('id', '[0-9]+');//栏目分类
    Route::get('label/{tag_id}', 'ArticleController@label')->where('tag_id', '[0-9]+');//标签搜索
    Route::any('demo', 'DemoController@demo');//测试页面
    Route::prefix('vip')->middleware('vip')->group(function () {
        //退出登陆
        Route::get('logout/{user_id}', 'vipController@logout')->where('user_id', '[0-9]+');//退出登录
        Route::post('comment', 'vipController@comment');
        Route::post('article_work', 'vipController@article_work');

    });
});
//直接定义路由
// Route::get('/article/index','ArticleController@index');

//登陆页面
Route::get('/login888', function () {
    return view('Admin/login');
});
//Route::get('/url111111111', function () {
//    Storage::append('file.log',$_SERVER['REMOTE_ADDR']);
//   return redirect('https://www.bilibili.com/video/av16329096?from=search&seid=13713348465042281393');
//});


//判断登陆
Route::prefix('/')->namespace('Admin')->group(function () {
    Route::post('login', 'LoginController@index');
});
Route::get('errors', function () {
    return view('post/create');
});
/**
 * 后台路由
 */
Route::prefix('admin')->namespace('Admin')->middleware('token')->group(function () {
    Route::get('index', 'HomeController@index');
    //发送邮件
    Route::post('email', 'HomeController@email');
    //发送邮件页面
    Route::get('email_show', 'HomeController@email_show');
    //退出后台
    Route::get('logOut','LoginController@LogOut');
    //清除缓存
    Route::get('clearCache','LoginController@clearCache');
    //编辑网站信息
    Route::get('info', 'InfoController@index');
    Route::post('redact', 'InfoController@Store');
    Route::group(['prefix' => 'article'], function () {
        //文章列表
        Route::get('list', 'ArticleController@List');
        //添加文章
        Route::get('create', 'ArticleController@create');
        Route::post('store', 'ArticleController@store');
        //时间轴列表
        Route::get('mood_list', 'ArticleController@mood_list');
        //添加时间轴
        Route::get('mood_show', 'ArticleController@mood_show');
        Route::post('mood_add', 'ArticleController@mood_add');
        Route::post('mood_state', 'ArticleController@mood_state');
        //后台查看文章
        Route::get('look/{u_id}', 'ArticleController@look');
        //删除文章
        Route::get('delect/{u_id}', 'ArticleController@delect');
        //修改文章
        Route::get('alter/{u_id}', 'ArticleController@alter')->where('u_id', '[0-9]+');
        Route::post('amend', 'ArticleController@amend');
        //文章显示与隐藏
        Route::post('state', 'ArticleController@state');
    });
    //栏目管理
    Route::group(['prefix' => 'column'], function () {
        //栏目列表
        Route::get('index', 'ColumnController@index');
        //添加栏目
        Route::get('create', 'ColumnController@create');
        Route::post('store', 'ColumnController@store');
        //修改栏目
        Route::get('alter/{id}', 'ColumnController@alter')->where('id', '[0-9]+');
        Route::post('amend', 'ColumnController@amend');
        //栏目显示与隐藏
        Route::post('state', 'ColumnController@state');
        //修改栏目顺序
        Route::post('sort', 'ColumnController@sort');
        //删除栏目
        Route::get('delect/{u_id}', 'ColumnController@delect');
    });
    //会员管理
    Route::group(['prefix' => 'users'],function () {
       //会员列表
        Route::get('index', 'usersController@index');
        Route::get('word', 'usersController@word');
    });
    //友情链接管理
    Route::group(['prefix' => 'link'], function () {
        //栏目列表
        Route::get('index', 'LinkController@index');
        //添加栏目
        Route::get('create', 'LinkController@create');
        Route::post('store', 'LinkController@store');
        //修改栏目
        Route::get('alter/{id}', 'LinkController@alter')->where('id', '[0-9]+');
        Route::post('amend', 'LinkController@amend');
        //栏目显示与隐藏
        Route::post('state', 'LinkController@state');
        //修改栏目顺序
        Route::post('sort', 'LinkController@sort');
        //删除栏目
        Route::get('delect/{u_id}', 'LinkController@delect');
    });
//    Route::prefix('article')->group(function () {
//        //create方法名称 where定义id为纯数字
//
//    });
    Route::get('excel/export', 'ExcelController@export');
    Route::get('excel/import', 'ExcelController@import');
});
//上传文件 到时候重新写中间件吧
Route::prefix('upload')->namespace('Upload')->middleware('token')->group(function () {
    Route::post('upload', 'UploadController@upload');
    Route::get('get', 'UploadController@get');
});
//Route::prefix('/laravel-u-editor-server/server')->namespace('Stevenyangecho\UEditor')->middleware('token')->group(function () {
//    Route::post('upload', 'laravel-u-editor/src/Controller.php@server');
//});