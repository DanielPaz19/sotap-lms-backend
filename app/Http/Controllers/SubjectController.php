<?php

namespace App\Http\Controllers;

use App\Models\Subject;

use Illuminate\Http\Request;
use App\Http\Resources\SubjectCollection;


class SubjectController extends Controller
{
    public function subjects()
    {
        // return Student::all();
        return new SubjectCollection(Subject::all());
    }

    public function show(Subject $subject)
    {
        return response()->json(["data" => $subject]);
    }

    public function store(Request $request)
    {
        return Subject::create([
            'subject_code' => $request->input('subject_code'),
            'subject_name' => $request->input('subject_name'),
            'subject_description' => $request->input('subject_description'),
        ]);
    }

    public function delete($id)
    {
        $subject = Subject::find($id);
        $result =  $subject->delete();

        return $result;
    }

    public function topics(Subject $subject)
    {
        return response()->json(["data" => $subject->topics]);
    }
}
