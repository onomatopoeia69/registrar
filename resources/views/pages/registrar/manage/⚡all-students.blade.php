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
    public function activeStudents()
    {
         return Student::where('academic_status', 'active')->get();
    }

    
};
?>

<div>

    <section id="box-info1" class="container-fluid pt-4">
    <div class="card p-2">

    <div class="card-header">
        <h1 class="card-title text-bold fs-3">All Students</h1>
    </div>

    <div class="card-body p-2"> 

            {{-- for the imports file --}}
        <div class="mb-3 p-2 d-flex align-items-center gap-2">
              <span class="text-bold">Import to:</span>
       
              <button type="button" class="btn btn-danger">
                 <i class="fas bi-file-earmark-pdf-fill"></i>
                  PDF
              </button>
      
             <button type="button" class="btn btn-success">
                 <i class="fas bi-file-earmark-excel-fill"></i>
                 Excel
             </button>

              <button type="button" class="btn btn-primary">
                  <i class="fas bi-filetype-csv"></i>
                  CSV
              </button>
        </div>
       

      <x-adminlte-datatable id="table1" class='p-4' :heads="['No.','Student ID', 'First Name', 'Last Name', 'Actions']"  head-theme="light"
      >     
        @php $i = 1; @endphp
        @forelse ($this->activeStudents as $student)
                <tr wire:key="student-{{ $student->student_number }}">
                    <td>{{ $i++ }}</td>
                    <td>{{ $student->student_number }}</td>
                    <td>{{ $student->first_name }}</td>
                    <td>{{ $student->last_name }}</td>
                    <td class="d-flex align-items-center gap-2">
                    <div>
                        <button type="button" class="btn btn-primary">
                          Edit
                        </button>
                    </div>
                     <div>
                        <button type="button" class="btn btn-success">
                           View Info
                        </button>
                    </div>
                    <div>
                        <button type="button" class="btn btn-danger">
                          Set Inactive
                        </button>
                    </div>
                    </td>
                </tr>
            
            @empty

                <tr>
                    <td colspan="5" class="text-center text-muted">
                        No active students found
                    </td>
                </tr>

            @endforelse
            
          
      
    </x-adminlte-datatable>
    </div>
    </div>

    </section>

</div>