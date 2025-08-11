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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku', 64);
            $table->string('sku_ref', 64);
            $table->string('variant', 64);
            $table->string('name', 255);
            $table->unsignedInteger('price_cost')->default(0);
            $table->unsignedInteger('price_selling')->default(0);
            $table->unsignedMediumInteger('quantity')->default(0);
            $table->foreignId('store_id')->constrained('stores')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
