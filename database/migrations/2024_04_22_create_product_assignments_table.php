<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->enum('assignment_type', ['kitchen', 'cart', 'new_opening', 'franchise']);
            $table->integer('quantity');
            $table->text('comment')->nullable();
            $table->unsignedBigInteger('assigned_by');
            $table->dateTime('assigned_at');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();

            // Add foreign key constraints
            $table->foreign('product_id')
                  ->references('id')
                  ->on('products')
                  ->onDelete('cascade');
                  
            $table->foreign('assigned_by')
                  ->references('id')
                  ->on('administrators')
                  ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_assignments');
    }
};