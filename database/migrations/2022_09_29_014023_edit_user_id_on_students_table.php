<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditUserIdOnStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('students', 'user_id'))
        {
            Schema::table('students', function (Blueprint $table)
            {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            });
        }
        // Schema::table('students', function (Blueprint $table) {
        //     $table->dropColumn('user_id');
        // });
    }
}
