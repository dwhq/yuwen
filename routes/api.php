<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/address', 'api\ApiController@address');
Route::get('/plural', 'api\ApiController@plural');
Route::get('/ip', 'api\ApiController@ip');
Route::get('/weather', 'api\ApiController@weather');
Route::get('/district', 'api\ApiController@district');
