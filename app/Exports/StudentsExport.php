<?php


namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromQuery; 
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class StudentsExport implements FromQuery, WithMapping, WithHeadings
{
    protected $search;
    protected $status;

    public function __construct($search = null, $status = null)
    {
        $this->search = $search;
        $this->status = $status;
    }

    public function query()
    {
        return Student::query()
            ->when($this->status, fn($q) => $q->where('academic_status', $this->status))
            ->when($this->search, function ($q) {
                $q->where(function ($query) {
                     $query->where('first_name', 'like', "%{$this->search}%")
                            ->orWhere('last_name', 'like', "%{$this->search}%")
                            ->orWhere('student_number', 'like', "%{$this->search}%")
                            ->orWhere('course', 'like', "%{$this->search}%");
                });
            })->orderBy('student_number', 'asc');
            
    }
    

    public function map($student): array
    {
        return [
            $student->student_number,
            $student->first_name,
            $student->middle_name,
            $student->last_name,
            Date::dateTimeToExcel($student->created_at)
        ];
    }

    public function headings(): array
    {
        $placeholder = "Student Report (".ucFirst($this->status).")";

        return [
            [$placeholder], 
            [                        
                'Student Number',
                'First Name',
                'Middle Name',
                'Last Name',
                'Created At'
            ]  
        ];
    }
}