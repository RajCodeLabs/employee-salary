<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SalaryController;
use App\Http\Middleware\CheckAuth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('login', [AuthController::class,'login'])->name('login');
Route::get('register', [AuthController::class,'register'])->name('register');
Route::post('signin', [AuthController::class,'signin'])->name('signin');
Route::post('signup', [AuthController::class,'signup'])->name('signup');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');


Route::group(['prefix'=> 'salary', 'middleware' => ['checkauth'] , 'as' => 'salary.'], function () {
    Route::get('all', [SalaryController::class,'index'])->name('index');
    
    Route::get('add', [SalaryController::class,'create'])->name('create');
    Route::post('add', [SalaryController::class,'store'])->name('store');

    Route::get('edit/{id}', [SalaryController::class,'edit'])->name('edit');
    Route::post('edit/{id}', [SalaryController::class,'update'])->name('update');

    Route::post('delete/{id}', [SalaryController::class,'destroy'])->name('destroy');
});