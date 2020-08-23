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

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware(['role-play'])->group(function () {
    // Home route
    Route::get('/', 'HomeController@index')->name('home');

    // Profile routes
    Route::get('/user', 'UserController@index')->name('profile');
    Route::get('/profile/create', 'HeroController@createhero')->name('hero.create');
    Route::post('/profile/create', 'HeroController@storeHero');
    Route::get('/user/{user}', 'UserController@show')->name('profile.show');

    // Info routes
    Route::get('/profiles', 'InfoController@profiles')->name('profiles');
    Route::get('/profiles/{id}', 'InfoController@showProfile')->name('profiles.show');

    Route::post('/profiles/{profileId}/confirm', 'HeroController@confirmProfile')->name('profiles.confirm');

    Route::get('/notifications/markAsRead', 'NotificationsController@markAsRead');

    Route::namespace('Admin')->name('admin.')->middleware(['auth'])->group(function () {
        Route::resource('locations', 'LocationController');
        Route::resource('areas', 'AreaController');
        Route::resource('places', 'PlaceController');
    });

    Route::post('post', 'RpgController@createPost')->name('post.create');
    Route::get('{slug}', 'LocationsController@area')->name('area');
    Route::get('{areaSlug}/{locationSlug}', 'LocationsController@location')->name('location');
    Route::get('{areaSlug}/{locationSlug}/{placeSlug}', 'LocationsController@locationPlace')->name('place');
});

Route::post('/ckfinder/upload/image', 'HelperController@uploadCkfinderImage');
