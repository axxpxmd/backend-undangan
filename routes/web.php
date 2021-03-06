<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    // Profile
    Route::namespace('Profile')->group(function () {
        Route::resource('profile', 'ProfileController');
        Route::get('profile/{id}/edit-password', 'ProfileController@editPassword')->name('profile.editPassword');
        Route::post('profile/{id}/update-password', 'ProfileController@updatePassword')->name('profile.updatePassword');
    });

    // Pengguna
    Route::namespace('Pengguna')->group(function () {
        Route::resource('pengguna', 'PenggunaController');
        Route::prefix('pengguna')->name('pengguna.')->group(function () {
            Route::post('pengguna/api', 'PenggunaController@api')->name('api');
            Route::get('{id}/edit-password', 'PenggunaController@editPassword')->name('editPassword');
            Route::post('{id}/update-password', 'PenggunaController@updatePassword')->name('updatePassword');
        });
    });
});
