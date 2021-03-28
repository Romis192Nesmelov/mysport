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

Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/send-confirm', 'Auth\RegisterController@sendConfirmMail');
Route::get('/confirm-registration/{token}', 'Auth\RegisterController@confirmRegistration');
Route::post('/confirm-user', 'Auth\RegisterController@confirmUser');

Route::get('/profile', 'UserController@profile');
Route::post('/profile', 'UserController@editProfile');
//Route::post('/profile-delete', 'UserController@deleteProfile');
Route::get('/profile/child', 'UserController@child');
Route::post('/child', 'UserController@editChild');
Route::post('/profile/delete-child', 'UserController@deleteChild');

Route::get('/fb-oauth', 'OAuthController@oAuthFb');
Route::get('/fb-callback', 'OAuthController@fbCallback');

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
Route::get('/area/{slug?}', 'StaticController@area');
Route::get('/events/{slug?}', 'StaticController@events');
Route::get('/organizations/{slug?}', 'StaticController@organization');
Route::get('/sections/{slug?}', 'StaticController@section');
Route::get('/places/{slug?}', 'StaticController@place');
Route::get('/trainers', 'StaticController@trainers');
Route::get('/kinds-of-sport', 'StaticController@kindsOfSport');

Route::get('/change-lang', 'StaticController@changeLang');
Route::post('/find-points', 'StaticController@findPoints');

Route::get('/trainer/events/{slug?}', 'UserController@events');
Route::post('/event', 'UserController@editEvent');
Route::post('/event-user-record', 'UserController@eventUserRecord');
Route::post('/event-kids-record', 'UserController@eventKidsRecord');