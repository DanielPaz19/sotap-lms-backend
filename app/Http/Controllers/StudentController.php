<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\StudentCollection;
use App\Http\Resources\Student as StudentResource;

class StudentController extends Controller
{
    public function students()
    {
        // return Student::all();
        return StudentResource::collection(Student::all());
    }


    public function show(Student $student)
    {
        return new StudentResource($student);
    }

    public function store(Request $request)
    {
        return Student::create([
            'firstname' => $request->input('firstname'),
            'middlename' => $request->input('middlename'),
            'lastname' => $request->input('lastname'),
        ]);
    }

    public function delete($id)
    {
        $student = Student::find($id);
        $result =  $student->delete();

        return $result;
    }
}
