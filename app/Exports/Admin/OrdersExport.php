<?php

namespace App\Exports\Admin;


use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class OrdersExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
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
        $query = Order::query();

        $query = Order::with(['product'])
            ->select('id', 'quantity', 'stock', 'sub_total', 'total', 'franchise_id', 'product_id', 'created_at', 'status', 'created_at');

        if (!empty($this->filters['date'])) {
            $query->where('created_at', $this->filters['date']);
        }

        if (!empty($this->filters['product']) && !empty($this->filters['product'])) {
            $query->where('product_id', $this->filters['product']);
        }              

        return $query->orderBy('id', 'desc');
    }

    public function map($order): array
    {                          
        return [
            $order->id,
            $order->quantity,
            $order->stock,
            $order->sub_total,
            $order->total,
            $order->franchise->firstname.' '.$order->franchise->lastname ?? 'N/A',
            $order->product->name ?? 'N/A',
            $order->created_at->format('Y-m-d H:i:s') ?? 'N/A',
            $order->status,
            $order->created_at->format('Y-m-d H:i:s'),
        ];
    }

    public function headings(): array
    {
        return [
            'Order Id',
            'Quantity',
            'Stock',
            'Sub Total',
            'Total',
            'Franchise',
            'Product Name',
            'Order Date',
            'Status',
            'Created At',
        ];
    }
}
