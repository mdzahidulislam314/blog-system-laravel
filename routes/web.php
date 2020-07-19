<?php

use Illuminate\Support\Facades\Route;


Route::get('/','HomeController@index')->name('home');
Auth::routes();

Route::post('subscribers','SubscriberController@store')->name('subscriber.store');


Route::group(['as'=>'admin.','prefix' => 'admin','namespace'=>'Admin','middleware'=>['auth','admin']], function () {

    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('tag', 'TagController');
    Route::resource('category', 'CategoryController');
    Route::resource('post', 'PostController');
    Route::resource('subscribers','SubscriberController');
    //Profile setting
    Route::get('settings','SettingsController@index')->name('settings');
    Route::put('profile-update', 'SettingsController@ProfileUpdate')->name('update.profile');
    Route::put('password-update', 'SettingsController@updatePassword')->name('update.password');
    //Post approved Route
    Route::get('/pending/post', 'PostController@pending')->name('post.pending');
    Route::put('/post/{id}/approve', 'PostController@approval')->name('post.approve');

});


Route::group(['as'=>'user.','prefix' => 'user','namespace'=>'User','middleware'=>['auth','user']], function () {

    Route::get('dashboard','DashboardController@index')->name('dashboard');
    Route::resource('posts','PostController');
    //Profile setting
    Route::get('settings','SettingsController@index')->name('settings');
});
