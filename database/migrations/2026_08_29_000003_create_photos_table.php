<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('caption')->nullable();
            $table->string('image_path')->nullable();
            $table->date('date_taken')->nullable();
            $table->string('category')->default('Random');
            $table->string('location')->nullable();
            $table->foreignId('timeline_event_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('memory_id')->nullable()->constrained()->nullOnDelete();
            $table->boolean('is_placeholder')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
