<?php

namespace App\Http\Controllers;

use App\Models\Subject;

use Illuminate\Http\Request;
use App\Http\Resources\SubjectCollection;
use App\Http\Resources\Subject as SubjectResource;


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


        $subject = new Subject;

        $subject->subject_code = $request->input('subject_code');
        $subject->subject_name = $request->input('subject_name');
        $subject->subject_description = $request->input('subject_description');

        if ($request->input('img_url')) {
            $subject->img_url = $request->input('img_url');
        }

        $subject->save();

        $subject->refresh();

        return new SubjectResource($subject);
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
