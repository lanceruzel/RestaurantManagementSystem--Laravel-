<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\MenuCategoryController;
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

Route::get('/inventory-management', function(){
    return view('index');
})->name('inventoryManagement');

Route::get('/bill-management', function(){
    return view('index');
})->name('billManagement');

Route::controller(TableController::class)->middleware('auth')->group(function(){
    Route::post('table/store', 'store')->name('table-store');
    Route::post('table/edit', 'edit')->name('table-edit');
    Route::post('table/destroy', 'destroy')->name('table-destroy');
    Route::get('/table-management', 'index')->name('tableManagement');
});

Route::controller(MenuCategoryController::class)->middleware('auth')->group(function(){
    Route::get('/menu-management', 'index')->name('menu-management');
    Route::post('/menu-management/cagetory/store', 'store')->name('category-store');
    Route::post('/menu-management/cagetory/edit', 'edit')->name('category-edit');
    Route::post('/menu-management/cagetory/destroy', 'destroy')->name('category-destroy');
});



