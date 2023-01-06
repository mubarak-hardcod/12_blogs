<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\CustomeUserController;
use App\Http\Controllers\categoriesController;



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

Route::get('/', function () {return view('welcome');});

Route::get('dashboard1', [CustomAuthController::class, 'dashboard1']); 
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');





Route::group(['middleware' => ['auth']], function () { 
    Route::get('dashboard', [CustomeUserController::class,'dashboard'])->name('dashboard');
    Route::get('user_index', [CustomeUserController::class,'index'])->name('user_index');
    Route::get('user_create', [CustomeUserController::class,'create'])->name('user_create');
    Route::post('custom_create', [CustomeUserController::class,'store'])->name('custom_create'); 
    Route::get('user_detail/{id}', [CustomeUserController::class,'show'])->name('user_detail');
    Route::get('user_edit/{id}', [CustomeUserController::class,'edit'])->name('user_edit');
    Route::post('user_update/{id}', [CustomeUserController::class,'update'])->name('user_update');
    Route::post('user_delete/{id}', [CustomeUserController::class,'destroy'])->name('user_delete');

    Route::get('categories_index', [categoriesController::class,'index'])->name('categories_index');
    Route::get('categories_create', [categoriesController::class,'create'])->name('categories_create');
    Route::post('categories_create', [categoriesController::class,'store'])->name('categories_create'); 
    Route::get('categories_detail/{id}', [categoriesController::class,'show'])->name('categiroes_detail');
    Route::get('categories_edit/{id}', [categoriesController::class,'edit'])->name('categories_edit');
    Route::post('categories_update/{id}', [categoriesController::class,'update'])->name('categories_update');
    Route::post('categories_delete/{id}', [categoriesController::class,'destroy'])->name('catgeories_delete');

   
});












