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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/register', 'Client\ClientController@register');

Route::post('/store-detail-reports', 'Reports\DetailReports\StoreDetailReportsController@storeDetailReports');

Route::get('/detail-reports/{id}', 'Reports\DetailReports\GetDetailReportsController');
