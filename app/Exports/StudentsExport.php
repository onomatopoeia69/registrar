<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function collection()
    {
        return Student::where('academic_status','inactive')->get();
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

        return [
        ['Monthly User Report'], // Row 1
        [
            'student_number',
            'first_name',
            'middle_name',
            'last_name',
            'created_at'
        ]  
    ];

    }

}
