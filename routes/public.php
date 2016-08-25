<?php

Route::get('/', 'HomeController@index')->name('index')->middleware('guest');
