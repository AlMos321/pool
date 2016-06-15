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

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/', 'BookingController@index');

Route::get('/booking/get-time', 'BookingController@getTime');
Route::get('/booking/get-next-time', 'BookingController@getNextWeek');
Route::get('/booking/get-prev-time', 'BookingController@getPreviousWeek');
Route::get('/booking/get-str-time', 'BookingController@getStrTime');



Route::post('/order/create/', 'BookingController@store');

Route::post('/order/delete', 'ProfileNotesController@delete');

Route::auth();

Route::get('/home', 'HomeController@index');
