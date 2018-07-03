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

    Route::get('/articles/{article}', [
        'as' => 'articles.show',
        'uses' => 'ArticleController@show'
    ]);

    Route::get('/projects', [
        'as' => 'projects.index',
        'uses' => 'ProjectController@index'
    ]);
    Route::get('/projects/{project}', [
        'as' => 'projects.show',
        'uses' => 'ProjectController@show'
    ]);


    Route::group(['middleware' => 'jwt'], function(){

        Route::resource(
            'projects', 'ProjectController', ['except' => [
                'create', 'edit', 'index', 'show'
            ]]
        );
        Route::get('projects/{project}/albums', [
            'as' => 'projects.albums',
            'uses' => 'AlbumController@project'
        ]);

        Route::resource(
            'articles', 'ArticleController', ['except' => [
                'create', 'edit', 'index', 'show'
            ]
        ]);

        Route::get('articles/{article}/albums', [
            'as' => 'articles.albums',
            'uses' => 'AlbumController@article'
        ]);

        Route::post('/images/{album}', [
            'as' => 'images.store',
            'uses' => 'ImageController@store'
        ]);

        Route::delete('/images/{image}', [
            'as' => 'images.destroy',
            'uses' => 'ImageController@destroy'
        ]);
        
        Route::post('/albums', [
            'as' => 'albums.store',
            'uses' => 'AlbumController@store'
        ]);

        Route::get('albums/{album}', [
            'as' => 'albums.show',
            'uses' => 'AlbumController@show'
        ]);


    });
});
