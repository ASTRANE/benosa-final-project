<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('age');
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->text('address');
            $table->string('contact_number');
            $table->string('medical_condition');
            $table->date('date_of_visit');
            $table->enum('status', ['Active', 'Archived'])->default('Active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
