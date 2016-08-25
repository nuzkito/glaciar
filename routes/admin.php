<?php

Route::get('/admin/usuarios', 'UsersController@index')->name('admin.user.index');
Route::get('/admin/usuarios/nuevo', 'UsersController@create')->name('admin.user.create');
Route::post('/admin/usuarios', 'UsersController@store')->name('admin.user.store');
Route::get('/admin/usuarios/{id}/editar', 'UsersController@edit')->name('admin.user.edit');
Route::put('/admin/usuarios/{id}', 'UsersController@update')->name('admin.user.update');
Route::delete('/admin/usuarios/{id}', 'UsersController@destroy')->name('admin.user.destroy');

Route::get('/admin/cursos', 'CoursesController@index')->name('admin.course.index');
Route::get('/admin/cursos/nuevo', 'CoursesController@create')->name('admin.course.create');
Route::post('/admin/cursos', 'CoursesController@store')->name('admin.course.store');
Route::get('/admin/cursos/{id}/editar', 'CoursesController@edit')->name('admin.course.edit');
Route::put('/admin/cursos/{id}', 'CoursesController@update')->name('admin.course.update');
Route::delete('/admin/cursos/{id}', 'CoursesController@destroy')->name('admin.course.destroy');
