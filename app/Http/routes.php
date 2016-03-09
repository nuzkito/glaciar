<?php

Route::group(['middleware' => 'web'], function () {

    Route::auth();

    Route::get('/', [
        'as' => 'index',
        'uses' => 'HomeController@index',
    ])->middleware('guest');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/cursos', [
            'as' => 'course.index',
            'uses' => 'CoursesController@index',
        ]);
        Route::get('/cursos/{id}', [
            'as' => 'course.show',
            'uses' => 'CoursesController@show',
        ]);

        Route::get('/cursos/{id}/preguntas', [
            'as' => 'question.index',
            'uses' => 'QuestionsController@index',
        ]);
        Route::get('/preguntas/{id}', [
            'as' => 'question.show',
            'uses' => 'QuestionsController@show',
        ]);
        Route::post('/preguntas', [
            'as' => 'question.store',
            'uses' => 'QuestionsController@store',
        ]);
        Route::get('/preguntas/{id}/editar', [
            'as' => 'question.edit',
            'uses' => 'QuestionsController@edit',
        ]);
        Route::put('/preguntas/{id}', [
            'as' => 'question.update',
            'uses' => 'QuestionsController@update',
        ]);

        Route::post('/respuestas', [
            'as' => 'answer.store',
            'uses' => 'AnswersController@store',
        ]);
        Route::get('/respuestas/{id}/editar', [
            'as' => 'answer.edit',
            'uses' => 'AnswersController@edit',
        ]);
        Route::put('/respuestas/{id}', [
            'as' => 'answer.update',
            'uses' => 'AnswersController@update',
        ]);

        Route::get('/cursos/{id}/crear-contenido', [
            'as' => 'content.create',
            'uses' => 'ContentsController@create',
        ]);
        Route::get('/contenidos/{id}', [
            'as' => 'content.show',
            'uses' => 'ContentsController@show',
        ]);
        Route::post('/contenidos', [
            'as' => 'content.store',
            'uses' => 'ContentsController@store',
        ]);
        Route::get('/contenidos/{id}/editar', [
            'as' => 'content.edit',
            'uses' => 'ContentsController@edit',
        ]);
        Route::put('/contenidos/{id}', [
            'as' => 'content.update',
            'uses' => 'ContentsController@update',
        ]);
        Route::delete('/contenidos/{id}', [
            'as' => 'content.destroy',
            'uses' => 'ContentsController@destroy',
        ]);

        Route::get('/perfil', [
            'as' => 'profile.edit',
            'uses' => 'UserProfileController@edit',
        ]);
        Route::put('/perfil', [
            'as' => 'profile.update',
            'uses' => 'UserProfileController@update',
        ]);
    });

    Route::group(['middleware' => ['auth', 'admin']], function () {
        Route::get('/admin/usuarios', [
            'as' => 'admin.user.index',
            'uses' => 'Admin\UsersController@index',
        ]);
        Route::get('/admin/usuarios/nuevo', [
            'as' => 'admin.user.create',
            'uses' => 'Admin\UsersController@create',
        ]);
        Route::post('/admin/usuarios', [
            'as' => 'admin.user.store',
            'uses' => 'Admin\UsersController@store',
        ]);
        Route::get('/admin/usuarios/{id}/editar', [
            'as' => 'admin.user.edit',
            'uses' => 'Admin\UsersController@edit',
        ]);
        Route::put('/admin/usuarios/{id}', [
            'as' => 'admin.user.update',
            'uses' => 'Admin\UsersController@update',
        ]);
        Route::delete('/admin/usuarios/{id}', [
            'as' => 'admin.user.destroy',
            'uses' => 'Admin\UsersController@destroy',
        ]);

        Route::get('/admin/cursos', [
            'as' => 'admin.course.index',
            'uses' => 'Admin\CoursesController@index',
        ]);
        Route::get('/admin/cursos/nuevo', [
            'as' => 'admin.course.create',
            'uses' => 'Admin\CoursesController@create',
        ]);
        Route::post('/admin/cursos', [
            'as' => 'admin.course.store',
            'uses' => 'Admin\CoursesController@store',
        ]);
        Route::get('/admin/cursos/{id}/editar', [
            'as' => 'admin.course.edit',
            'uses' => 'Admin\CoursesController@edit',
        ]);
        Route::put('/admin/cursos/{id}', [
            'as' => 'admin.course.update',
            'uses' => 'Admin\CoursesController@update',
        ]);
        Route::delete('/admin/cursos/{id}', [
            'as' => 'admin.course.destroy',
            'uses' => 'Admin\CoursesController@destroy',
        ]);
    });
});
