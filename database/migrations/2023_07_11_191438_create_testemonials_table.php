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
        Schema::create('testemonials', function (Blueprint $table) {
            $table->id();
            $table->string('avatar');
            $table->string('name_en');
            $table->string('name_ar');
            $table->string('title_job_en');
            $table->string('title_job_ar');
            $table->string('rate');
            $table->string('description_en');
            $table->string('description_ar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testemonials');
    }
};
