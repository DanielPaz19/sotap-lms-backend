<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectTeacher extends Model
{
    use HasFactory;

    protected $table = 'subject_teacher';

    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }
    public function subject() {
        return $this->belongsTo(Subject::class);
    }
}
