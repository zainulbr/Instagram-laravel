<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('login', ['uses' => 'GuestController@login', 'as'=>'login']);
Route::get('register', ['uses' => 'GuestController@register', 'as' => 'register']);

Route::post('auth/login', ['uses' => 'AuthController@login', 'as' => 'auth_login']);
Route::post('auth/register', ['uses' => 'AuthController@register', 'as' => 'auth_register']);
Route::get('auth/logout', ['uses' => 'AuthController@logout', 'as'=>'auth_logout']);

Route::group(['middleware' => 'auth', 'namespace' => 'User'], function(){
    Route::get('/', ['uses' => 'UserController@index', 'as' => 'user-home']);
    Route::get('u/{username}', ['uses' => 'ProfileController@index', 'as' => 'user-profile']);
    Route::get('profile/edit', ['uses' => 'SettingProfileController@index', 'as' => 'user-profile-edit']);
    Route::post('profile/edit', ['uses' => 'SettingProfileController@save', 'as' => 'user-profile-edit-save']);
    Route::get('profile/change-password', ['uses' => 'ProfileController@getPassword', 'as' => 'user-profile-edit-password']);

        Route::group(['middleware' => 'status', 'admin' => true], function(){
            //implement route for admin
        
    Route::get('message', ['uses' => 'MessageController@index', 'as'=>'user-message']);
    Route::get('admin', ['uses' => 'AdminController@index', 'as'=>'user-admin']);
    Route::get('admin/tabel', ['uses' => 'AdminController@tabel', 'as'=>'user-tabel']);
    Route::get('admin/report', ['uses' => 'ReportController@index', 'as'=>'user-report']);
     Route::get('admin/Apost', ['uses' => 'ApostController@index', 'as'=>'user-Apost']);
    Route::get('admin/insert', ['uses' => 'AdminController@insert', 'as'=>'user-insert']);
    Route::post('admin/insert/tambah', ['uses' => 'AdminController@tambah', 'as' => 'user-tambah']);
    Route::get('admin/delete/{id}', ['uses' => 'AdminController@hapus', 'as' => 'user-hapus']);
    Route::get('admin/edit/{id}', ['uses' => 'AdminController@edit', 'as' => 'user-edit']);
    Route::post('admin/edit/update', ['uses' => 'AdminController@save', 'as' => 'edit-update']);
    });
    Route::get('search', ['uses' => 'SearchController@index', 'as' => 'user-search']);
    Route::get('upload', ['uses' => 'UploadController@index', 'as' => 'user-upload_image']);
    Route::post('upload', ['uses' => 'UploadController@upload', 'as' => 'user-upload_proses']);
});

Route::group(['prefix' => 'api', 'middleware' => 'auth'], function() {

        Route::group(['prefix' => 'user', 'namespace' => 'UserApi', 'middleware' => 'status', 'admin' => false], function() {
            //implement route for user
            Route::post('delete-post', ['uses' => 'PostController@delete', 'as' => 'api-user-delete-post']);
            Route::post('like', ['uses' => 'LikeController@like', 'as' => 'api-user-like']);
            Route::post('unlike', ['uses' => 'LikeController@unlike', 'as' => 'api-user-unlike']);
            Route::post('add-comment', ['uses' => 'CommentController@add', 'as' => 'api-user-comment']);
            Route::post('follow', ['uses' => 'FriendshipController@follow', 'as' => 'api-user-follow']);
            Route::post('unfollow', ['uses' => 'FriendshipController@unfollow', 'as' => 'api-user-unfollow']);
            Route::post('send-report', ['uses' => 'ReportController@send', 'as' => 'api-user-send-report']);
            Route::post('change-password', ['uses' => 'PasswordController@change', 'as' => 'api-change-password']);
        });

        Route::group(['prefix' => 'admin', 'namespace' => 'AdminApi', 'middleware' => 'status', 'admin' => true], function(){
            //implement route for admin

        });
});