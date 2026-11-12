<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kirobot_entries', function (Blueprint $table) {
            $table->id();
            $table->string('type', 30)->default('keyword')->index(); // section | keyword | quick_action
            $table->string('key', 120);
            $table->string('label', 150)->nullable();
            $table->text('content');
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['type', 'key']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kirobot_entries');
    }
};

