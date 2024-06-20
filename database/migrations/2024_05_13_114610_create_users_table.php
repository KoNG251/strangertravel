<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fname', 80);
            $table->string('lname', 80);
            $table->string('email', 150);
            $table->string('password', 255);
            $table->string('user', 7);
            $table->string('userPicturePath', 255)->nullable();
            $table->string('citizenID', 100);
            $table->string('tel', 10);
            $table->date('birthdate')->nullable();
            $table->string('gender', 6);
            $table->unsignedTinyInteger('status')->default(1);
            $table->unsignedTinyInteger('otp_verify')->default(0);
            $table->unsignedTinyInteger('email_verify')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
