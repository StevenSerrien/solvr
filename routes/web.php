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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

/**** Routes available for all visitors ****/
Route::get('/', ['as' => 'landing', 'uses' => 'HomeController@index']);
Route::get('/over-ons', ['as' => 'about', 'uses' => 'Page\PageController@viewAboutPage']);
Route::get('/info-voor-logopedisten', ['as' => 'therapists', 'uses' => 'Page\PageController@viewTherapistsPage']);
Route::get('/contact', ['as' => 'contact', 'uses' => 'Page\PageController@viewContactPage']);

// Route::get('media/{media}/download', ['as' => 'media_download', 'uses' => 'Media\MediaController@download']);
