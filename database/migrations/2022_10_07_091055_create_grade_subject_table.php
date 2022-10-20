<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradeSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grade_subject', function (Blueprint $table) {
            $table->unsignedBigInteger('grade_id');
            $table->unsignedBigInteger('subject_teacher_id');
            $table->unique(['grade_id', 'subject_teacher_id']);

            $table->foreign('subject_teacher_id')->references('id')->on('subject_teacher')->onDelete('cascade');
            $table->foreign('grade_id')->references('id')->on('grade_levels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grade_subject');
    }
}
