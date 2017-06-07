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

Route::group(['middleware' => 'web'], function () {
    //Practitioner Auth Routes
    //Login Routes...
    Route::get('/logopedist/login','Practitioner\PractitionerAuth\LoginController@showLoginForm');
    Route::post('/logopedist/login','Practitioner\PractitionerAuth\LoginController@login');
    Route::get('/logopedist/logout','Practitioner\PractitionerAuth\LoginController@logout');

    // Registration Routes...
    Route::get('logopedist/register', ['as' => 'practitioner.register.show', 'uses' => 'Practitioner\PractitionerAuth\RegisterController@showRegistrationForm']);
    Route::post('logopedist/register', 'Practitioner\PractitionerAuth\RegisterController@register');

    Route::post('logopedist/password/email', 'Practitioner\PractitionerAuth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('logopedist/password/reset', 'Practitioner\PractitionerAuth\ResetPasswordController@reset');

    Route::get('/admin', 'AdminController@index');

    Route::post('/sql', 'HomeController@test');
    Route::post('/logopedist/checkIfExists', 'Practitioner\PractitionerAuth\RegisterController@test');
    Route::post('/logopedist/praktijk/checkIfExists', 'Practitioner\PractitionerAuth\RegisterController@checkIfPracticeExists');
    Route::post('/logopedist/nieuw', 'Practitioner\PractitionerAuth\RegisterController@register');

    Route::get('/logopedist/nieuw/redirect', 'Practitioner\PractitionerAuth\RegisterController@redirectToLanding');


    // practices
    Route::get('/practices/get/all', 'Practice\PracticeController@getAllExistingPractices');
    Route::post('/practices/get/with-id', 'Practice\PracticeController@getPracticeById');



    // USER ROUTES

    // User login
    Route::get('registreren', ['as' => 'user.register.show', 'uses' => 'User\UserAuth\RegisterController@showRegistrationForm']);
    Route::get('user/logout', 'User\UserAuth\LoginController@logout');
    Route::post('user/register', 'User\UserAuth\RegisterController@register');

});
