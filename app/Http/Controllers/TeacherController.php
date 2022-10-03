<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Resources\TeacherCollection;


class TeacherController extends Controller
{
    public function teachers() {
        // return Teacher::all();
        return new TeacherCollection(Teacher::all());
        
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


}
