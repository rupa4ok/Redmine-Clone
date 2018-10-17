<?php

use Illuminate\Support\Facades\Log;

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

Route::get('/', function () {
    \Log::error('Something went wrong', [
        'person' => ['id' => (string)123, 'username' => 'John Doe', 'email' => 'john@doe.com']
    ]);
    return view('welcome');
});
