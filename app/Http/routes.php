<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::post('/hook','GithubHookController@index');
Route::get('/index','IndexController@index');

Route::get('/wechat/openid','IndexController@get_open_id');
Route::post('/wechat/luncky','IndexController@luncky');
Route::post('/pay','PayController@pay');
Route::get('/notify','PayController@third_notify');

Route::get('/toushu/tousu','ToushuController@index');
Route::get('/toushu/tijiao','ToushuController@tijiao');
Route::get('/toushu/down','ToushuController@down');