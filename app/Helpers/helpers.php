<?php

use Illuminate\Support\Facades\DB;

if (!function_exists('getFranchiseProductTotalQuantity')) {
    function getFranchiseProductTotalQuantity($franchiseId, $productId)
    {
        return DB::table('orders')
            ->where('franchise_id', $franchiseId)
            ->where('product_id', $productId)
            ->sum('quantity');
    }
}