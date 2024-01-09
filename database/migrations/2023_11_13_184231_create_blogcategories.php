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
        Schema::create('blogcategories', function (Blueprint $table) {
                $table->id('id');
                $table->string('name');
                $table->string('slug');
                $table->mediumText('description');
                $table->string('image');
                $table->string('meta_title');
                $table->string('meta_description');
                $table->string('meta_keyword');
                $table->tinyInteger('navbar_status')->default(0);
                $table->tinyInteger('status')->default(0);
                $table->tinyInteger('created_by');
                $table->tinyInteger('featured')->default(0);
                $table->timestamps();
            });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogcategories');
    }
};
