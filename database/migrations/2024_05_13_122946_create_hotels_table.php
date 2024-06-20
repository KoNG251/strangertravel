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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('hotelName',80);
            $table->unsignedBigInteger('createId');
            $table->json('near');
            $table->json('facilities');
            $table->string('province',255);
            $table->string('amphures',255);
            $table->longText('address');
            $table->longText('about');
            $table->unsignedTinyInteger('admin_check')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
