<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/chating/{user}', 'HomeController@chat')->name('chating');
Route::post('/goaway', 'HomeController@goAway')->name('chat.goaway');
Route::get('/profile', 'HomeController@profile')->name('profile');
Route::post('/changeImg', 'HomeController@ChangeImg')->name('changeImg');


Route::resource('message', MessageController::class);


Route::get('message', 'MessageController@all')->name('all.message');