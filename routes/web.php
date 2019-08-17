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

Route::get('/', 'Web\AppController@getApp')
    ->middleware('auth');
Route::get('login', 'Web\AppController@getLogin')
    ->name('login');
Route::get('auth/{social}', 'Web\AuthenticationController@getSocialRedirect');
Route::get('auth/{social}/callback', 'Web\AuthenticationController@getSocialCallback');

Route::get('geocode', function () {
    return \App\Utilities\GaodeMaps::geocodeAddress('天城路1号', '杭州', '浙江');
});
