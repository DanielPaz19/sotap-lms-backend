<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectTeacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'teacher_id',
    ];


    public $timestamps = false;

    protected $table = 'subject_teacher';

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function grade_levels()
    {
        return $this->belongsToMany(GradeLevel::class, 'grade_subject', 'subject_teacher_id', 'grade_id');
    }
}
