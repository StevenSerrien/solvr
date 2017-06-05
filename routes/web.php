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

Route::group(['middleware' => ['web']], function () {
    //Practitioner Auth Routes
    //Login Routes...
    Route::get('/logopedist/login','PractitionerAuth\LoginController@showLoginForm');
    Route::post('/logopedist/login','PractitionerAuth\LoginController@login');
    Route::get('/logopedist/logout','PractitionerAuth\LoginController@logout');

    // Registration Routes...
    Route::get('logopedist/register', ['as' => 'practitioner.register.show', 'uses' => 'PractitionerAuth\RegisterController@showRegistrationForm']);
    Route::post('logopedist/register', 'PractitionerAuth\RegisterController@register');

    Route::post('logopedist/password/email', 'Practitioner\ForgotPasswordController@sendResetLinkEmail');
    Route::post('logopedist/password/reset', 'Practitioner\ResetPasswordController@reset');

    Route::get('/admin', 'AdminController@index');

    Route::post('/sql', 'HomeController@test');

});
