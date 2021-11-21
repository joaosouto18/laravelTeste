<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FrontController;
use App\Http\Controllers\LoginController;

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
    return view('home');
});

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logar', [LoginController::class, 'logar'])->name('logar');

Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/confirmLogin', [LoginController::class, 'confirmLogin'])->name('confirmLogin');
Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');

Route::get('/validate_cnpj', [LoginController::class, 'validate_cnpj'])->name('validate_cnpj');

