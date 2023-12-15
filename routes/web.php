<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\TableController;
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
    return view('index');
})->middleware('auth')->name('home');

Route::get('/login', function(){
    return view('login');
})->name('login');

Route::get('/register', function(){
    return view('register');
})->name('register');

Route::post('/account/register', [AccountController::class, 'register']);
Route::post('/account/login', [AccountController::class, 'login']);
Route::post('/account/logout', [AccountController::class, 'logout']);
Route::post('/account/update', [AccountController::class, 'update']);

Route::get('/account-management', [AccountController::class, 'index'])->name('accountManagement')->middleware('auth');

Route::get('/menu-management', function(){
    return view('index');
})->name('menuManagement');

Route::get('/inventory-management', function(){
    return view('index');
})->name('inventoryManagement');

Route::get('/bill-management', function(){
    return view('index');
})->name('billManagement');

Route::post('table/store', [TableController::class, 'store'])->name('table-store');
Route::post('table/edit', [TableController::class, 'edit'])->name('table-edit');
Route::post('table/destroy', [TableController::class, 'destroy'])->name('table-destroy');
Route::get('/table-management', [TableController::class, 'index'])->name('tableManagement');
