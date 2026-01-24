<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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

    Route::middleware(['auth','role:registrar'])->group( function() {
        
         Route::livewire('registrar/home', 'pages::registrar.home')->name('registrar.home'); 

          //settings
         Route::livewire('registrar/settings/info', 'pages::registrar.settings.system')->name('registrar.system'); 
         
          // tools
         Route::livewire('registrar/tools/notes', 'pages::registrar.tools.notes')->name('registrar.tools.notes'); 
         Route::livewire('registrar/tools/recog', 'pages::registrar.tools.recog')->name('registrar.tools.recog');  

    });

    