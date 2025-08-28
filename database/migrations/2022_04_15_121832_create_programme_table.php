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
        //Schema::disableForeignKeyConstraints();
        Schema::create('programme', function (Blueprint $table) {
            $table->id();
            $table->string('day');
            $table->time('hour')->format('HH:MM:SS');
            $table->timestamps();

            $table->foreignId('classroom_id')->constrained('classroom');
            //$table->string('classroom_name');
            $table->foreignId('subjects_id')->constrained('subjects');

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
        Schema::dropIfExists('programme');
        Schema::enableForeignKeyConstraints();
    }
};
