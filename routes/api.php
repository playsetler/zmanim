<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function(Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum', 'namespace' => 'Layout', 'prefix' => 'layouts'], function() {
    Route::get('/', 'GetLayoutsController');
    Route::get('/{layout}', 'GetLayoutController');
    Route::post('/delete', 'DeleteLayoutsController');
    Route::post('/update/{layout}', 'UpdateLayoutController');
    Route::post('/create', 'CreateLayoutController');
});

Route::group(['middleware' => 'auth:sanctum', 'namespace' => 'Media', 'prefix' => 'upload'], function() {
    Route::post('/', 'UploadFileController');
});

Route::group(['middleware' => 'auth:sanctum', 'namespace' => 'Media', 'prefix' => 'media'], function() {
    Route::get('/{type}/{media?}', 'GetMediaController');
    Route::post('/delete', 'DeleteMediaController');
    Route::post('/update/{media}', 'UpdateMediaController');
    Route::post('/create', 'CreateMediaController');
});
