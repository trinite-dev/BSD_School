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
        Schema::disableForeignKeyConstraints();
        Schema::create('presences', function (Blueprint $table) {
                $table->id();
                $table->timestamp('startat');
                $table->timestamps();


                $table->foreignId('users_id')->constrained('users');
                //$table->string('users_name');
    
                $table->foreignId('subjects_id')->constrained('subjects');
                //$table->string('subjects_name');
    
                $table->foreignId('classroom_id')->constrained('classroom');
                //$table->string('classroom_name');
    
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
        Schema::dropIfExists('presences');
        Schema::enableForeignKeyConstraints();        
    }
};
