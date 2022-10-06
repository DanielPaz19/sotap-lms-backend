<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditGradeStudentForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('grade_student', function(Blueprint $table) {
            $table->dropForeign(['student_id']);
            $table->dropForeign(['grade_id']);

            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('grade_id')->references('id')->on('grade_levels')->onDelete('cascade');
        });
    }
}
