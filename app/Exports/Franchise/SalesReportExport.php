<?php

namespace App\Exports\Franchise;

use App\Models\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class SalesReportExport implements FromCollection, WithHeadings, WithMapping, WithEvents, ShouldAutoSize
{

    protected $startDate;
    protected $endDate;
    protected $status;
    protected $product;

    public function __construct($startDate = null, $endDate = null, $status = null, $product = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->status = $status;
        $this->product = $product;
    }

    public function collection()
    {
        $query = Sale::with(['product', 'franchise'])->where('franchise_id', auth()->user()->id);

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('created_at', [$this->startDate, $this->endDate]);
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        if ($this->product) {
            $query->where('product_id', $this->product);
        }

        return $query->select('product_id', 'franchise_id', 'quantity', 'price', 'created_at', 'status')->get();
    }

    public function headings(): array
    {
        return ['Product Name', 'Franchise Name', 'Quantity', 'Amount', 'Order Date', 'Status'];
    }

    public function map($sale): array
    {
        return [
            $sale->product->name,
            $sale->franchise->firstname . ' ' . $sale->franchise->lastname,
            $sale->quantity,
            $sale->price,
            $sale->created_at,
            ucfirst($sale->status),
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $query = Sale::with(['product', 'franchise'])->where('franchise_id', auth()->user()->id);

                if ($this->startDate && $this->endDate) {
                    $query->whereBetween('created_at', [$this->startDate, $this->endDate]);
                }

                if ($this->status) {
                    $query->where('status', $this->status);
                }

                if ($this->product) {
                    $query->where('product_id', $this->product);
                }

                $sales = $query->selectRaw('SUM(quantity) as total_quantity, SUM(price) as total_amount')->first();

                $lastRow = $query->where('franchise_id', auth()->user()->id)->count() + 2; 

                // Set Total Row values
                $event->sheet->setCellValue('B' . $lastRow, 'Total');
                $event->sheet->setCellValue('C' . $lastRow, $sales->total_quantity);
                $event->sheet->setCellValue('D' . $lastRow, $sales->total_amount);

                // Style the heading row (first line)
                $event->sheet->getStyle('A1:F1')->applyFromArray([
                    'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '4F81BD']
                    ],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
                ]);

                // Style the last row (Total row)
                $event->sheet->getStyle("B{$lastRow}:D{$lastRow}")->applyFromArray([
                    'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '4F81BD']
                    ],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
                ]);
            },
        ];
    }
}