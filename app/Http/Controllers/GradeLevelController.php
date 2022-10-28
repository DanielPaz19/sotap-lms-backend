<?php

namespace App\Http\Controllers;

use App\Http\Resources\GradeLevel as ResourcesGradeLevel;
use App\Http\Resources\Student as ResourcesStudent;
use App\Http\Resources\Subject as ResourcesSubject;
use Illuminate\Http\Request;
use App\Models\GradeLevel;
use App\Models\Subject;
use App\Http\Resources\GradeLevelCollection;
use App\Models\SubjectTeacher;

class GradeLevelController extends Controller
{
    public function grade_levels()
    {
        return new GradeLevelCollection(GradeLevel::all());
    }

    public function grade_level($id)
    {
        return new ResourcesGradeLevel(GradeLevel::find($id));
    }

    public function topics(GradeLevel $grade_level)
    {
        return $grade_level->topics;
    }


    public function add_topic(GradeLevel $grade_level, Request $req)
    {
        return $grade_level->topics()->attach($req->input('topic_id'));
    }

    public function remove_topic(GradeLevel $grade_level, Request $req)
    {
        return $grade_level->topics()->detach($req->input('topic_id'));
    }

    public function store(Request $request)
    {
        return GradeLevel::create([
            'level' => $request->input('level'),
            'name' => $request->input('name'),
        ]);
    }

    public function delete($id)
    {
        $grade_level = GradeLevel::find($id);
        $result =  $grade_level->delete();

        return $result;
    }

    public function add_students(Request $req)
    {
        $grade_level = GradeLevel::find($req->input('grade_id'));

        return $grade_level->students()->attach($req->input('student_id'));
    }

    public function remove_students(Request $req)
    {
        $grade_level = GradeLevel::find($req->input('grade_id'));

        return $grade_level->students()->detach($req->input('students'));
    }

    public function add_subject(Request $req)
    {
        $grade_level = GradeLevel::find($req->input('grade_id'));

        return $grade_level->subject_teachers()->attach($req->input('subject_teacher_id'));
    }

    public function remove_subject(Request $req)
    {
        $grade_level = GradeLevel::find($req->input('grade_id'));

        return $grade_level->subject_teachers()->detach($req->input('subject_teacher_id'));
    }

    public function students($gradeId)
    {
        $grade_level = GradeLevel::find($gradeId);

        return ResourcesStudent::collection($grade_level->students()->orderBy('id')->get());
    }


    public function subjects($gradeId)
    {
        $grade_level = GradeLevel::find($gradeId);

        // if no subject_teacher in the grade level
        if (!count($grade_level->subject_teachers)) {
            return response()->json(['data' => []]);
        }

        // get all the subject_teacher_id
        foreach ($grade_level->subject_teachers as $subject_teacher) {
            $output[] = $subject_teacher->pivot->subject_teacher_id;
        }

        // get subject_teacher where grade_id = $id
        $subject_teachers = SubjectTeacher::whereIn('id', $output)->get();

        foreach ($subject_teachers as $subject_teacher) {
            $subject_id[] = $subject_teacher->subject_id;
        }

        $subjects = Subject::whereIn('id', $subject_id)->get();

        return ResourcesSubject::collection($subjects);
    }
}
