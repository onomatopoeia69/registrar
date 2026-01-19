<?php

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




// student login 




   Route::middleware('guest')->group( function() {

    // registrar login
    Route::livewire('registrar/login', 'pages::auth.login')->name('registrar.login');
  

    // student login 

   });

    Route::middleware(['auth'])->group( function() {
        
        Route::livewire('registrar/dashboard', 'pages::registrar.dashboard');  

    });

    