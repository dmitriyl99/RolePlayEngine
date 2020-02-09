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
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/profile', 'UserController@index')->name('profile');
    Route::get('/profile/create', 'HeroController@createhero')->name('hero.create');
    Route::post('/profile/create', 'HeroController@storeHero');
    Route::get('/profile/{id}', 'UserController@show')->name('profile.show');
});

Route::post('/ckfinder/upload/image', 'HelperController@uploadCkfinderImage');
