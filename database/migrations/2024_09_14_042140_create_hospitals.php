<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('hospitals', function (Blueprint $table) {
            $table->id('hospital_id');
            $table->string('hospital_name', 100);
            $table->text('address');
            $table->string('contact_number', 15)->nullable();
            $table->string('email', 100)->nullable();
            $table->unsignedInteger('subscription_id')->nullable();
            $table->enum('subscription_type', ['Basic', 'Starter', 'Enterprise'])->default('Basic');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospitals');
    }
};
