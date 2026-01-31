<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

     protected $table = 'students';

     protected $primaryKey = 'student_number';

      protected $fillable = [
        'student_number',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'birth_date',
        'course',
        'year_level',
        'section',
        'email',
        'phone',
        'address',
        'academic_status',
        'graduated_at',
    ];


}
