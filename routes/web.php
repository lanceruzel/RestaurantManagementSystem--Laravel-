<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\MenuCategoryController;
use App\Http\Controllers\MenuController;
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

Route::controller(AccountController::class)->group(function(){
    Route::post('/account/register', [AccountController::class, 'register']);
    Route::post('/account/login', [AccountController::class, 'login']);
    Route::post('/account/logout', [AccountController::class, 'logout']);
    Route::post('/account/update', [AccountController::class, 'update']);
});

Route::get('/inventory-management', function(){
    return view('index');
})->name('inventoryManagement');

Route::get('/bill-management', function(){
    return view('index');
})->name('billManagement');

Route::controller(AccountController::class)->middleware('auth')->group(function(){
    Route::get('/account-management', 'index')->name('account-management');
    Route::post('/account-management/view', 'viewInfos')->name('account-view');
    Route::post('/account-management/personal-update', 'updatePersonal')->name('account-personal-update');
    Route::post('/account-management/account-update', 'updateAccount')->name('account-update');
    Route::post('/account-management/account-destroy', 'destroy')->name('account-destroy');
});

Route::controller(TableController::class)->middleware('auth')->group(function(){
    Route::get('/table-management', 'index')->name('table-management');
    Route::post('table/store', 'store')->name('table-store');
    Route::post('table/edit', 'edit')->name('table-edit');
    Route::post('table/destroy', 'destroy')->name('table-destroy');
});

Route::controller(MenuController::class)->middleware('auth')->group(function(){
    Route::get('/menu-management', 'index')->name('menu-management');
    Route::post('/menu-management/store', 'store')->name('menu-store');
    Route::post('/menu-management/edit', 'edit')->name('menu-edit');
    Route::post('/menu-management/destroy', 'destroy')->name('menu-destroy');
});

Route::controller(MenuCategoryController::class)->middleware('auth')->group(function(){
    Route::get('/menu-management/category', 'index')->name('category-view');
    Route::POST('/menu-management/category-select', 'all')->name('category-all');
    Route::post('/menu-management/cagetory/store', 'store')->name('category-store');
    Route::post('/menu-management/cagetory/edit', 'edit')->name('category-edit');
    Route::post('/menu-management/cagetory/destroy', 'destroy')->name('category-destroy');
});