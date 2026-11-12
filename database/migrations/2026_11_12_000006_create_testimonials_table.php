<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('author_name', 140);
            $table->string('author_role', 160);
            $table->string('author_subtitle', 160)->nullable();
            $table->string('author_image_path')->nullable();
            $table->string('badge_text', 80)->default('ENDORSEMENT');
            $table->string('color', 30)->default('cyan');
            $table->text('quote');
            $table->boolean('is_rtl')->default(false);
            $table->string('linkedin_url')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};

