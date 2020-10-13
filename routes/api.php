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


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => ['api','cors']], function () {
    Route::get('tables/{id}','ApiController@tables');
   // Route::post('auth/login', 'ApiController@login');
    // Route::group(['middleware' => 'jwt.auth'], function () {
    //     Route::post('user', 'ApiController@getAuthUser');
    //     Route::post('proposal', 'ApiController@getProposal');
    //     Route::post('detailpro/{id}', 'ApiController@getDetailProposal');
    //     Route::post('getwitel', 'ApiController@getWitel');
    //     Route::post('getsegmen', 'ApiController@getSegmen');
    //     Route::post('proposalp', 'ApiController@proposalp');
    // });
});
