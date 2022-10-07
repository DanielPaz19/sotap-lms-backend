<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_code',
        'subject_name',
        'subject_description',
    ];

    public function grade_level() {
        return $this->belongsToMany(GradeLevel::class, 'grade_subject', 'subject_id', 'grade_id');
     }
}