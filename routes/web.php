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
Route::get('/', 'FrontController@index');

// route pour afficher un post, route sécurisée
Route::get('post/{id}', 'FrontController@show')->name('show')->where(['id' => '[0-9]+']);

Route::get('type/{type}', 'FrontController@type')->name('type');

// contact et mail
Route::get('contact', 'ContactController@show')->name('contact');
Route::post('contact',  'ContactController@mailToAdmin');

// route pour la recherche
Route::any('search', 'FrontController@search');

