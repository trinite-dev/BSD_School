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
        Schema::create('users', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string('coderfid')->nullable()->unique(); //pour les profs seuls
            $table->string('name');
            $table->string('phone');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->foreignId('role_id')->constrained('role');
            //$table->string('role_name');

            $table->foreignId('subjects_id')->nullable()->constrained('subjects'); //pour les profs seuls
            //$table->string('subjects_name')->nullable(); //pour les profs seuls
            
        });
        //Schema::enableForeignKeyConstraints();

    }
 
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('users');
        //Schema::enableForeignKeyConstraints();
    }
};
