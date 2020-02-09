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

Auth::routes();

Route::middleware(['role-play'])->group(function () {
    // Home route
    Route::get('/', 'HomeController@index')->name('home');

    // Profile routes
    Route::get('/profile', 'UserController@index')->name('profile');
    Route::get('/profile/create', 'HeroController@createhero')->name('hero.create');
    Route::post('/profile/create', 'HeroController@storeHero');
    Route::get('/profile/{id}', 'UserController@show')->name('profile.show');

    // Info routes
    Route::get('/profiles', 'InfoController@profiles')->name('profiles');
    Route::get('/profiles/{id}', 'InfoController@showProfile')->name('profiles.show');
});

Route::post('/ckfinder/upload/image', 'HelperController@uploadCkfinderImage');
