<?php

namespace App\Http\Controllers;

use App\Models\Teacher;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function teachers() {
        return Teacher::all();
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
        $result =  $teacher->delete();

        return $result;
    }


}
