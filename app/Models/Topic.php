<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'teacher_id',
        'subject_id'
    ];


    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function grade_levels()
    {
        return $this->belongsToMany(GradeLevel::class, 'grade_topic', 'grade_id', 'topic_id')
            ->withTimestamps();
    }
}
