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






    // Colors

    Route::get('/colors/get-all', 'Color\ColorController@getAllColors');
    // Route::get('/admin', 'AdminController@index');
    //Subcategories
    Route::post('/subcatorgies/get/with-id', 'Subcategory\SubcategoryController@getAllSubcategoriesForCategory');



    // practices
    Route::get('/practices/get/all', 'Practice\PracticeController@getAllExistingPractices');
    Route::post('/practices/get/with-id', 'Practice\PracticeController@getPracticeById');
    Route::post('/practice/updatespecialities', 'Practice\PracticeController@updateSpecialities');
    Route::post('/practice/getcurrentspecialities', 'Practice\PracticeController@getSpecialities');
    Route::post('/practices/get/all-w-specialities', 'Practice\PracticeController@getPracticesBySpecialities');



    Route::post('/practice/contact', 'Contact\ContactController@contactPractice');




    // USER ROUTES



    //Login Routes...

    Route::get('/ik-zoek-een-logopedist', ['as' => 'search.practitioner.show', 'uses' => 'Search\SearchController@index']);


    // Contact your practitioner page
    Route::get('/contacteer-een-praktijk/{id}/{slug?}', ['as' => 'contact.practice', 'uses' => 'Contact\ContactController@index']);

    // ADMIN Routes
    // Registration Routes...


    Route::get('/logopedist/dashboard', ['as' => 'practitioner.dashboard', 'uses' => 'Practitioner\PractitionerController@index']);

    Route::post('/logopedist/checkIfExists', 'Auth\PractitionerRegisterController@test');
    Route::post('/logopedist/praktijk/checkIfExists', 'Auth\PractitionerRegisterController@checkIfPracticeExists');
    Route::post('/logopedist/nieuw', 'Auth\PractitionerRegisterController@register');

    Route::get('/logopedist/nieuw/redirect', 'Auth\PractitionerRegisterController@redirectToLanding');

    Route::get('/logopedist/login',['as' => 'practitioner.login.show', 'uses' => 'Auth\PractitionerLoginController@showLoginForm']);
    Route::post('/logopedist/login',['as' => 'practitioner.login.submit', 'uses' => 'Auth\PractitionerLoginController@login']);
    Route::get('/logopedist/logout','Auth\PractitionerLoginController@logout');

    Route::get('logopedist/register', ['as' => 'practitioner.register.show', 'uses' => 'Auth\PractitionerRegisterController@showRegistrationForm']);
    Route::post('logopedist/register', 'Auth\PractitionerRegisterController@register');

    Route::post('logopedist/test', 'Practitioner\PractitionerController@test');


    Route::get('/practice/getallpractitioners', 'Practice\PracticeController@getAllPractitionersForLoggedUser');

    // Route to accept practitioner to join practice. Only Practice admin can do this
    Route::post('/practitioner/acceptnew', 'Practitioner\PractitionerController@acceptPractitioner');
    Route::post('/practitioner/denynew', 'Practitioner\PractitionerController@denyPractitioner');

    // Notificaties voor logopedist
    Route::get('/logopedist/notificaties', ['as' => 'practitioner.notifications.show', 'uses' => 'Notifications\NotificationsController@showNotificationsForPractitioner']);
    Route::get('/logopedist/notificaties/read/all', ['as' => 'practitioner.notifications.read.all', 'uses' => 'Notifications\NotificationsController@markAllNotificationsAsRead']);
    Route::get('/logopedist/notificaties/read/{id}', ['as' => 'practitioner.notifications.read', 'uses' => 'Notifications\NotificationsController@markNotificationAsRead']);


    Route::get('/logopedist/oefeningen', ['as' => 'practitioners.exercises.show', 'uses' => 'Exercise\ExerciseController@index']);
    Route::post('/logopedist/oefeningen/opstellen/opslaan', 'Exercise\ExerciseController@createNew');
    Route::get('/logopedist/oefeningen/opstellen/{category_id}/{slug?}', ['as' => 'practitioners.exercises.make.show', 'uses' => 'Exercise\ExerciseController@showMake']);



    Route::get('/contacteer-een-praktijk/{id}/{slug?}', ['as' => 'contact.practice', 'uses' => 'Contact\ContactController@index']);

    Route::get('/logopedist/clienten', ['as' => 'practitioner.clients.show', 'uses' => 'Practitioner\PractitionerController@showClientsPage']);
    Route::get('/logopedist/clienten/add/{id}', ['as' => 'practitioner.clients.add', 'uses' => 'Practitioner\PractitionerController@addClients']);
    Route::get('/logopedist/clienten/remove/{id}', ['as' => 'practitioner.clients.remove', 'uses' => 'Practitioner\PractitionerController@removeClients']);






    // specialities
    Route::get('/specialities/getall', 'Speciality\SpecialityController@getAllSpecialities');




    // User login
    Route::get('/login', ['as' => 'user.login.show', 'uses' => 'Auth\LoginController@showLoginForm']);
    Route::get('/register', ['as' => 'user.register.show', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
    Route::get('/logout', 'Auth\LoginController@logout');
    Route::post('/register', 'Auth\RegisterController@register');


    Route::get('/dashboard', ['as' => 'user.dashboard', 'uses' => 'User\UserController@index']);
    Route::get('/dashboard/achievements', ['as' => 'user.achievements', 'uses' => 'User\UserController@showAchievementsPage']);
    Route::get('/dashboard/verbonden-met-logopedist', ['as' => 'user.connected', 'uses' => 'User\UserController@showConnectedPage']);
    Route::get('/dashboard/{id}/code-invoeren/{slug?}', ['as' => 'user.exercise.code.show', 'uses' => 'User\UserController@showExerciseCodePage']);




    Route::post('/test/test/test', 'Colorscheme\ColorschemeController@changeColorscheme');
    Route::post('/user/colorschemes/change', 'User\UserController@changeColorscheme');
    Route::get('/user/colorschemes/all', 'Colorscheme\ColorschemeController@getAllColorschemes');
    Route::get('/user/colorschemes/current', 'Colorscheme\ColorschemeController@getCurrentUserColorscheme');









});
