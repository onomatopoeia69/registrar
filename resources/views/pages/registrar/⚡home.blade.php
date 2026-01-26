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
                    <x-adminlte-small-box title="0" text="Enrolled Students" 
                        icon="fas fa-users text-dark" theme="teal" 
                        url="#" url-text="View details"/>
                </div>

                <div class="col-lg-4 col-6">
                    <x-adminlte-small-box title="0" text="New Enrollees" 
                        icon="fas bi-people-fill text-dark" theme="info" 
                        url="#" url-text="View details"/>
                </div>

                <div class="col-lg-4 col-6">
                    <x-adminlte-small-box title="0" text="Subjects Offered" 
                        icon="fas bi-book-fill text-dark" theme="danger" 
                        url="#" url-text="View details"/>
                </div>
                <div class="col-lg-4 col-6">
                    <x-adminlte-small-box title="0" text="File Requests" 
                        icon="fas bi-file-earmark-break-fill text-dark" theme="success" 
                        url="#" url-text="View details"/>
                </div>
            </div>
            

        </div>
    </div>
</section>


<section id="box-info" class="container-fluid pt-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title text-bold fs-3">Charts Reports</h3>
        </div>

        <div class="card-body">
            <div class="row">

                <div class="card-body">
                    <canvas id="studentsChart" height="120" width="50%"></canvas>
                </div>
                
            <div class="col-lg-4 col-6">
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


    const ctx = document.getElementById('studentsChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['BSIS', 'BSAIS', 'BSTM', 'BSCrim', 'BSHM'],
            datasets: [{
                label: 'Number of Subjects',
                data: [40, 38, 45, 32, 28],
                backgroundColor: '#9BD0F5',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true
                }
            }
        }
    });



</script>
@endscript