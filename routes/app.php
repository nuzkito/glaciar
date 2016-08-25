<?php

Route::get('/cursos', 'CoursesController@index')->name('course.index');
Route::get('/cursos/{id}', 'CoursesController@show')->name('course.show');

Route::get('/cursos/{id}/preguntas', 'QuestionsController@index')->name('question.index');
Route::get('/preguntas/{id}', 'QuestionsController@show')->name('question.show');
Route::post('/preguntas', 'QuestionsController@store')->name('question.store');
Route::get('/preguntas/{id}/editar', 'QuestionsController@edit')->name('question.edit');
Route::put('/preguntas/{id}', 'QuestionsController@update')->name('question.update');
Route::post('/preguntas/{id}/votar', 'QuestionVotesController@store')->name('question.vote');
Route::delete('/preguntas/{id}/eliminar-voto', 'QuestionVotesController@destroy')->name('question.unvote');

Route::post('/respuestas', 'AnswersController@store')->name('answer.store');
Route::get('/respuestas/{id}/editar', 'AnswersController@edit')->name('answer.edit');
Route::put('/respuestas/{id}', 'AnswersController@update')->name('answer.update');
Route::post('/respuestas/{id}/votar', 'AnswerVotesController@store')->name('answer.vote');
Route::delete('/respuestas/{id}/eliminar-voto', 'AnswerVotesController@destroy')->name('answer.unvote');

Route::get('/cursos/{id}/crear-contenido', 'ContentsController@create')->name('content.create');
Route::get('/contenidos/{id}', 'ContentsController@show')->name('content.show');
Route::post('/contenidos', 'ContentsController@store')->name('content.store');
Route::get('/contenidos/{id}/editar', 'ContentsController@edit')->name('content.edit');
Route::put('/contenidos/{id}', 'ContentsController@update')->name('content.update');
Route::delete('/contenidos/{id}', 'ContentsController@destroy')->name('content.destroy');

Route::get('/perfil', 'UserProfileController@edit')->name('profile.edit');
Route::put('/perfil', 'UserProfileController@update')->name('profile.update');
