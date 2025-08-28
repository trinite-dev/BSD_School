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
        Schema::create('programme_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained('users');
            
            $table->foreignId('programme_id')->constrained('programme');
            
            //$table->primary(['users_id','programme_id']);
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programme_user');
    }
};
