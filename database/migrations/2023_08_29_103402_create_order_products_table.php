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
        Schema::create('order_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id')->nullable();
            $table->bigInteger('order_id')->nullable();
            $table->double('price')->nullable();
            $table->unsignedInteger('quantity');
            $table->text('variants')->nullable();
            $table->boolean('include_cover_letter')->default(false);
        $table->string('cover_letter_price')->nullable();
        $table->string('delivery_option_name')->nullable();
        $table->text('file_upload_path')->nullable();
        $table->string('delivery_option_price')->nullable();
        $table->string('cover_letter_path')->nullable();

        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_products');
    }
};
