<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\CustomeUserController;
use App\Http\Controllers\categoriesController;
use App\Http\Controllers\tagController;
use App\Http\Controllers\postController;
use App\Http\Controllers\blogController;
use App\Http\Controllers\authsController;


Route::get('dashboard1', [CustomAuthController::class, 'dashboard1']); 
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');


Route::get('authslogin', [authsController::class, 'index'])->name('authslogin');
Route::any('authslogin_custom', [authsController::class, 'customLogin'])->name('authslogin_custom'); 
Route::get('authsregister-user', [authsController::class, 'registration'])->name('authsregister-user');
Route::post('authscustom-registration', [authsController::class, 'customRegistration'])->name('authsregister.custom'); 
Route::get('authssignout', [authsController::class, 'signOut'])->name('authssignout');
Route::get('resetpassword', [authsController::class, 'resetpassword'])->name('resetpassword');


Route::get('/', [blogController::class,'blog_main']);
Route::get('post/{slug}', [blogController::class,'postslug'])->name('post');


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

    Route::get('tag_index', [tagController::class,'index'])->name('tag_index');
    Route::get('tag_create', [tagController::class,'create'])->name('tag_create');
    Route::post('tag_create', [tagController::class,'store'])->name('tag_create'); 
    Route::get('tag_detail/{id}', [tagController::class,'show'])->name('tag_detail');
    Route::get('tag_edit/{id}', [tagController::class,'edit'])->name('tag_edit');
    Route::post('tag_update/{id}', [tagController::class,'update'])->name('tag_update');
    Route::post('tag_delete/{id}', [tagController::class,'destroy'])->name('tag_delete');

    Route::get('post_index', [postController::class,'index'])->name('post_index');
    Route::get('post_create', [postController::class,'create'])->name('post_create');
    Route::post('post_create', [postController::class,'store'])->name('post_create'); 
    Route::get('post_detail/{id}', [postController::class,'show'])->name('post_detail');
    Route::get('post_edit/{id}', [postController::class,'edit'])->name('post_edit');
    Route::post('post_update/{id}', [postController::class,'update'])->name('post_update');
    Route::post('post_delete/{id}', [postController::class,'destroy'])->name('post_delete');  

   
});
















