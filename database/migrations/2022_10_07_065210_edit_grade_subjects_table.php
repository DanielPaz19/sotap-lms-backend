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
        //
        // Schema::create('grade_subject', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('subject_id');
        //     $table->unsignedBigInteger('grade_id');
        //     $table->unsignedBigInteger('teacher_id');
        //     $table->timestamps();

        //     $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
        //     $table->foreign('grade_id')->references('id')->on('grade_levels')->onDelete('cascade');
        //     $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
        // });

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
