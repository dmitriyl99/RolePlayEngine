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

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('banned', [HomeController::class, 'banned'])->name('banned');

Route::middleware(['role-play', 'ban'])->group(function () {
    // Home route
    Route::get('/', 'HomeController@index')->name('home');

    // Profile routes
    Route::get('/user', 'UserController@index')->name('profile');
    Route::post('/user/avatar', [UserController::class, 'changeAvatar'])->name('user.avatar');
    Route::prefix('user')->group(function () {
        Route::resource('messages', 'MessageController');
    });
    Route::get('/hero/create', 'HeroController@createhero')->name('hero.create');
    Route::post('/hero/create', 'HeroController@storeHero');
    Route::get('/hero/{heroId}/edit', 'HeroController@editHero')->name('hero.edit');
    Route::put('/hero/{heroId}/edit', 'HeroController@updateHero')->name('hero.update');
    Route::get('/hero/{heroId}/pda/create', 'HeroController@createPda')->name('hero.pda.create');
    Route::post('/hero/{heroId}/pda/create', 'HeroController@storePda')->name('hero.pda.store');
    Route::get('/hero/{heroId}/pda', 'HeroController@editPda')->name('hero.pda.show');
    Route::put('/hero/{heroId}/pda', 'HeroController@updatePda')->name('hero.pda.update');
    Route::get('/user/{user}', 'UserController@show')->name('profile.show');
    Route::post('/user/{user}/ban', [UserController::class, 'ban'])->name('user.ban');
    Route::post('/user/{user}/unban', [UserController::class, 'unban'])->name('user.unban');

    // Info routes
    Route::get('/profiles', 'InfoController@profiles')->name('profiles');
    Route::get('/profiles/{id}', 'InfoController@showProfile')->name('profiles.show');
    Route::get('pdas', [InfoController::class, 'pdas'])->name('pdas');

    Route::post('/profiles/{profileId}/confirm', 'HeroController@confirmProfile')->name('profiles.confirm');
    Route::post('/profiles/{profileId}/correction', 'HeroController@makeProfileCorrection')->name('profiles.correction');
    Route::post('/profiles/correction/{id}/mark-as-correct', 'HeroController@correctProfileCorrection')->name('profiles.correction.correct');

    Route::get('/notifications/markAsRead', 'NotificationsController@markAsRead');

    Route::namespace('Admin')->name('admin.')->middleware(['auth'])->group(function () {
        Route::resource('locations', 'LocationController');
        Route::resource('areas', 'AreaController');
        Route::resource('places', 'PlaceController');
        Route::resource('encyclopedia', 'EncyclopediaController');
        Route::resource('articles', 'ArticleController');
    });

    Route::post('post', 'RpgController@createPost')->name('post.create');
    Route::get('post/{postId}', 'RpgController@editPost')->name('post.edit');
    Route::put('post/{postId}', 'RpgController@updatePost')->name('post.update');
    Route::delete('post/{postId}', 'RpgController@deletePost')->name('post.delete');
    Route::get('{slug}', 'LocationsController@area')->name('area');
    Route::get('{areaSlug}/{locationSlug}', 'LocationsController@location')->name('location');
    Route::get('{areaSlug}/{locationSlug}/{placeSlug}', 'LocationsController@locationPlace')->name('place');
});

Route::post('/ckfinder/upload/image', 'HelperController@uploadCkfinderImage');
