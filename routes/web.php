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

Route::get('/?auth=login', 'StaticController@index')->name('login');
Route::get('/login', 'StaticController@redirect');
Route::get('/register', 'StaticController@redirect');
//Route::get('/password-reset', 'StaticController@index');
//Route::get('/send-confirm', 'StaticController@index');
//Route::get('password/reset/{token}', 'StaticController@index');

Route::get('/logout', 'Auth\LoginController@logout');
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

Route::get('/admin', 'HalfAdminController@index');

Route::get('/admin/users/{slug?}', 'HalfAdminController@users');
Route::post('/admin/user', 'HalfAdminController@editUser');
Route::post('/admin/delete-user', 'HalfAdminController@deleteUser');

Route::get('/admin/kids/{slug?}', 'HalfAdminController@kids');
Route::post('/admin/kid', 'HalfAdminController@editKid');
Route::post('/admin/delete-kid', 'HalfAdminController@deleteKid');

Route::get('/admin/news/{slug?}', 'HalfAdminController@news');
Route::post('/admin/news', 'HalfAdminController@editNews');
Route::post('/admin/delete-news', 'HalfAdminController@deleteNews');

Route::get('/admin/banners', 'HalfAdminController@banners');
Route::post('/admin/banners', 'HalfAdminController@editBanners');

Route::get('/admin/seo', 'AdminController@seo');
Route::post('/admin/seo', 'AdminController@editSeo');

Route::get('/admin/settings', 'AdminController@settings');
Route::post('/admin/settings', 'AdminController@editSettings');

Route::get('/admin/areas/{slug?}', 'AdminController@areas');
Route::post('/admin/area', 'AdminController@editArea');
Route::post('/admin/delete-area', 'AdminController@deleteArea');

Route::get('/admin/organizations/{slug?}', 'AdminController@organizations');
Route::post('/admin/organization', 'AdminController@editOrganization');
Route::post('/admin/delete-organization', 'AdminController@deleteOrganizations');

Route::get('/admin/places/{slug?}', 'AdminController@places');
Route::post('/admin/place', 'AdminController@editPlace');
Route::post('/admin/delete-place', 'AdminController@deletePlace');

Route::get('/admin/sections/{slug?}', 'AdminController@sections');
Route::get('/admin/trainer-sections/{slug?}', 'AdminController@sections');
Route::post('/admin/section', 'AdminController@editSection');
Route::post('/admin/delete-section', 'AdminController@deleteSection');
Route::post('/admin/delete-trainer-section', 'AdminController@deleteTrainerSection');

Route::get('/admin/kind_of_sports', 'AdminController@kindOfSports');
Route::post('/admin/kind_of_sport', 'AdminController@editKindOfSports');
Route::post('/admin/delete-kind_of_sport', 'AdminController@deleteKindOfSports');

Route::get('/admin/events/{slug?}', 'AdminController@events');
Route::post('/admin/event', 'AdminController@editEvent');
Route::post('/admin/delete-event', 'AdminController@deleteEvent');

Route::post('/admin/delete-record-event', 'AdminController@deleteRecordEvent');
Route::post('/admin/delete-record-section', 'AdminController@deleteRecordSection');

Route::post('/admin/record-event-user', 'AdminController@recordEventUser');
Route::post('/admin/record-event-kid', 'AdminController@recordEventKid');

Route::post('/admin/record-section-user', 'AdminController@recordEventUser');
Route::post('/admin/record-section-kid', 'AdminController@recordEventKid');

Route::post('/admin/gallery', 'AdminController@editGallery');
Route::post('/admin/delete-gallery', 'AdminController@deleteGallery');

Route::get('/admin/messages', 'AdminController@messages');
Route::post('/admin/delete-message', 'AdminController@deleteMessage');

Route::get('/', 'StaticController@index');
Route::get('/blind', 'StaticController@setBlind');
Route::get('/news/{slug?}', 'StaticController@news');
Route::get('/area/{slug?}', 'StaticController@area');
Route::get('/events/{slug?}', 'StaticController@events');
Route::get('/organizations/{slug?}', 'StaticController@organization');
Route::get('/sections/{slug?}', 'StaticController@section');
Route::get('/places/{slug?}', 'StaticController@place');
Route::get('/trainers/{slug?}', 'StaticController@trainers');
Route::get('/kinds-of-sport', 'StaticController@kindsOfSport');

Route::get('/change-lang', 'StaticController@changeLang');
Route::post('/find-points', 'StaticController@findPoints');
Route::get('/search/{slug}', 'SearchController@search');

Route::get('/trainer/events/{slug?}', 'UserController@events');

Route::post('/delete-trainer-section', 'UserController@deleteTrainerSection');

Route::post('/event', 'UserController@editEvent');
Route::post('/event-user-record', 'UserController@eventUserRecord');
Route::post('/event-kids-record', 'UserController@eventKidsRecord');

Route::post('/section-user-record', 'UserController@sectionUserRecord');
Route::post('/section-kids-record', 'UserController@sectionKidsRecord');

Route::post('/delete-record-event', 'UserController@deleteRecordEvent');
Route::post('/delete-record-section', 'UserController@deleteRecordSection');