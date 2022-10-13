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

Route::group(['prefix' => '/teams', 'middleware' => 'checkLogin'], function () {
    Route::get('/search', [TeamController::class, 'search'])->name('teams.search');
    Route::get('/delete/{id}', [TeamController::class, 'destroy'])->name('teams.delete');

    Route::get('/edit/{id}', [TeamController::class, 'edit'])->name('teams.edit');
    Route::post('/edit_confirm/{id}', [TeamController::class, 'confirmEdit'])->name('teams.edit-confirm');
    Route::post('/update/{id}', [TeamController::class, 'update'])->name('teams.update');

    Route::get('/create', [TeamController::class, 'create'])->name('teams.create');
    Route::post('/create_confirm', [TeamController::class, 'confirmCreate'])->name('teams.create-confirm');
    Route::post('/create', [TeamController::class, 'store'])->name('teams.store');
});

Route::group(['prefix' => '/employee', 'middleware' => 'checkLogin'], function () {
    Route::get('/search', [EmployeeController::class, 'search'])->name('employee.search');
    Route::get('/delete/{id}', [EmployeeController::class, 'destroy'])->name('employee.delete');

    Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::post('/edit_confirm/{id}', [EmployeeController::class, 'confirmEdit'])->name('employee.edit-confirm');
    Route::post('/update/{id}', [EmployeeController::class, 'update'])->name('employee.update');

    Route::get('/create', [EmployeeController::class, 'create'])->name('employee.create');
    Route::post('/create_confirm', [EmployeeController::class, 'confirmCreate'])->name('employee.create-confirm');
    Route::post('/create', [EmployeeController::class, 'store'])->name('employee.store');

    Route::get('/reset', [EmployeeController::class, 'reset'])->name('employee.reset');

});
