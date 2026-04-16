<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\authController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReadController;


   Route::get('/', function () {
          return view('welcome');})->name('welcome');
    
   Route::get('/register', function () {
          return view('register');})->name('register'); 
   Route::post('/register', [authController::class, 'register'])->name('register');

   Route::get('/login', function () {
          return view('login');})->name('login');
   Route::post('/login', [authController::class, 'login'])->name('login');
    
   Route::post('/logout', [authController::class, 'logout'])->name('logout');


   Route ::middleware(['auth'])->group(function(){
   Route ::get('/create',function(){
           return view('create');})->name('create')->middleware('role:admin');
            Route ::post('/create',[AdminController::class,'create']); 
   Route::get('/read', [ReadController::class, 'index'])->name('read')->middleware('role:admin,user');});
   Route::get('/posts/{id}', [ReadController::class, 'show']); 
   Route::get('/posts/{id}/edit',[AdminController::class,'edit'])->name('edit')->middleware('role:admin');
   Route::put('/posts/{id}/edit',[AdminController::class,'update'])->name('update')->middleware('role:admin');
   Route::get('/posts/{id}/delete',[AdminController::class,'delete'])->name('delete')->middleware('role:admin');