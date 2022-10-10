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

    
    public function students() {
        return $this->belongsToMany(Student::class, 'grade_student', 'grade_id', 'student_id');
     }

     public function subject_teachers() {
        return $this->belongsToMany(SubjectTeacher::class, 'grade_subject', 'grade_id', 'subject_teacher_id');
     }
     
}
