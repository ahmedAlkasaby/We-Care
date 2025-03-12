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
        Schema::create('case_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('case_id')->constrained('charity_cases')->onDelete('cascade');
            $table->string('code_name')->nullable();
            $table->string('national_number')->nullable();
            $table->string('condition')->nullable();
            $table->string('type_of_aid')->nullable();
            $table->integer('number_of_peaple')->nullable();
            $table->string('government')->nullable();
            $table->string('city')->nullable();
            $table->string('area')->nullable();
            $table->string('street')->nullable();
            $table->string('district')->nullable();
            $table->string('building')->nullable();
            $table->string('floor')->nullable();
            $table->string('apartment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cases_details');
    }
};
