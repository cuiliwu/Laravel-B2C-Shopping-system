<?php
/**
 * Created by Engineer CuiLiwu.
 * Project: deal.
 * Date: 2018/5/17-11:23
 * License Hangzhou orce Technology Co., Ltd. Copyright © 2018
 */

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([],function () {
    Route::get('login',['as' => 'admin.login','uses' => 'Admin\AuthController@login']);//登录
    Route::post('login',['as' => 'admin.dologin','uses' => 'Admin\AuthController@doLogin']);//执行登录
    Route::get('logout',['as' => 'admin.logout','uses' => 'Admin\AuthController@logout']);//退出登录

    Route::get('404',['as' => 'admin.error.404','uses' => 'Admin\ErrorController@error404Action']);//404
    Route::get('500',['as' => 'admin.error.500','uses' => 'Admin\ErrorController@error500Action']);//500

});


Route::group(['middleware' =>  ['adminAuthenticate']], function () {
    Route::get('/','IndexController@index','admin.index');
    // Route::resource();
});
