<?php

namespace Database\Seeders;

use App\Models\SubjectTeacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectTeachersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 0;
        while ($count < 50) {
            $subject_id = rand(1, 10);
            $teacher_id = rand(1, 5);

            $result = DB::table('subject_teacher')
                ->select('subject_id', 'teacher_id')
                ->where('subject_id', $subject_id)
                ->where('teacher_id', $teacher_id)
                ->first();

            if (!$result) {
                SubjectTeacher::create([
                    'subject_id' => $subject_id,
                    'teacher_id' => $teacher_id
                ]);
            }

            $count++;
        }
    }
}
