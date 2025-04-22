<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('warehouse_inventory')->default(false);
            $table->boolean('franchise_sale')->default(false);
            $table->boolean('customer_sale')->default(false);
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['warehouse_inventory', 'franchise_sale', 'customer_sale']);
        });
    }
};