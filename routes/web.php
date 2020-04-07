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

Route::get('/', 'HomeController@index')->name('index');

Route::get('/reservation', 'ReservationController@index')->name('reservation.index');
Route::post('/reservation', 'ReservationController@reserv')->name('reservation.reserv');
Route::get('/contact','ContactController@index')->name('contact.index');
Route::post('/contact','ContactController@sendMessage')->name('contact.send');

Auth::routes(['register' => false]);

Route::get('admin', function (){
    return redirect()->route('admin.dashboard');
});

Route::group(['prefix'=>'admin', 'middleware'=> ['auth'], 'namespace'=>'admin'], function(){
    Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');
    Route::resource('slider', 'SliderController');
    Route::resource('menu-category', 'MenuCategoryController');
    Route::resource('menu-items', 'MenuController');
    //Reservation block
    Route::get('reservation', 'ReservationController@index')->name('admin-reservation.index');
    Route::post('reservation/{id}','ReservationController@status')->name('admin-reservation.status');
    Route::delete('reservation/{id}','ReservationController@destroy')->name('admin-reservation.destroy');
    //

    Route::get('contact','ContactController@index')->name('admin-contact.index');
    Route::get('contact/{id}','ContactController@show')->name('admin-contact.show');
    Route::delete('contact/{id}','ContactController@destroy')->name('admin-contact.destroy');
});



