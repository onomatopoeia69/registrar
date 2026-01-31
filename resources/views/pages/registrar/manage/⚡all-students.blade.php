<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Student;
use Livewire\Attributes\Computed;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\StudentsExport;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithPagination;
use Livewire\Component;

new 
#[Layout('layouts.registrar.dashboard')]
#[Title('Registrar')]
class extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';
    public $pager = "10";


     public function updatedSearch()
    {
        $this->resetPage();
    }

     public function updatedStatus()
    {
        $this->resetPage();
    }

    #[Computed]
    public function students()
    {
        return Student::query()
            ->when($this->search, function ($q) {
                    $q->where(function ($query) {
                        $query->where('first_name', 'like', "%{$this->search}%")
                            ->orWhere('last_name', 'like', "%{$this->search}%")
                            ->orWhere('student_number', 'like', "%{$this->search}%")
                            ->orWhere('course', 'like', "%{$this->search}%");
                    });
                })
            ->when($this->status, fn($q) => $q->where('academic_status', $this->status))
            ->paginate($this->pager);
    }


     public function downloadAsPdf()
    {           
        $students = Student::query()
        ->when($this->search, function ($q) {
            $q->where(function ($query) {
                $query->where('first_name', 'like', "%{$this->search}%")
                      ->orWhere('last_name', 'like', "%{$this->search}%")
                      ->orWhere('student_number', 'like', "%{$this->search}%")
                      ->orWhere('course', 'like', "%{$this->search}%");
                });
            })
            ->when($this->status, fn($q) => $q->where('academic_status', $this->status))
            ->get(); 

        $data = ucFirst($this->status);

        $fileName = $data ? strtolower($data)."_student_list.pdf" : "student_list.pdf";

        $pdf = PDF::loadView('templates.pdf.allStudent', [
            'students' => $students,
            'data' => $data
        ]);

         return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $fileName);


    }

    public function downloadAsExcel()
    {
        return Excel::download(new StudentsExport($this->search, $this->status), 'students.xlsx');
    }

    public function downloadAsCsv(){
        return Excel::download(
        new StudentsExport($this->search, $this->status), 
        'students_report.csv', 
        \Maatwebsite\Excel\Excel::CSV
        );
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


     <div class="d-flex justify-content-between align-items-center">

            {{-- for the page refresh --}}
        <div class="input-group mb-4" >
            <label class="input-group-text" for="perPageSelect">Per Page:</label>
            <select class="form-select col-2" wire:model.live="pager">
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                    <option value="40">40</option>
                </select>
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

        <div class="input-group mb-3" >
            <select class="form-select col-2" wire:model.live="status">
                <option value="">All</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
                <option value="graduated">Graduated</option>
            </select>

            <input type="text"
                class="form-control"
                placeholder="Search..." wire:model.live='search'>

        </div>

        @island
        <div wire:poll>
        <table class="table table-hover table-striped">
            <thead>
                <tr>    
                <th scope="col">Student No.</th>
                <th scope="col">Name</th>
                <th scope="col">Course</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
    
             @forelse($this->students as $key => $student)
                <tr>
                    <td>{{ $student->student_number }}</td>
                    <td>{{ $student->last_name }} {{ $student->first_name }}</td>
                    <td>{{ $student->course }}</td>
                    <td>{{ ucFirst($student->academic_status) }}</td>
                    <td>..</td>
                </tr>
                @empty

                <tr>
                    <td colspan='5' class="text-center fw-light">NO RESULT FOUND</td>
                </tr>

            @endforelse
            </tbody>
         </table>
         </div>
        

         <div class="mt-4">
            {{ $this->students->links() }}
        </div>
                
         @endisland

            
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