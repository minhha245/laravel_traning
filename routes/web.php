<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AdminController;

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
    return view('dashboard');
})->middleware('checkLogin');
Auth::routes();

Route::get('dashboard', [AdminController::class, 'index'])->middleware('checkLogin');
Route::get('login', [CustomAuthController::class, 'login'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('logout', [CustomAuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'checkLogin'], function () {
    Route::group(['prefix' => '/teams', 'as' => 'teams.'], function () {
        Route::get('/search', [TeamController::class, 'search'])->name('search');
        Route::get('/delete/{id}', [TeamController::class, 'destroy'])->name('delete');

        Route::get('/edit/{id}', [TeamController::class, 'edit'])->name('edit');
        Route::post('/edit_confirm/{id}', [TeamController::class, 'confirmEdit'])->name('edit-confirm');
        Route::post('/update/{id}', [TeamController::class, 'update'])->name('update');

        Route::get('/create', [TeamController::class, 'create'])->name('create');
        Route::post('/create_confirm', [TeamController::class, 'confirmCreate'])->name('create-confirm');
        Route::post('/create', [TeamController::class, 'store'])->name('store');
    });

    Route::group(['prefix' => '/employee', 'as' => 'employee.'], function () {
        Route::get('/search', [EmployeeController::class, 'search'])->name('search');
        Route::get('/delete/{id}', [EmployeeController::class, 'destroy'])->name('delete');

        Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('edit');
        Route::post('/edit_confirm/{id}', [EmployeeController::class, 'confirmEdit'])->name('edit-confirm');
        Route::post('/update/{id}', [EmployeeController::class, 'update'])->name('update');

        Route::get('/create', [EmployeeController::class, 'create'])->name('create');
        Route::post('/create_confirm', [EmployeeController::class, 'confirmCreate'])->name('create-confirm');
        Route::post('/create', [EmployeeController::class, 'store'])->name('store');
        Route::get('/export_cvs', [EmployeeController::class, 'exportCSV'])->name('export');

        Route::get('/reset', [EmployeeController::class, 'reset'])->name('reset');

    });
});
