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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('company')->nullable();
            $table->string('firstname');
            $table->string('lastname')->nullable();
            $table->string('email')->unique();
            $table->string('email_additional')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('iso2')->nullable();
            $table->string('dialcode')->nullable();
            $table->string('phone')->nullable();
            $table->string('alternate_phone')->nullable();
            $table->string('alternate_dialcode')->nullable();
            $table->string('helpline_phone')->nullable();
            $table->string('helpline_dialcode')->nullable();
            $table->string('fax')->nullable();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->string('gender')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('status')->default('Fresh')->nullable();
            $table->text('fcm_token')->nullable();
            $table->longText('remarks')->nullable();
            $table->datetime('next_call_datetime')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
