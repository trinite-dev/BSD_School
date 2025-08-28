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
       

        Schema::create('student', function (Blueprint $table) {

            $table->id();
            $table->string('name');
            $table->string('coderfid')->unique();
            $table->timestamps();

            $table->foreignId('users_id')->nullable()->constrained('users')->comment('users_role=parent');
            //$table->string('users_name');

            $table->foreignId('classroom_id')->constrained('classroom');
            //$table->string('classroom_name');
            //$table->foreignId('classroom_group_id')->constrained('classroom');
            //$table->string('classroom_group_name');
       
            //$table->string('classroom_kitbsd_coderfid')->nullable()->unique();
        });
       

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('student');
        Schema::enableForeignKeyConstraints();
    }
};
