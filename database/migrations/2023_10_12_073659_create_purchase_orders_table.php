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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_id')->nullable();
            /*$table->foreign('supplier_id')->references('id')->on('suppliers')->onUpdate('cascade')->onDelete('cascade');*/
            $table->text("project_reference")->nullable();
            $table->string("model_number")->nullable();
            $table->unsignedBigInteger("quantity")->nullable();
            $table->text("remarks")->nullable();
            $table->string("due_date")->nullable();
            $table->string("order_date")->nullable();
            $table->text("suplier_remarks")->nullable();
            $table->unsignedBigInteger("percentage")->nullable();
            $table->enum('status', ['PO Generated', 'In Progress', 'Completed', 'Delivered'])->default('PO Generated');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
