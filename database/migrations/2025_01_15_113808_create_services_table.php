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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_category_id');
            $table->string('title');
            $table->text('description');
            $table->string('icon_image')->nullable();
            $table->text('image_video')->nullable();
            $table->enum('type',['image','video'])->nullable();
            $table->boolean('is_active')->default(true)->comment('1=active, 0=inactive');
            $table->timestamps();

            $table->foreign('service_category_id')->references('id')->on('service_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
