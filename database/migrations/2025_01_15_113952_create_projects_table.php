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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_category_id');
            $table->string('title');
            $table->text('description');
            $table->text('image_video')->nullable();
            $table->enum('type',['image','video'])->nullable();
            $table->boolean('is_active')->default(true)->comment('1=active, 0=inactive');
            $table->timestamps();

            $table->foreign('project_category_id')->references('id')->on('project_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
