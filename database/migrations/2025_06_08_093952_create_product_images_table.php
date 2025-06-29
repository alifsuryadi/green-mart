<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('file_name');
            $table->string('file_path');
            $table->string('file_size');
            $table->string('mime_type');
            $table->timestamps();
            
            $table->index('category_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};