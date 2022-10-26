<?php

namespace App\Http\Controllers;

use App\Http\Resources\GradeLevel as ResourcesGradeLevel;
use App\Http\Resources\Student as ResourcesStudent;
use Illuminate\Http\Request;
use App\Models\GradeLevel;
use App\Http\Resources\GradeLevelCollection;


class GradeLevelController extends Controller
{
    public function grade_levels() {
        return new GradeLevelCollection(GradeLevel::all());
    }

    public function grade_level($id) {
        return new ResourcesGradeLevel(GradeLevel::find($id));
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

    public function remove_students(Request $req) {
        $grade_level = GradeLevel::find($req->input('grade_id'));

        return $grade_level->students()->detach($req->input('students'));
    }

    public function add_subject(Request $req) {
        $grade_level = GradeLevel::find($req->input('grade_id'));
        
        return $grade_level->subject_teachers()->attach($req->input('subject_teacher_id'));
    }
    
    public function remove_subject(Request $req) {
        $grade_level = GradeLevel::find($req->input('grade_id'));
        
        return $grade_level->subject_teachers()->detach($req->input('subject_teacher_id'));
    }

    public function students($gradeId) {
        $grade_level = GradeLevel::find($gradeId);
        
        return ResourcesStudent::collection($grade_level->students()->orderBy('id')->get());
    }
}