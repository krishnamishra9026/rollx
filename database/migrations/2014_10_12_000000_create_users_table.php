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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('company')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('alternate_email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('iso2')->nullable();
            $table->string('dialcode')->nullable();
            $table->string('contact')->nullable();
            $table->string('alternate_contact')->nullable();
            $table->string('alternate_iso2')->nullable();
            $table->string('alternate_dialcode')->nullable();
            $table->boolean('status')->default(true);
            $table->string('avatar')->nullable();
            $table->string('password');
            $table->string('remark')->nullable();            
            $table->unsignedBigInteger('administrator_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
