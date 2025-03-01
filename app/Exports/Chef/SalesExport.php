<?php

namespace App\Exports\Chef;

use App\Models\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SalesExport implements FromQuery, WithHeadings, WithMapping
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

    public function collection()
    {
        return Sale::all();
    }

    public function query()
    {
        $query = Sale::query();


        $query = Sale::with(['order', 'product'])
            ->select('id', 'order_id', 'product_id', 'quantity', 'price', 'created_at', 'status', 'created_at');

        if (!empty($this->filters['date'])) {
            $query->where('created_at', $this->filters['date']);
        }

        if (!empty($this->filters['product']) && !empty($this->filters['product'])) {
            $query->where('product_id', $this->filters['product']);
        }              

        return $query->where('franchise_id', auth()->user()->franchise_id)
        ->where('chef_id', auth()->user()->id)
        ->orderBy('id', 'desc');
    }

    public function map($sale): array
    {              
        return [
            $sale->id,
            $sale->order_id,
            $sale->product->name ?? 'N/A',
            $sale->quantity,
            $sale->price,
            $sale->order->created_at->format('Y-m-d H:i:s') ?? 'N/A',
            $sale->status,
            $sale->created_at->format('Y-m-d H:i:s'),
        ];
    }

    public function headings(): array
    {
        return [
            'Sale Id',
            'Order Id',
            'Product Name',
            'Quantity',
            'Price',
            'Order Date',
            'Status',
            'Created At',
        ];
    }
}
