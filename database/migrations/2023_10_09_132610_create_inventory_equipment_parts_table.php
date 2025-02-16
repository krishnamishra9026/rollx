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
        Schema::create('inventory_equipment_parts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inventory_equipment_id')->nullable();
            $table->foreign('inventory_equipment_id')->references('id')->on('inventory_equipments')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('part_id')->nullable();
            // $table->foreign('part_id')->references('id')->on('parts')->onUpdate('cascade')->onDelete('cascade');
            $table->string('quantity')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_equipment_parts');
    }
};
