<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new
#[Layout('layouts.registrar.appearance')]
#[Title('Registrar')]
 class extends Component
{
    //
};
?>

<div>
    <section id="info" class="container-fluid pt-4">

    <div class="card">

    <div class="card-header mb-3">
        <h1 class="card-title text-bold fs-3">Profile Information</h1>
    </div>
    
    <div class="card-body p-0"> 

         <div class="text-end">
            <button class="btn btn-primary btn-sm mx-3"><i class="bi bi-pencil-square"></i></button>
        </div>

        <x-adminlte-profile-widget class="elevation-4 my-3" name="{{ ucFirst(Auth::user()->name) }}" desc="Registrar"
        img="https://ui-avatars.com/api/?name={{ Auth::user()->name }}?background=random" cover="https://picsum.photos/id/541/550/200"
        header-class="text-white text-right" footer-class='bg-gradient-dark'>
        <x-adminlte-profile-row-item title="Caption Me!"
            class="text-center border-bottom border-secondary"/>
     
        </x-adminlte-profile-widget>  
    </div>
    </div>
        
    </section>
</div>