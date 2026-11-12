<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 120)->unique();
            $table->string('title', 200);
            $table->string('framework', 60)->index();
            $table->string('framework_label', 120);
            $table->string('architecture', 60)->index();
            $table->string('architecture_label', 120);
            $table->string('image_path')->nullable();
            $table->string('badge_text', 120)->nullable();
            $table->string('badge_color', 120)->default('text-cyan-400 bg-black/80 border-white/15');
            $table->json('tech_tags')->nullable();
            $table->text('short_description');
            $table->text('long_description');
            $table->json('highlights')->nullable();
            $table->string('demo_url')->nullable();
            $table->string('demo_label', 120)->default('View Showcase / Demo');
            $table->string('github_url')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};

