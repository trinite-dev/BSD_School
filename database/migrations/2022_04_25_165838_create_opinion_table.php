<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opinion', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->timestamps();

            $table->foreignId('student_id')->constrained('student');
            //$table->string('student_name');

            $table->foreignId('presences_id')->constrained('presences');
            //$table->string('presences_classroom_name');
            //$table->string('presences_users_name');
            //$table->string('presences_subjects_name');

            //$table->primary(['student_id','presences_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('opinion');
    }
};
