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
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->enum('assignment_type', ['kitchen', 'cart', 'new_opening', 'franchise']);
            $table->integer('quantity');
            $table->text('comment')->nullable();
            $table->foreignId('assigned_by')->constrained('administrators');
            $table->dateTime('assigned_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_assignments');
    }
};