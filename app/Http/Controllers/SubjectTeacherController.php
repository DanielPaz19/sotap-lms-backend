<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubjectTeacherCollection;
use App\Models\SubjectTeacher;
use Illuminate\Http\Request;

class SubjectTeacherController extends Controller
{
    public function subject_teacher() {
        // return Student::all();
        return new SubjectTeacherCollection(SubjectTeacher::all());
    }
}
