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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id('doctor_id');
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('specialty', 100)->nullable();
            $table->string('contact_number', 15)->nullable();
            $table->string('email', 100)->nullable();
            $table->unsignedBigInteger('hospital_id'); // Add this line
            $table->unsignedBigInteger('user_id'); // Add this line
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Add this line
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
