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
        Schema::create('warehouse_inventories', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('warehouse_item_id')->nullable();
            $table->foreign('warehouse_item_id')->references('id')->on('warehouse_items')->onUpdate('cascade')->onDelete('cascade');

            $table->decimal('cost', 10, 2)->default(0);
            $table->string('unit')->nullable();
            $table->integer('quantity')->default(0);
            $table->date('date_inward')->nullable();
            $table->date('date_outward')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse_inventories');
    }
};
