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

Route::get('list', [
    'uses' =>'Package\ContentController@api_Content'
]);
Route::post('/user/register', [
    'uses' => 'AuthController@register'
]);
Route::post('/user/login', [
    'uses' => 'AuthController@signin'
]);


Route::group(['prefix'=>'admin'], function (){
    Route::group(['prefix'=>'metropolis'], function(){
            //model3d
        Route::get('/model3d/list', 'Metropolis\MultiPlayerController@api_listModel');
        Route::get('/model3d/download/{id}', 'Metropolis\MultiPlayerController@urldownload');

        Route::get('/model3d/download', 'Metropolis\MultiPlayerController@getdownload');
        Route::get('/model3d/query', 'Metropolis\MultiPlayerController@query');
        Route::get('/model3d/tempdownload','Metropolis\MultiPlayerController@downloadtemp');

        //image
        Route::get('/img/download/{id}','Metropolis\MultiPlayerController@urlImagePre');
    });   
    Route::group(['prefix'=>'content'], function(){
          //content
        Route::get('/list', 'Package\ContentController@api_content');
        Route::get('/download/{id}', 'Package\ContentController@api_download');
    });
});

