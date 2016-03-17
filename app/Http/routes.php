<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/',  'WelcomeController@index');


Route::post('auth/login', 'AdvancedReg@postLogin');
Route::post('/', 'AdvancedReg@logout');


// Страница регистрации
//Route::get('regist', function() {
//    return View::make('home.regist');
//});

// Registration routes...
//Route::get('auth/register', 'AdvancedReg@register');    // ----- GET!!!!!!


// Страница
Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);


// Список курсов, добавление курса, добавление лого
Route::get('courses', ['as' => 'courses', 'uses' => 'HomeController@courses']);
Route::get('/courses/newcourse', 'HomeController@newcourse');

Route::post('courses/addCourse', ['as' => 'addCourse', 'uses' => 'HomeController@addCourse']);
Route::post('/courses/addLogo', 'HomeController@addLogo');
Route::post('lections/{id}/changeCourseDesc', 'HomeController@changeCourseDesc');
Route::post('lections/{id}/changeCourseReq', 'HomeController@changeCourseReq');
Route::post('lections/{id}/changeCourseWhom', 'HomeController@changeCourseWhom');

Route::get('course{id}/lections', ['as' => 'lections', 'uses' => 'HomeController@lections']);
Route::post('course{id}/addLection', ['as' => 'addLection', 'uses' => 'HomeController@addLection']);
Route::post('course/{id}/deleteLection', 'HomeController@deleteLection');

// Отображение контента выбранной лекции
Route::get('lections/{id}', ['as' => 'chosenlections', 'uses' => 'HomeController@chosenlections']);


Route::post('lections/{id}/addTable', 'HomeController@addTableRecord');
Route::post('lections/{id}/removeTable', 'HomeController@deleteTableRecord');


Route::post('lections/{id}/addVideo', 'HomeController@addVideo');
Route::post('lections/{id}/removeVideo', 'HomeController@deleteVideo');


// Изменение описания лекций/видео  --(lections / chosenlections)--
Route::post('lections/{id}/changeLecDesc', 'HomeController@changeLecDesc');
//Route::post('lections/{id}/changeVideoDesc', 'HomeController@changeVideoDesc');


//Route::post('lections/{id}/incremento', 'HomeController@incremVideo');
