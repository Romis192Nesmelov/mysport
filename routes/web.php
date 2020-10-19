<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
Route::auth();

//Route::get('/login', 'StaticController@index')->name('login');
//Route::get('/register', 'StaticController@index');
Route::get('/logout', 'Auth\LoginController@logout');
//Route::get('/send-confirm', 'Auth\RegisterController@sendConfirmMail');
Route::get('/password/reset', 'StaticController@index');
Route::get('/send-confirm', 'StaticController@index');
Route::get('/confirm-registration/{token}', 'Auth\RegisterController@confirmRegistration');
Route::post('/confirm-user', 'Auth\RegisterController@confirmUser');

//Route::get('/profile', 'UserController@profile');
//Route::post('/profile', 'UserController@editProfile');
//Route::post('/profile-delete', 'UserController@deleteProfile');

//Route::get('/fb-oauth', 'OAuthController@oAuthFb');
//Route::get('/fb-callback', 'OAuthController@fbCallback');

Route::get('/vk-oauth', 'OAuthController@oAuthVk');
Route::get('/vk-callback', 'OAuthController@vkCallback');

Route::get('/google-callback', 'OAuthController@googleCallback');

//Route::post('/search', 'UserController@search');

//Route::get('/admin', 'AdminController@index');

//Route::get('/admin/seo', 'AdminController@seo');
//Route::post('/admin/seo', 'AdminController@editSeo');

//Route::get('/admin/users/{slug?}', 'AdminController@users');
//Route::post('/admin/user', 'AdminController@editUser');
//Route::post('/admin/delete-user', 'AdminController@deleteUser');

//Route::get('/admin/settings', 'AdminController@settings');
//Route::post('/admin/settings', 'AdminController@editSettings');

Route::get('/', 'StaticController@index');
//Route::get('/change-lang', 'StaticController@changeLang');