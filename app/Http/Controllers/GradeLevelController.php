<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GradeLevel;

class GradeLevelController extends Controller
{
    public function grade_levels() {
        // return Student::all();
        return GradeLevel::all();
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
}
