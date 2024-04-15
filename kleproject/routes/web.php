<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

//User
Route::get('/register' , [UserController::class , 'create']);
Route::post('/register', [UserController::class , 'store'])->name('register');;
Route::get('/', [UserController::class , 'login'])->name('open');
Route::post('/login', [UserController::class , 'login']);
Route::get('/logout', [UserController::class , 'logout'])->name('logout');



//  Product 
Route::get('/urun', [ProductController::class,'index']);
Route::resource('product', ProductController::class);
Route::get('/login',  [UserController::class , 'login'])->name('login');


