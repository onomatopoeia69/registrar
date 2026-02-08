<?php
use App\Http\Controllers\CalendarController;
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
         // students
         Route::livewire('registrar/manage/students', 'pages::registrar.manage.all-students')->name('registrar.students.all');          
          //settings
         Route::livewire('registrar/settings/info', 'pages::registrar.settings.system')->name('registrar.system');
         Route::livewire('registrar/settings/appearance', 'pages::registrar.settings.appearance')->name('registrar.appearance');
         Route::livewire('registrar/settings/profile/info','pages::registrar.settings.profile.info')->name('registrar.info');
          // tools
         Route::livewire('registrar/tools/notes', 'pages::registrar.tools.notes')->name('registrar.tools.notes'); 
         Route::livewire('registrar/tools/recog', 'pages::registrar.tools.recog')->name('registrar.tools.recog');  
         Route::livewire('registrar/tools/calendar','pages::registrar.tools.calendar')->name('registrar.tools.calendar');
         Route::get('/api/calendar-events',[CalendarController::class,'show'])->name('calendar.show');
         Route::delete('/api/calendar-events/{}',[CalendarController::class,'destroy'])->name('calendar.destroy');

          

    });

    