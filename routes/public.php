<?php

Route::get('/', 'HomeController@index')->name('index')->middleware('guest');

Route::post(
    '/login-with-random-user',
    'Auth\LoginController@loginWithRandomUser'
)->name('login-with-random-user')->middleware('guest');
