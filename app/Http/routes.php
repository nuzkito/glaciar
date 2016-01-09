<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
// Route::get('/', function () {
//     return view('welcome');
// });


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    
    Route::auth();

    Route::get('/', 'HomeController@index')->middleware('guest');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/cursos', 'CoursesController@index');
        Route::get('/cursos/{id}', 'CoursesController@show');
        Route::get('/contenidos/{id}', 'ContentsController@show');
        Route::get('/cursos/{id}/preguntas', 'QuestionsController@index');
        Route::get('/preguntas/{id}', 'QuestionsController@show');
        Route::post('/preguntas', 'QuestionsController@store');
    });

    Route::group(['middleware' => ['auth', 'admin']], function () {
        Route::get('/admin/usuarios', 'Admin\UsersController@index');
        Route::get('/admin/usuarios/nuevo', 'Admin\UsersController@create');
        Route::post('/admin/usuarios', 'Admin\UsersController@store');
        Route::get('/admin/usuarios/{id}/edit', 'Admin\UsersController@edit');
        Route::put('/admin/usuarios/{id}', 'Admin\UsersController@update');
        Route::delete('/admin/usuarios/{id}', 'Admin\UsersController@destroy');

        Route::get('/admin/cursos', 'Admin\CoursesController@index');
        Route::get('/admin/cursos/nuevo', 'Admin\CoursesController@create');
        Route::post('/admin/cursos', 'Admin\CoursesController@store');
        Route::get('/admin/cursos/{id}/edit', 'Admin\CoursesController@edit');
        Route::put('/admin/cursos/{id}', 'Admin\CoursesController@update');
        Route::delete('/admin/cursos/{id}', 'Admin\CoursesController@destroy');
    });
});
