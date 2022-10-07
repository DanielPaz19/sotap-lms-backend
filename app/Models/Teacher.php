<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
     }


     public function subjects() {
        return $this->belongsToMany(Subject::class, 'grade_subject', 'subject_id', 'teacher_id');
     }

}
