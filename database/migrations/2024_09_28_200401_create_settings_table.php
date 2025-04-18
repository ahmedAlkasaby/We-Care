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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string("site_title");
            $table->string("site_phone");
            $table->string("site_email")->nullable();
            $table->string("facebook",255)->nullable();
            $table->string("twitter",255)->nullable();
            $table->string("instagram",255)->nullable();
            $table->string("gmail",255)->nullable();
            $table->string("linkedin",255)->nullable();
            $table->integer("whatsapp")->nullable();
            $table->string("site_language")->default("en");
            $table->text("address")->nullable();
            $table->boolean('active')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
