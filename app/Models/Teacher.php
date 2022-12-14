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

   public function user()
   {
      return $this->belongsTo(User::class);
   }


   public function subjects()
   {
      return $this->belongsToMany(Subject::class, 'subject_teacher');
   }


   public function grade_subjects()
   {
      return $this->hasManyThrough(GradeSubject::class, SubjectTeacher::class);
   }

   public function topics()
   {
      return $this->hasMany(Topic::class);
   }
}
