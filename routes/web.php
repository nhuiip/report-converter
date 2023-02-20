<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TeamController;
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
Route::get('/accounts/{id}/resetpassword', [AccountController::class, 'resetpassword'])->name('accounts.resetpassword');
// !data-table
Route::get('/accounts/jsontable', [AccountController::class, 'jsontable'])->name('accounts.jsontable');
Route::get('/teams/jsontable', [TeamController::class, 'jsontable'])->name('teams.jsontable');
Route::get('/holidays/jsontable', [HolidayController::class, 'jsontable'])->name('holidays.jsontable');
Route::get('/histories/jsontable', [HistoryController::class, 'jsontable'])->name('histories.jsontable');
// !resource route
Route::resource('accounts', AccountController::class);
Route::resource('teams', TeamController::class);
Route::resource('holidays', HolidayController::class);
Route::resource('histories', HistoryController::class);
Route::resource('reports', ReportController::class);
