<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\DB;
use App\Models\Event;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Component;


new
#[Layout('layouts.registrar.calendar')]
#[Title('Registrar')]
 class extends Component
{
    public $title = '';
    public $start='';
    public $end = '';
    public $description = '';
    public $bgColor = '';


    public function resetField(){

        $this->reset();
    }


    public function submit($data)
    {
        
        $this->title = $data['title'];
        $this->start = $data['start'];
        $this->end = $data['end'];
        $this->description = $data['description'];
        $this->bgColor = $data['bgColor'];


        $start = Carbon::parse($this->start)->setTimezone('Asia/Manila');
        $end = Carbon::parse($this->end)->setTimezone('Asia/Manila');
        
        DB::beginTransaction();

                
        try {

            Event::create([
                'title' => $this->title,
                'start' =>  $start->toDateTimeString(),
                'end' =>  $end->toDateTimeString(),
                'description' => $this->description,
                'background_color' => $this->bgColor,
            ]);

            $this->dispatch('close-modal');

            $this->dispatch('refresh-calendar');
            
            DB::commit(); 

        } catch (\Throwable $e) {

            DB::rollBack();
            throw $e; 
        }

      
    }

};
?>

<div>

<section id="box" class="container-fluid pt-4">

    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title text-bold fs-3">Activity Calendar</h3>
        </div>

    
            <div class="card-body" wire:ignore>
                <div id="calendar2"></div>
            </div>

        <div class="modal fade"  data-bs-backdrop="static"  id="eventModal" tabindex="-1" aria-hidden="true" wire:ignore>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Event</h5>
                        <button type="button" id="close" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">

                        <div class="d-flex justify-content-end align-items-center mb-2 gap-2">

                        <input type="radio" class="btn-check" name="color" id="red" value="#dc3545" autocomplete="off">
                        <label class="btn btn-outline-danger" for="red"></label>
                            
                        <input type="radio" class="btn-check" name="color" id="green"  value="#198754" autocomplete="off">
                        <label class="btn btn-outline-success" for="green"></label>

                         <input type="radio" class="btn-check" name="color" id="yellow" value="#ffc107" autocomplete="off" >
                        <label class="btn btn-outline-warning" for="yellow"></label>

                        <input type="radio" class="btn-check" name="color" id="blue" value="#0d6efd" autocomplete="off" checked >
                        <label class="btn btn-outline-primary" for="blue"></label>

                        </div>

                        
                     <div class="container"> 
                        <label for="">Start Date</label>
                        <input type="text" id="startDate" class="form-control" readonly>
                         <label for="">End Date</label>
                         <input type="text" id="endDate" class="form-control mb-2" readonly>
                          <label for="">Title</label>
                        <input type="text" id="eventTitle" class="form-control mb-2" placeholder="Event Name">
                          <label for="">Description</label>
                        <textarea type="textarea" id="desc" class="form-control mb-2" placeholder="Description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="save" type="button" class="btn btn-primary">Save Event</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" id="infoModal">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoTitle"></h5>
                    <button type="button" class="btn-close" id="infoClose" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">




                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
                </div>
            </div>
            </div>


        </div>
    </div>
</section>

   
</div>

@script
<script>


        const modalEl = document.getElementById('eventModal');
        const info = document.getElementById('infoModal');

         const modal = new bootstrap.Modal(modalEl, {
                backdrop: 'static',
                keyboard: false
            });

         const infoModal = new bootstrap.Modal(info, {
            backdrop: 'static',
                keyboard: false
         });

      

        //  for the creation 

         document.getElementById('close').addEventListener('click',()=>{

            document.getElementById('eventTitle').value = '';
            document.getElementById('desc').value = '';
            $wire.resetField();
            modal.hide();

         });

         $wire.on('close-modal',()=>{

            document.getElementById('eventTitle').value = '';
            document.getElementById('desc').value = '';
            $wire.resetField();
            modal.hide();

         });


         document.getElementById('save').addEventListener('click',()=>{

         
            $wire.submit({
                title: document.getElementById('eventTitle').value,
                start: document.getElementById('startDate').value,
                end: document.getElementById('endDate').value,
                description: document.getElementById('desc').value,
                bgColor: document.querySelector('input[name="color"]:checked').value
            });

         });

        //  for deletion and fetching 

        document.getElementById('infoClose').addEventListener('click',()=>{


            infoModal.hide();

        });



    
        var calendarEl = document.getElementById('calendar2');

        var calendar = new FullCalendar.Calendar(calendarEl, {

          themeSystem: 'bootstrap5',
          timeZone: 'local',
          initialView: 'dayGridMonth',
          height: 500,
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
            editable:true,
            selectable: true,
            select: function(info){

            document.getElementById('startDate').value = info.startStr;
            document.getElementById('endDate').value = info.endStr;
 
            modal.show();
        
            calendar.unselect();
          
            },

            eventClick: function(info) {

               document.getElementById('infoTitle').textContent = info.event.title;

                infoModal.show();
            
             },

            eventDrop:true,

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
                id: 'db-events',         
                url: '/api/calendar-events', 
                method: 'GET',
                failure: function() {
                    alert('There was an error fetching events!');
                }
            }



        ]
            
        });

        calendar.render();

    
    $wire.on('refresh-calendar', () => {
        calendar.getEventSourceById('db-events').refetch();
    });




</script>
@endscript