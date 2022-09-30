<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\StudentCollection;

class StudentController extends Controller
{
    public function students(Request $request) {
        // return Student::all();

        return new StudentCollection(Student::all());
    }

    public function store(Request $request){
        return Student::create([
            'firstname' => $request->input('firstname'),
            'middlename' => $request->input('middlename'),
            'lastname' => $request->input('lastname'),
        ]);
    }

    public function delete($id) {
        $student = Student::find($id);
        $result =  $student->delete();

        return $result;
    }

}
