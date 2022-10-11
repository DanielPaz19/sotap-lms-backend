<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GradeLevel;
use App\Http\Resources\GradeLevelCollection;


class GradeLevelController extends Controller
{
    public function grade_levels() {
        // return Student::all();
        return new GradeLevelCollection(GradeLevel::all());
    }

    public function store(Request $request){
        return GradeLevel::create([
            'level' => $request->input('level'),
            'name' => $request->input('name'),
        ]);
    }

    public function delete($id) {
        $grade_level = GradeLevel::find($id);
        $result =  $grade_level->delete();

        return $result;
    }

    public function add_students(Request $req) {
        $grade_level = GradeLevel::find($req->input('grade_id'));

        return $grade_level->students()->attach($req->input('student_id'));
    }
}
