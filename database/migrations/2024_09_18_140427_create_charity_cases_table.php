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
    Schema::create('charity_cases', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('volunteer_id')->nullable();
        $table->foreign('volunteer_id')->references('id')->on('users');
        $table->unsignedBigInteger('category_case_id')->nullable();
        $table->foreign('category_case_id')->references('id')->on('category_cases');
        $table->unsignedBigInteger('user_id');
        $table->foreign('user_id')->references('id')->on('users');
        $table->mediumText('name');
        $table->longText('description')->nullable();
        $table->string('type')->default('price');
        $table->string('priority')->default('medium');
        $table->string('repeating')->default('none');
        $table->timestamp('next_donation_date')->nullable();
        $table->boolean('active')->default(true);
        $table->timestamp('date_start')->useCurrent();
        $table->timestamp('date_end')->nullable();
        $table->decimal('price')->default(0);
        $table->decimal('price_raised')->default(0);
        $table->boolean('archive')->default(0);
        $table->boolean('is_event')->default(0);
        $table->boolean('done')->default(0);
        $table->integer('order_no')->nullable();
        $table->timestamps();
        $table->softDeletes();

    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('charity_cases');
    }
};
