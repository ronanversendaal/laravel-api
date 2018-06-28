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

Route::get('/', function(){
    return redirect('https://ronanversendaal.com', 301);
});

Route::group(['prefix' => 'v1'], function(){

    Route::group(['prefix' => 'auth'], function(){
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('me', 'AuthController@me');
    });

    Route::get('/articles', [
        'as' => 'articles.index',
        'uses' => 'ArticleController@index'
    ]);

    Route::get('/projects', [
        'as' => 'projects.index',
        'uses' => 'ProjectController@index'
    ]);


    Route::group(['middleware' => 'jwt'], function(){
        Route::resource(
            'projects', 'ProjectController', ['except' => [
                'create', 'edit', 'index'
            ]]
        );

        Route::resource(
            'articles', 'ArticleController', ['except' => [
                'create', 'edit', 'index'
            ]]
        );
    });
});
