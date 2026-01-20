<?php
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new 
#[Layout('layouts.registrar.dashboard')]
#[Title('Registrar')]
class extends Component
{
  
};
?>

<div class="container-fluid pt-4">

  

    <x-adminlte-card  title="Welcome" theme="primary" icon="fas fa-lg fa-fan">
        Hello! This is a Livewire component inside AdminLTE.
        <button wire:click="someAction" class="btn btn-success">Click Me</button>
    </x-adminlte-card>


    <div class="toast-container position-fixed  bottom-0 end-0 p-3" style="z-index: 1055;">

        
        @if (session('welcome'))

        <x-toast color="success" id='liveToast' text="white" time="{{session('time')}}" >
            {{session('welcome')}} <span class="text-red"> {{Auth::user()->first_name}}</span> 
        </x-toast>

        </div>
        @endif


    </div> 
        
</div>


<script>

        var liveToast = document.getElementById('liveToast');

        if (liveToast) {
            new bootstrap.Toast(liveToast).show();
        }

        var emailToast = document.getElementById('emailToast');
        if (emailToast) {
            new bootstrap.Toast(emailToast).show();
        }


</script>