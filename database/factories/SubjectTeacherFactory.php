<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class SubjectTeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $subject_id = rand(1, 10);
        $teacher_id = rand(1, 5);

        $result = DB::table('subject_teacher')
            ->select('subject_id', 'teacher_id')
            ->where('subject_id', $subject_id)
            ->where('teacher_id', $teacher_id)
            ->get();

        if ($result) {
            return [];
        }

        return [
            'subject_id' => $subject_id,
            'teacher_id' => $teacher_id
        ];
    }
}
