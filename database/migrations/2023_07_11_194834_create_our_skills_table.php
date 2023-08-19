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
        Schema::create('our_skills', function (Blueprint $table) {
            $table->id();
            $table->string('title-en');
            $table->string('title-ar');
            $table->decimal('title1_percent');
            $table->decimal('title2_percent');
            $table->decimal('title3_percent');
            $table->decimal('title4_percent');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('our_skills');
    }
};
