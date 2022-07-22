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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('something/{name}', function ($name) {
//     return "something".$name;
// });

// Route::get('something/{name?}', function ($name='something') {
//     return "something".$name;
// });

// Route::group(['prefix' => 'admin'], function(){
//     Route::get('dashboard',function(){
//         return "dashboard";
//     });
// });

// Route::get('contactus', 'App\Http\Controllers\Pagescontroller@contactus');
// Route::get('aboutus', 'App\Http\Controllers\Pagescontroller@aboutus');
// Route::resource('blog', 'App\Http\Controllers\Pagescontroller'); 

Route::get('/', function () {
    return view('index');
});
Route::get('index', 'App\Http\Controllers\Pagescontroller@index')->name('index');
Route::get('listofbillings', 'App\Http\Controllers\Pagescontroller@listofbillings')->name('listofbillings');
Route::get('billingmanagement', 'App\Http\Controllers\Pagescontroller@billingmanagement')->name('billingmanagement');
Route::get('dashboard', 'App\Http\Controllers\Pagescontroller@dashboard')->name('dashboard');
Route::get('profile', 'App\Http\Controllers\Pagescontroller@profile')->name('profile');

//routes ni migs na pang testing
Route::get('/testing', function () {
    return view('billingmanagement');
});