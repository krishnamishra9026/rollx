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
        Schema::create('login_logs', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('admin_id')->nullable();
            $table->foreign('admin_id')->references('id')->on('administrators')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('franchise_id')->nullable();
            $table->foreign('franchise_id')->references('id')->on('franchises')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('chef_id')->nullable();
            $table->foreign('chef_id')->references('id')->on('chefs')->onUpdate('cascade')->onDelete('cascade');

            $table->enum('user_type', ['admin', 'franchise', 'chef'])->default('admin')->nullable();
            $table->string('ip_address');
            $table->timestamp('login_time')->useCurrent();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('login_logs');
    }
};
    