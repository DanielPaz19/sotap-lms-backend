<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditGradeSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::table('grade_subject', function (Blueprint $table) {
            $table->dropForeign(['subject_id']);
            $table->dropForeign(['teacher_id']);

            $table->dropColumn('subject_id');
            $table->dropColumn('teacher_id');

            $table->unsignedBigInteger('subject_teacher_id');

            $table->foreign('subject_teacher_id')->references('id')->on('subject_teacher')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
