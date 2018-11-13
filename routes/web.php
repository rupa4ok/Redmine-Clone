<?php

Route::get('/', 'GuestController@index')->name('index');
Route::get('/members', 'GuestController@showMembers')->name('members');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('account', 'AccountController')->except([
    'create', 'store', 'show', 'edit'
])->parameters([
    'account' => 'account?'
]);
Route::get('/account/edit/', 'AccountController@edit')->name('account.edit');
//Route::put('/account/{account?}', 'AccountController@update')->name('account.update');
//Route::delete('/account/{account?}', 'AccountController@destroy')->name('account.delete');
Route::put('/account/changePassword', 'AccountController@changePassword')->name('account.changePassword');

Route::resource('statuses', 'TaskStatusController');
Route::resource('tasks', 'TaskController');
