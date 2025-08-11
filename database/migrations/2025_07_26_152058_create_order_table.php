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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('code', 16);
            $table->string('sku', 64)->nullable();
            $table->string('sku_ref', 64)->nullable();
            $table->string('variant', 64)->nullable();
            $table->unsignedSmallInteger('quantity')->default(0);
            $table->string('city', 32);
            $table->string('province', 32);
            $table->unsignedInteger('total')->default(0);
            $table->dateTime('date_ordered');
            $table->dateTime('date_finished');
            $table->foreignId('store_id')->constrained('stores')->onDelete('cascade');
            $table->unsignedSmallInteger('batch');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
