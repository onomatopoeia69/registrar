<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Student;
use Livewire\Attributes\Computed;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\StudentsExport;
use Maatwebsite\Excel\Facades\Excel;
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

     public function downloadAsPdf()
    {           

        $students = Student::where('academic_status','active')->get();

        $pdf = Pdf::loadView('templates.pdf.allStudent',compact('students'));

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'student_list.pdf');
    }

    public function downloadAsExcel()
    {
        return Excel::download(new StudentsExport, 'students.xlsx');
    }

    public function downloadAsCsv(){
        return Excel::download(new StudentsExport, 'students.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function reloadPage()
    {
        
        $this->dispatch('reload-page');

    }

    
};
?>

<div>

    <section id="box-info1" class="container-fluid pt-4">
    <div class="card p-2">

    <div class="card-header">
        <h1 class="card-title text-bold fs-3">All Students</h1>
    </div>

    <div class="mt-2 card-body p-2"> 

        <div class="d-flex justify-content-between">

            {{-- for the page refresh --}}
        <div class="mb-4 p-2">
            <button type="button" wire:click='reloadPage' class="btn btn-primary btn-sm">
                    <i class="fas fa-sync-alt"></i>
                    Refresh
            </button>
        </div>


            {{-- for the imports file --}}
        <div class="mb-4 p-2 d-flex align-items-center gap-2">

              <button type="button" class="btn btn-danger btn-sm" wire:click='downloadAsPdf'>
                 <i class="fas bi-file-earmark-pdf-fill"></i>
                  PDF
              </button>
      
             <button type="button" class="btn btn-success btn-sm" wire:click='downloadAsExcel'>
                 <i class="fas bi-file-earmark-excel-fill"></i>
                 Excel
             </button>

              <button type="button" class="btn btn-primary btn-sm" wire:click='downloadAsCsv'>
                  <i class="fas bi-filetype-csv"></i>
                  CSV
              </button>
        </div>
     </div>
        

    
    <div wire:ignore>
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
                         <button type="button" class="btn btn-primary btn-sm">
                            <i class="fas fa-eye"></i> View
                        </button>
                        <button type="button" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button type="button" class="btn btn-danger btn-sm">
                            <i class="fas fa-user-slash"></i> Set Inactive
                        </button>
                        <button type="button" class="btn btn-info btn-sm">
                            <i class="fas fa-key"></i> Reset Password
                        </button>
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
    </div>

    </section>

</div>

@script
<script>

    Livewire.on('reload-page', () => {
        location.reload();
    });

</script>
@endscript