<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Auth;
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
// !other route
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/accounts/jsontable', [AccountController::class, 'jsontable'])->name('accounts.jsontable');
Route::get('/accounts/{id}/resetpassword', [AccountController::class, 'resetpassword'])->name('accounts.resetpassword');
// !resource route
Route::resource('accounts', AccountController::class);
Route::resource('holidays', HolidayController::class);
Route::resource('settings', SettingController::class);
Route::resource('reports', ReportController::class);
