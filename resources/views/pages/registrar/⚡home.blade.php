<?php
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new 
#[Layout('layouts.registrar.dashboard')]
#[Title('Registrar')]
class extends Component
{
        
    public bool $showToast = false;

    public function mount()
    {
        if (session()->has('welcome')) {
            $this->showToast = true;
        }
    }


};
?>

<div >

    <section id="box-info" class="container-fluid pt-4">

    <h1>DASHBOARD</h1>

    <div class="container">
    <div class="row">
        <div class="col-sm">
        <x-adminlte-small-box title="424" text="Views" icon="fas fa-eye text-dark"
            theme="teal" url="#" url-text="View details"/>
        </div>
        <div class="col-sm">
        <x-adminlte-small-box title="424" text="Views" icon="fas fa-eye text-dark"
            theme="teal" url="#" url-text="View details"/>
        </div>
        <div class="col-sm">
         <x-adminlte-small-box title="424" text="Views" icon="fas fa-eye text-dark"
            theme="teal" url="#" url-text="View details"/>
        </div>
        
    </div>

     <div class="row">
        <div class="col-sm">
        <x-adminlte-small-box title="424" text="Views" icon="fas fa-eye text-dark"
            theme="teal" url="#" url-text="View details"/>
        </div>
        <div class="col-sm">
        <x-adminlte-small-box title="424" text="Views" icon="fas fa-eye text-dark"
            theme="teal" url="#" url-text="View details"/>
        </div>
        <div class="col-sm">
         <x-adminlte-small-box title="424" text="Views" icon="fas fa-eye text-dark"
            theme="teal" url="#" url-text="View details"/>
        </div>
    </div>

     
    </div>


    </section>

    
        <div wire:cloak wire:show="showToast" class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1055;">

        <x-adminlte-alert id='liveToast' icon="fas fa-user" title="System Notification" class="small">
            {{session('welcome')}} {{Auth::user()->first_name}}
        </x-adminlte-alert>

        </div>

        
</div>


<script>

        var liveToast = document.getElementById('liveToast');

        function startShow()
        {
            if (liveToast) {
                new bootstrap.Toast(liveToast).show();
            }
        }

        setTimeout(() => {
            startShow();
        }, 5000);

  

                
      



</script>