<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\SubjectTeacher;
use Illuminate\Http\Request;
use App\Http\Resources\TeacherCollection;


class TeacherController extends Controller
{
    public function teachers() {
        // return Teacher::all();
        return new TeacherCollection(Teacher::all());
        
    }

    public function teacher($id) {
        return new TeacherCollection(Teacher::where('id', $id)->get());
    }

    public function store(Request $request){
        return Teacher::create([
            'firstname' => $request->input('firstname'),
            'middlename' => $request->input('middlename'),
            'lastname' => $request->input('lastname'),
        ]);
    }

    public function delete($id) {
        $teacher = Teacher::find($id);

        if($teacher == "") {
            return ["message" => "ID not found"];
        }else {
            $teacher->delete();
        }

        return $teacher;
    }

    public function add_subject(Request $req) {
        $teacher = Teacher::find($req->input('teacher_id'));
        return $teacher->subjects()->attach($req->input('subject_id'));
    }
    
    public function remove_subject(Request $req) {
        $teacher = Teacher::find($req->input('teacher_id'));
        return $teacher->subjects()->detach($req->input('subject_id'));
    }
}
