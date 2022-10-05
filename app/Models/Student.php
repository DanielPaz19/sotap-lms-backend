<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
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

     public function grade_level() {
        return $this->belongsToMany(GradeLevel::class);
     }

}
