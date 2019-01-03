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

Route::get('/', [
    'uses'=>'FrontEndController@index',
    'as'=>'index'
]
);

Auth::routes();



Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){
    Route::get('/home',[


    'uses'=>    'HomeController@index',
        'as'=>'home'
        ]);
    Route::get('/posts/create',[
        'uses'=>'PostsController@create',
        'as'=>'posts.create'

    ]);

    Route::post('/posts/store',[
        'uses'=>'PostsController@store',
        'as'=>'posts.store'

    ]);

    Route::get('/posts',[
        'uses'=>'PostsController@index',
        'as'=>'posts'

    ]);

    Route::get('/posts/delete/{id}',[
        'uses'=>'PostsController@destroy',
        'as'=>'posts.delete'

    ]);

    Route::get('/posts/trash',[
        'uses'=>'PostsController@trash',
        'as'=>'posts.trash'

    ]);

    Route::get('/posts/kill/{id}',[
        'uses'=>'PostsController@kill',
        'as'=>'posts.kill'

    ]);

    Route::get('/posts/restore/{id}',[
        'uses'=>'PostsController@restore',
        'as'=>'posts.restore'

    ]);

    Route::get('/posts/edit/{id}',[
        'uses'=>'PostsController@edit',
        'as'=>'posts.edit'

    ]);
    Route::post('/posts/update/{id}',[
        'uses'=>'PostsController@update',
        'as'=>'posts.update'

    ]);
    Route::get('/categories/create',[
        'uses'=>'CategoriesController@create',
        'as'=>'categories.create'

    ]);

    Route::post('/categories/store',[
        'uses'=>'CategoriesController@store',
        'as'=>'categories.store'

    ]);

    Route::get('/categories',[
        'uses'=>'CategoriesController@index',
        'as'=>'categories'

    ]);

    Route::get('/categories/edit/{id}',[
        'uses'=>'CategoriesController@edit',
        'as'=>'category.edit'

    ]);
    Route::get('/categories/delete/{id}',[
        'uses'=>'CategoriesController@destroy',
        'as'=>'category.delete'

    ]);

    Route::post('/categories/update/{id}',[
        'uses'=>'CategoriesController@update',
        'as'=>'category.update'

    ]);

    Route::get('/tags',[
        'uses'=>'TagsController@index',
        'as'=>'tags'

    ]);

    Route::post('/tags/store',[
        'uses'=>'TagsController@store',
        'as'=>'tag.store'

    ]);

    Route::get('/tags/create',[
        'uses'=>'TagsController@create',
        'as'=>'tag.create'

    ]);

    Route::get('/tags/edit/{id}',[
        'uses'=>'TagsController@edit',
        'as'=>'tag.edit'

    ]);

    Route::post('/tags/update/{id}',[
        'uses'=>'TagsController@update',
        'as'=>'tag.update'

    ]);

    Route::get('/tags/delete/{id}',[
        'uses'=>'TagsController@destroy',
        'as'=>'tag.delete'

    ]);
});