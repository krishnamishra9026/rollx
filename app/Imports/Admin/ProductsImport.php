<?php

namespace App\Imports\Admin;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        if (!Product::where('name', $row['name'])->exists()) {

            return new Product([
                'name' => $row['name'],
                'outlet_name' => $row['outlet_name'] ?? '',
                'quantity' => $row['quantity'],
                'sold_quantity' => 0,
                'available_quantity' => $row['quantity'],
                'price' => $row['price'],
                'sold_color' => $row['sold_color'] ?? '',
                'selling_type' => $row['selling_type'] ?? '',
                'status' => $row['status'] ?? 0,
            ]);
        }

        return null; 
    }
}
