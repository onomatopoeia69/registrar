<?php
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Student;
use Livewire\Attributes\Computed;
use Livewire\Component;

new 
#[Layout('layouts.registrar.dashboard')]
#[Title('Registrar')]
class extends Component
{
 
    #[Computed]
    public function activeStudentCount()
    {

        return Student::where('academic_status','active')->count();

    }


};
?>

<div>

<section id="box-info1" class="container-fluid pt-4">

    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title text-bold fs-3">Dashboard Overview</h3>
        </div>

        <div class="card-body">

            <div class="d-flex justify-content-end">
                <button
                    type="button"
                    class="btn btn-primary rounded-circle d-flex align-items-center justify-content-center mb-3"
                    style="width: 30px; height: 30px;"
                    wire:click="$refresh"
                    wire:island='metric'
                >
                    <span>
                        <i class="bi bi-arrow-clockwise"></i>
                    </span>
                </button>

                    
            </div>

            <div class="row">

                @island('metric')
                <div class="col-lg-4 col-6">
                    <x-adminlte-small-box title="{{ $this->activeStudentCount ?? 0 }}" text="Enrolled Students" 
                        icon="fas fa-users text-dark" theme="teal" 
                        url="{{ route('registrar.students.all') }}" url-text="View details"/>
                </div>
                @endisland
             

                <div class="col-lg-4 col-6">
                    <x-adminlte-small-box title="0" text="New Enrollees" 
                        icon="fas bi-people-fill text-dark" theme="info" 
                        url="#" url-text="View details"/>
                </div>

                <div class="col-lg-4 col-6">
                    <x-adminlte-small-box title="0" text="Subjects Offered" 
                        icon="fas fa-solid fa-book" theme="danger" 
                        url="#" url-text="View details"/>
                </div>
                <div class="col-lg-4 col-6">
                    <x-adminlte-small-box title="0" text="File Requests" 
                        icon="fas bi-file-earmark-break-fill text-dark" theme="success" 
                        url="#" url-text="View details"/>
                </div>

                 <div class="col-lg-4 col-6">
                    <x-adminlte-small-box title="0" text="Reports" 
                        icon="fas fa-solid fa-file text-dark" theme="warning" 
                        url="#" url-text="View details"/>
                </div>

                <div class="col-lg-4 col-6">
                    <x-adminlte-small-box title="0" text="Maintenance" 
                        icon="fas fa-solid fa-file text-light" theme="dark" 
                        url="#" url-text="View details"/>
                </div>

            </div>

           

        </div>
    </div>
</section>

 


 <section id="box-info2" class="container-fluid pt-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title text-bold fs-3">Activity Calendar</h3>
        </div>

        <div class="card-body">
            <div class="row">

                <div class="card-body">
                    <div id='calendar'></div>
                </div>
                
            <div class="col-lg-4 col-6">
            </div>
        </div>
    </div>
</section>


<section id="box-info2" class="container-fluid pt-4">
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
<script >
    document.addEventListener('livewire:initialized', () => {
        

         var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {

          initialView: 'dayGridMonth',
          height: 400,
          aspectRatio: 1.6,

            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },

            buttonText: {
                today: 'Today',
                month: 'Month',
                week: 'Week',
                day: 'Day'
            },
            selectable: true,

            eventSources: [
           
            {

            events: function(info, successCallback, failureCallback) {
                var year = info.start.getFullYear();
                fetch(`https://date.nager.at/api/v3/PublicHolidays/${year}/PH`)
                .then(res => res.json())
                .then(data => {
                    const holidays = data.map(h => ({ title: h.name, start: h.date, allDay: true, color: 'red' }));
                    successCallback(holidays);
                });
            }
            },
           
            {
            events: [
                {
                title: 'Birthday Party',
                start: '2026-02-15T19:00:00',
                end: '2026-02-15T22:00:00',
                color: '#2ecc71' 
                },
                {
                title: 'Project Deadline',
                start: '2026-02-04',
                allDay: true
                }
            ]
            }
        ]
            
        });
        calendar.render();
    });

    
    
      

    window.addEventListener("load", () => {

         setTimeout(() => {

            if(!localStorage.getItem('isDoneTutorial'))
            {
                introDriver();
            }

           const toastEl = document.getElementById('liveToast');
            if (toastEl) {
                const toast = new bootstrap.Toast(toastEl);
                toast.show();
            }

        }, 5000);

        });


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


    function introDriver()
    {

        const driver = window.driver.js.driver;

        const driverObj = driver({
        
        showProgress: true,
        allowClose: false,

        onDestroyed: () => {
            localStorage.setItem('isDoneTutorial', 'true');
        },


        steps: [
            { element: '#fullscreen', popover: { title: 'Full Screen Mode', description: 'Use to widen the window for more clear view.' } },
            { element: '#dark', popover: { title: 'Dark/Light Mode', description: 'Use to darken or lighten the background color or view.' } },
            { element: '#search', popover: { title: 'Search', description: 'Search tool for the certain sections or pages below.' } },
            { element: '#dashboard', popover: { title: 'Dashboard', description: 'This is dashboard for all general informations.' } },
            { element: '#ocr', popover: { title: 'Image to Text converter', description: 'An ocr that uses ai to convert image to text information.' } },
            { element: '#profile', popover: { title: 'Profile', description: 'This section helps user to know and change their information' } },
            { popover: { title: "Welcome Aboard!", description: 'You may proceed. Please go ahead and try using the system.' } }
        ]
        });

        driverObj.drive();

    }

  

</script>
@endscript