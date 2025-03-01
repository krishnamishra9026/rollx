<?php

namespace App\Exports\Admin;


use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProductsExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function query()
    {
        $query = Product::query();

        $query = Product::select('id', 'name', 'outlet_name', 'quantity', 'price', 'model_number', 'created_at');

        if (!empty($this->filters['date'])) {
            $query->where('created_at', $this->filters['date']);
        }

        if (!empty($this->filters['product']) && !empty($this->filters['product'])) {
            $query->where('product_id', $this->filters['product']);
        }              

        return $query->orderBy('id', 'desc');
    }

    public function map($product): array
    {                          
        return [
            $product->id,
            $product->name,
            $product->outlet_name,
            $product->quantity,
            $product->price,
            $product->model_number ?? '',
            $product->created_at->format('Y-m-d H:i:s'),
        ];
    }

    public function headings(): array
    {
        return [
            'Product Id',
            'Product Name',
            'Outlet Name',
            'quantity',
            'Price',
            'Model Number',
            'Created At',
        ];
    }
}
