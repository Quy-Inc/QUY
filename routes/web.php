<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Auth::routes();
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::get('/dashboard', 'HomeController@dash');
Route::post('/login', 'Auth\SignInController@login');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::any('/ajax/{slug}/{action}', 'IdentifyController@getModuleController');
Route::get('/download/lop','DownloadController@exportLop');
Route::get('/download/useram','DownloadController@downloadAm');
Route::get('/{slug}', 'IdentifyController@index');
Route::get('/{slug}/{subslug}', 'IdentifyController@index');
Route::get('/{slug}/{subslug}/{data}', 'IdentifyController@index');