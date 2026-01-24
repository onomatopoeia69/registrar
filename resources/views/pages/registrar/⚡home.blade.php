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
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title text-bold fs-3">Dashboard Overview</h3>
        </div>

        <div class="card-body">
            <div class="row">
                
                <div class="col-lg-4 col-6">
                    <x-adminlte-small-box title="0" text="Total Users" 
                        icon="fas fa-users text-dark" theme="teal" 
                        url="#" url-text="View details"/>
                </div>

                <div class="col-lg-4 col-6">
                    <x-adminlte-small-box title="0" text="Page Views" 
                        icon="fas fa-eye text-dark" theme="info" 
                        url="#" url-text="View details"/>
                </div>

                <div class="col-lg-4 col-6">
                    <x-adminlte-small-box title="0" text="Revenue" 
                        icon="fas fa-shopping-cart text-dark" theme="success" 
                        url="#" url-text="View details"/>
                </div>
            </div>
            
            <div class="row">
                </div>
        </div>
    </div>
</section>

    
     
        @if(session('welcome'))
        <x-toast id="liveToast" color="primary">{{ session('welcome') }}  {{ Auth::user()->name }}</x-toast>
        @endif

        
</div>

@script
<script>

        setTimeout(() => {
           $('#liveToast').toast('show');
        }, 5000);


</script>
@endscript