<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\UserController;


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
    return view('dashboard');
})->middleware('auth');

//billing CRUD
Route::put('/new-billing', [BillingController::class, 'newBilling'])->name('newBilling');
Route::put('/save-settings', [BillingController::class, 'saveSettings'])->name('saveSettings');
//Billing routes
Route::get('/billings', [BillingController::class, 'billingList'])->name('billings');
Route::get('/billings/{ref_no?}', [BillingController::class, 'billingmanagement']);
Route::get('/billings/{ref_no}/settings', [BillingController::class, 'getBillingSettings'])->name('getBillingSettings');

Route::get('registers', 'App\Http\Controllers\Pagescontroller@registers')->name('registers');
Route::get('dashboard', 'App\Http\Controllers\Pagescontroller@dashboard')->name('dashboard')->middleware('auth');
Route::get('profile', 'App\Http\Controllers\Pagescontroller@profile')->name('profile')->middleware('auth');

//route for login
Auth::routes(['verify' => true]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//CRUD Enrolled
Route::get('/get-tempstudents', [BillingController::class, 'fetchTempStudent'])->name('fetchAll');
Route::post('/newtempstudent', [BillingController::class, 'newTempStudent'])->name('newTempStudent');
Route::post('/add-batchtempstudents', [BillingController::class, 'batchTempStudent']);
Route::get('/edit-tempstudent', [BillingController::class, 'editTempStudent'])->name('editTempStudent');
Route::post('/update-tempstudent', [BillingController::class, 'updateTempStudent'])->name('updateTempStudent');
Route::delete('/delete-tempstudent', [BillingController::class, 'deleteTempStudent'])->name('deleteTempStudent');

//Autocomplete textbox
Route::get('/get-tuitionfee', [BillingController::class, 'findTuitionFee'])->name('findTuitionFee');
Route::get('/get-otherschoolfee', [BillingController::class, 'findOtherSchoolFees'])->name('findOtherSchoolFees');
Route::get('/get-nstpfee', [BillingController::class, 'findNSTPFee'])->name('findNSTPFee');

//Select inputs
Route::get('/get-degreeprograms', [BillingController::class, 'selectDegreePrograms'])->name('selectDegreePrograms');
Route::get('/get-campus', [BillingController::class, 'selectCampus'])->name('selectCampus');

//Test
Route::post('/get-studentfees', [BillingController::class, 'getStudentFees'])->name('getStudentFees');
Route::post('/get-studentsettings', [BillingController::class, 'getStudentSettings'])->name('getStudentSettings');
Route::get('/testchecker', [BillingController::class, 'checkBilling'])->name('checkBilling');
Route::post('/testtoggle', [BillingController::class, 'toggleStudentFee'])->name('toggleStudentFee');
Route::post('/testgetstudentsettings', [BillingController::class, 'getStudentBillingSettings'])->name('getStudentBillingSettings');
Route::get('/test', function () {
    return view('afms/dashboard');
});

//Billing Checker
Route::post('/queueBilling', [BillingController::class, 'queueBillingForChecking'])->name('queueBillingForChecking');
Route::post('/fetchTemplateData', [BillingController::class, 'getSheetTemplate'])->name('fetchTemplateData');
Route::get('/fetchTemplate', [BillingController::class, 'downloadSheetTemplate'])->name('downloadTemplate');

//Users Profile Routes
Route::get('/get-user', [UserController::class, 'fetchUser'])->name('fetchUser');
Route::get('/get-heis', [UserController::class, 'fetchHeis'])->name('fetchHeis');
Route::post('/update-user', [UserController::class, 'updateUser'])->name('updateUser');

//Summary
Route::get('/get-tempsummary', [BillingController::class, 'fetchTempSummary'])->name('fetchTempSummary');

//CRUD Applicants
Route::get('/get-tempapplicants', [BillingController::class, 'fetchTempApplicants'])->name('fetchTempApplicants');
Route::post('/newtempapplicants', [BillingController::class, 'newTempApplicant'])->name('newTempApplicant');

//Exception Report
Route::get('/get-tempexceptions', [BillingController::class, 'fetchTempExceptions'])->name('fetchTempExceptions');
