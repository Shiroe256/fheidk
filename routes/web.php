<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\BillingController;


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
    return view('billingmanagementcopy');
});

//route for login
// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//CRUD Routes
<<<<<<< HEAD
Route::get('/get-tempstudents', [BillingController::class, 'fetchTempStudent'])->name('fetchAll');
Route::post('/newtempstudent', [BillingController::class, 'newTempStudent'])->name('newTempStudent');
=======
Route::get('get-tempstudents',[BillingController::class,'fetchTempStudent']);
Route::post('/add-tempstudents',[BillingController::class,'batchTempStudent']);
>>>>>>> 67673b7ae76a6939005330d80f2069e7fd4e0207
