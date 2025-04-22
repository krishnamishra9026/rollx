<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('product_assignments', function (Blueprint $table) {
            $table->enum('status', ['active', 'inactive'])->default('active')->after('assigned_at');
        });
    }

    public function down()
    {
        Schema::table('product_assignments', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};