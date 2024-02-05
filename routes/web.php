<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SalesforceController;
use Illuminate\Support\Facades\Route;
use Omniphx\Forrest\Providers\Laravel\Facades\Forrest;
// use Illuminate\Support\Facades\Route;
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
    return view('employee');
});
Route::post('employee-add', [EmployeeController::class, 'employee_add']);
Route::get('employee-view', [EmployeeController::class, 'employee_view']);
Route::get('employee-delete', [EmployeeController::class, 'employee_delete']);
Route::post('employee-edit', [EmployeeController::class, 'employee_edit']);
Route::get('employee-list', [EmployeeController::class, 'employee_list']);



Route::view('address','address');  



Route::view('stripe','stripe');
Route::view('stripe_new','stripe_new');
Route::post('stripe_new',[OrderController::class,'stripe_new'])->name('stripe_new');
// Route::post('stripe_post',[OrderController::class,'stripe_post'])->name('stripe.post');



// Route::get('/salesforce/login', [SalesforceController::class, 'login']);
// Route::get('/salesforce/callback', [SalesforceController::class, 'callback']);
// Route::get('/salesforce/data', [SalesforceController::class, 'getData']);
Route::get('/salesforce', [SalesforceController::class, 'index']);



Route::get('/authenticate', function()
{
    $auth =  Forrest::authenticate();
    // dd($auth);
    return $auth;
});


Route::get('/oauth/callback/', function()
{
    Forrest::callback();
    return Redirect::to('/');
});

Route::get('/add', [SalesforceController::class, 'index']);
Route::get('/edit/{id}', [SalesforceController::class, 'edit']);
Route::get('/delete/{id}', [SalesforceController::class, 'delete']);