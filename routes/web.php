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

// page d'accueil
Route::get('/', 'FrontController@index')->name('homepage');

// route pour afficher un post, route sécurisée
Route::get('post/{id}', 'FrontController@show')->name('show')->where(['id' => '[0-9]+']);

Route::get('type/{type}', 'FrontController@type')->name('type');

// contact et mail
Route::get('contact', 'ContactController@show')->name('contact');
Route::post('contact',  'ContactController@mailToAdmin');

// Route for user search
Route::post('search', 'FrontController@search')->name('front.search');
Route::get('/home', 'HomeController@index')->name('home');

// route back
Auth::routes();

// Routes Sécurisées
Route::middleware(['auth'])->group(
    function () {
        Route::resource('admin/post', 'PostController');
        Route::get('status/{id}', 'PostController@status')->name('status');
        // Route for admin search
        Route::post('admin/search', 'PostController@search')->name('back.search');
        // deleteAll
        Route::delete('postDeleteAll', 'PostController@deleteAll')->name('delete');
    }
);
