<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'level',
        'name',
    ];

    
    public function student() {
        return $this->belongsToMany(Student::class, 'grade_student', 'grade_id', 'student_id');
     }

     public function subjects() {
        return $this->belongsToMany(Subject::class, 'grade_subject', 'grade_id', 'subject_id');
     }
     
     public function teachers() {
        return $this->belongsToMany(Teacher::class, 'grade_subject', 'grade_id', 'teacher_id');
     }
     

}
