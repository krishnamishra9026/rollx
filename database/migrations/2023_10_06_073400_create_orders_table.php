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
            $table->string('product_name')->nullable();

            $table->unsignedBigInteger('franchise_id')->nullable();
            $table->foreign('franchise_id')->references('id')->on('franchises')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');

            $table->date('date')->nullable();
            $table->string('model_number')->nullable();

            $table->integer('quantity')->nullable();

            $table->integer('stock')->nullable();

            $table->decimal('product_price', 8, 2)->default(0);
            $table->decimal('total_price', 8, 2)->default(0);
            
            $table->decimal('sub_total', 8, 2)->default(0);
            $table->decimal('total', 8, 2)->default(0);

            $table->text('description')->nullable();

            $table->enum('status', ['pending', 'accepted', 'processing', 'processed', 'cancelled', 'completed', 'shipped', 'delivered', 'refunded', 'failed', 'returned', 'rejected', 'ready'])->default('pending');

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
