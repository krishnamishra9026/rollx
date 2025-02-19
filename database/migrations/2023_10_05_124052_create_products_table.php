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
            $table->string('name')->nullable();
            $table->string('outlet_name')->nullable();
            $table->text('description')->nullable();
            $table->text('refrence')->nullable();
            $table->string('model_number')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('sold_color')->nullable();
            $table->decimal('price', 8, 2)->default(0);
            $table->decimal('selling_price', 8, 2)->default(0);

            $table->integer('quantity')->nullable();
            $table->integer('available_quantity')->nullable();
            $table->integer('sold_quantity')->nullable();
            $table->longText('notification')->nullable();

            $table->integer('status')->default(0);

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
