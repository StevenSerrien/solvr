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







    Route::get('/admin', 'AdminController@index');




    // practices
    Route::get('/practices/get/all', 'Practice\PracticeController@getAllExistingPractices');
    Route::post('/practices/get/with-id', 'Practice\PracticeController@getPracticeById');



    // USER ROUTES



    //Login Routes...



    // ADMIN Routes
    // Registration Routes...
    Route::get('/logopedist/dashboard', 'Practitioner\PractitionerController@index');

    Route::post('/logopedist/checkIfExists', 'Auth\PractitionerRegisterController@test');
    Route::post('/logopedist/praktijk/checkIfExists', 'Auth\PractitionerRegisterController@checkIfPracticeExists');
    Route::post('/logopedist/nieuw', 'Auth\PractitionerRegisterController@register');

    Route::get('/logopedist/nieuw/redirect', 'Auth\PractitionerRegisterController@redirectToLanding');

    Route::get('/logopedist/login','Auth\PractitionerLoginController@showLoginForm');
    Route::post('/logopedist/login','Auth\PractitionerLoginController@login');
    Route::get('/logopedist/logout','Auth\PractitionerLoginController@logout');

    Route::get('logopedist/register', ['as' => 'practitioner.register.show', 'uses' => 'Auth\PractitionerRegisterController@showRegistrationForm']);
    Route::post('logopedist/register', 'Auth\PractitionerRegisterController@register');


});

// User login
Route::get('/register', ['as' => 'user.register.show', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
Route::get('/logout', 'Auth\LoginController@logout');
Route::post('/register', 'Auth\RegisterController@register');


Route::get('/dashboard', 'User\UserController@index');
