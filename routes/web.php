<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PdfController;
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
Route::get('/billings/{ref_no?}', [BillingController::class, 'billingmanagementpage']);
Route::get('/billingmanagementattachments/{ref_no?}', [BillingController::class, 'billingmanagementattachments'])->name('billingmanagementattachments');
Route::get('/billingmanagementattachments/{ref_no?}/form1', [PdfController::class, 'generatePDFForm1']);
Route::get('/billingmanagementattachments/{ref_no?}/form2', [PdfController::class, 'generatePDFForm2']);
Route::get('/billingmanagementattachments/{ref_no?}/form3', [PdfController::class, 'generatePDFForm3']);
Route::get('/billings/{ref_no}/settings', [BillingController::class, 'getBillingSettings'])->name('getBillingSettings');
Route::post('/submitbilling', [BillingController::class, 'submitbilling'])->name('submitbilling');

Route::get('registers', 'App\Http\Controllers\Pagescontroller@registers')->name('registers');
Route::get('dashboard', 'App\Http\Controllers\Pagescontroller@dashboard')->middleware('auth')->name('dashboard');
Route::get('profile', 'App\Http\Controllers\Pagescontroller@profile')->name('profile')->middleware('auth');

//route for login
Auth::routes(['verify' => true]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//CRUD Enrolled
Route::post('/get-tempstudents', [BillingController::class, 'fetchTempStudent'])->name('fetchAll');
// Route::get('/get-tempstudenttable', [BillingController::class, 'fetchTempStudent'])->name('fetchAll');
Route::post('/newtempstudent', [BillingController::class, 'newTempStudent'])->name('newTempStudent')->middleware('validateNewTempStudent');
Route::post('/add-batchtempstudents', [BillingController::class, 'batchTempStudent']);
// Route::post('/add-batchtempstudents', [BillingController::class, 'batchTempStudent']);
// Route::post('/add-batchtempstudents', [BillingController::class, 'batchTempStudent']);
// Route::get('/edit-tempstudent', [BillingController::class, 'editTempStudent'])->name('editTempStudent')->middleware('validateEditTempStudent');
// Route::post('/add-batchtempstudents', [BillingController::class, 'batchTempStudent'])->middleware('validateTempStudent');
// Route::post('/add-batchtempstudents', [BillingController::class, 'batchTempStudent']);
Route::post('/finalize-billing', [BillingController::class, 'finalizeBilling']);
Route::get('/edit-tempstudent', [BillingController::class, 'editTempStudent'])->name('editTempStudent');
Route::post('/update-tempstudent', [BillingController::class, 'updateTempStudent'])->name('updateTempStudent')->middleware('validateUpdateTempStudent');
Route::delete('/delete-tempstudent', [BillingController::class, 'deleteTempStudent'])->name('deleteTempStudent');

//Autocomplete textbox
Route::get('/get-tuitionfee', [BillingController::class, 'findTuitionFee'])->name('findTuitionFee');
Route::get('/get-otherschoolfee', [BillingController::class, 'findOtherSchoolFees'])->name('findOtherSchoolFees');
Route::get('/get-nstpfee', [BillingController::class, 'findNSTPFee'])->name('findNSTPFee');

//Select inputs
Route::get('/get-degreeprograms', [BillingController::class, 'selectDegreePrograms'])->name('selectDegreePrograms');
Route::get('/get-campus', [BillingController::class, 'selectCampus'])->name('selectCampus');

//Updating links
Route::get('/editlink', [BillingController::class, 'editlink'])->name('editlink');//for single entry
Route::post('/updatelinkform1', [BillingController::class, 'updatelinkform1'])->name('updatelinkform1');//for single entry
Route::post('/updatelinkform2', [BillingController::class, 'updatelinkform2'])->name('updatelinkform2');//for single entry
Route::post('/updatelinkform3', [BillingController::class, 'updatelinkform3'])->name('updatelinkform3');//for single entry
Route::post('/updatelinknrc', [BillingController::class, 'updatelinknrc'])->name('updatelinknrc');//for single entry
Route::post('/updatelinkcor', [BillingController::class, 'updatelinkcor'])->name('updatelinkcor');//for single entry
Route::post('/updatelinkheibankcert', [BillingController::class, 'updatelinkheibankcert'])->name('updatelinkheibankcert');//for single entry
Route::post('/updatelinkbankcert', [BillingController::class, 'updatelinkbankcert'])->name('updatelinkbankcert');//for single entry

//Student Settings
//middleware for thottling (limit requests to 20 per min) and authentication
Route::middleware(['throttle:20,1'])->group(function () {
    Route::post('/get-studentfees', [BillingController::class, 'getStudentFees'])->name('getStudentFees');
    Route::post('/get-studentsettings', [BillingController::class, 'getStudentSettings'])->name('getStudentSettings');
    Route::post('/get-studentsettings', [BillingController::class, 'getStudentBillingSettings'])->name('getStudentBillingSettings');
    Route::post('/save-studentfee', [BillingController::class, 'toggleStudentFee'])->name('toggleStudentFee')->middleware('PreventEditingIfSubmitted');
});

//test
Route::get('/testchecker', [BillingController::class, 'checkBilling'])->name('checkBilling');
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

//Admin Pages
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
Route::get('admindashboard', 'App\Http\Controllers\AdminController@admindashboard')->name('admindashboard');

Route::get('manageuserslist', 'App\Http\Controllers\AdminController@manageuserslist')->name('manageuserslist');

Route::get('/manageuserpage/{hei_uii}', [AdminController::class, 'manageuserpage'])->name('manageuserpage');

//Routes for Lists
Route::get('/managebillinglist', [AdminController::class, 'managebillinglist'])->name('managebillinglist');
Route::get('/fetchbillinglist', [AdminController::class, 'fetchbillinglist'])->name('fetchbillinglist');
Route::get('/fetchuserlist', [AdminController::class, 'fetchuserlist'])->name('fetchuserlist');
Route::get('/fetchtosflist', [AdminController::class, 'fetchtosflist'])->name('fetchtosflist');

//Route for TOSF CRUD
Route::post('/import', [AdminController::class, 'import'])->name('import'); //for bulk uploading
Route::post('/newfee', [AdminController::class, 'newfee'])->name('newfee'); //for single entry
Route::get('/editfee', [AdminController::class, 'editfee'])->name('editfee');//for single entry
Route::post('/updatefee', [AdminController::class, 'updatefee'])->name('updatefee');//for single entry
Route::delete('/deletefee', [AdminController::class, 'deletefee'])->name('deletefee');//for single entry

Route::post('/openbilling', [AdminController::class, 'openbilling'])->name('openbilling');
Route::get('/managebillingpage/{reference_no}', [AdminController::class, 'managebillingpage'])->name('managebillingpage');

//formlist
Route::get('/form1/{reference_no}', [AdminController::class, 'form1'])->name('form1');
Route::get('/form2/{reference_no}', [AdminController::class, 'form2'])->name('form2');
Route::get('/fetchform2list', [AdminController::class, 'fetchform2list'])->name('fetchform2list');
Route::get('/viewstudentinfo', [AdminController::class, 'viewstudentinfo'])->name('viewstudentinfo');
// Route::post('/updateitemorder', [App\Http\Controllers\PurchaseOrderController::class, 'updateitemorder'])->name('updateitemorder')->middleware('auth');
Route::get('/form3/{reference_no}', [AdminController::class, 'form3'])->name('form3');
Route::get('/fetchform3list', [AdminController::class, 'fetchform3list'])->name('fetchform3list');
Route::get('/viewapplicantinfo', [AdminController::class, 'viewapplicantinfo'])->name('viewapplicantinfo');

//update billing status
Route::post('/forwardtoafms', [AdminController::class, 'forwardtoafms'])->name('forwardtoafms');
Route::post('/forrevision', [AdminController::class, 'forrevision'])->name('forrevision');
});

//pdf shit
Route::get('/get-pdf', [PdfController::class, 'generatePDF']);
Route::get('/generateForm3', [PdfController::class, 'generateForm3']);
Route::get('/generateForm2', [PdfController::class, 'generateForm2']);
Route::get('/generateForm1', [PdfController::class, 'generateForm1']);
Route::get('/phpinfo', function() {
    phpinfo();
});

//LETS FUCKING GO!