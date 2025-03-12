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
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('donation_id')->nullable();
            $table->foreign('donation_id')->references('id')->on('donations');
            $table->unsignedBigInteger('case_id');
            $table->foreign('case_id')->references('id')->on('charity_cases');
            $table->decimal('price')->default(0);
            $table->string('type')->default('price');
            $table->boolean('archive')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tranfers');
    }
};
