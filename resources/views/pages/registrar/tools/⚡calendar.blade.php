<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\DB;
use App\Models\Event;
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

  #[Computed]
    public function events()
    {
        return Event::all()->map(function ($event) {
            return [
                'id'    => $event->id,
                'title' => $event->title,
                'start' => $event->start, 
                'end'   => $event->end,
            ];
        });
    }

    public function resetField(){

        $this->reset();
    }

    public function submit($data)
    {
        
        $this->title = $data['title'];
        $this->start = $data['start'];
        $this->end = $data['end'];
        $this->description = $data['description'];


        
        DB::beginTransaction();

                
        try {

            Event::create([
                'title' => $this->title,
                'start' => $this->start,
                'end' => $this->end,
                'description' => $this->description
            ]);

            $this->dispatch('close-modal');
            
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
                <div id="calendar2" ></div>

       
            </div>

             <div class="modal fade"  data-bs-backdrop="static"  id="eventModal" tabindex="-1" aria-hidden="true" wire:ignore>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Event</h5>
                        <button type="button" id="close" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <label for="">Start Date</label>
                        <input type="text" id="startDate" class="form-control" readonly>
                         <label for="">End Date</label>
                         <input type="text" id="endDate" class="form-control" readonly>
                          <label for="">Title</label>
                        <input type="text" id="eventTitle" class="form-control mt-2" placeholder="Event Name">
                          <label for="">Description</label>
                        <textarea type="textarea" id="desc" class="form-control mt-2" placeholder="Description"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button id="save" type="button" class="btn btn-primary">Save Event</button>
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
         const modal = new bootstrap.Modal(modalEl, {
                backdrop: 'static',
                keyboard: false
            });
         var calendarEl = document.getElementById('calendar2');

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
            });

         });
    
       

        var calendar = new FullCalendar.Calendar(calendarEl, {

          themeSystem: 'bootstrap5',
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
            alert('Event: ' + info.event.title);
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
                events: @json($this->events),
            }
        ]
            
        });

        calendar.render();



</script>
@endscript