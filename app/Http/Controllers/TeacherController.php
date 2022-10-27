<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Resources\TeacherCollection;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class TeacherController extends Controller
{
    public function teachers()
    {
        // return Teacher::all();
        return new TeacherCollection(Teacher::all());
    }

    public function teacher($id)
    {
        return new TeacherCollection(Teacher::where('id', $id)->get());
    }

    public function store(Request $request)
    {
        return Teacher::create([
            'firstname' => $request->input('firstname'),
            'middlename' => $request->input('middlename'),
            'lastname' => $request->input('lastname'),
        ]);
    }

    public function delete($id)
    {
        $teacher = Teacher::find($id);

        if ($teacher == "") {
            return ["message" => "ID not found"];
        } else {
            $teacher->delete();
        }

        return $teacher;
    }

    public function add_subject(Request $req)
    {
        $teacher = Teacher::find($req->input('teacher_id'));
        return $teacher->subjects()->attach($req->input('subject_id'));
    }

    public function remove_subject(Request $req)
    {
        $teacher = Teacher::find($req->input('teacher_id'));
        return $teacher->subjects()->detach($req->input('subject_id'));
    }

    public function grade_levels($id)
    {
        // get grade levels associate with specific teacher
        $grades = DB::table('teachers')
            ->join('subject_teacher', 'teachers.id', '=', 'subject_teacher.teacher_id')
            ->join('grade_subject', 'subject_teacher.id', '=', 'grade_subject.subject_teacher_id')
            ->join('grade_levels', 'grade_levels.id', '=', 'grade_subject.grade_id')
            ->select('grade_levels.*')
            ->groupBy('grade_levels.id')
            ->where('teachers.id', '=', $id)
            ->where('teachers.id', '<>', null)
            ->get();

        return response()->json(["data" => $grades], Response::HTTP_OK);
    }


    public function subjects(Teacher $teacher)
    {
        return response()->json(["data" => $teacher->subjects]);
    }

    public function topics(Teacher $teacher, Request $request)
    {
        if ($request->query()) {
            if ($request->has('subject')) {
                return  ["data" => $teacher->topics->where("subject_id", $request->subject)];
            }

            return response()->json(["message" => "Invalid Query Params"], Response::HTTP_BAD_REQUEST);
        }

        return response()->json(["data" => $teacher->topics]);
    }
}
