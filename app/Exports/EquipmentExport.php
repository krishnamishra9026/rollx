<?php

namespace App\Exports;

use App\Models\Equipment;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class EquipmentExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    use RegistersEventListeners;


    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $equipments   = Equipment::get();
        $equipments   = $equipments->map(function ($equipment) {
            return [
                'Model Number' => $equipment->equipment_name,
                'Customer / Company' =>  $equipment->customer->name,
                'Installation Date' => Carbon::parse($equipment->installation_date)->format('M d, Y'),
                'Installation Address' => $equipment->address->address.' '. $equipment->address->city.''. $equipment->address->country.''. $equipment->address->zipcode,
                'Warranty Upto' => $equipment->warranty_upto == "custom" ? "Custom" : $equipment->warranty_upto . " Months",
            ];
        });

        return $equipments;
    }

    public function headings(): array
    {
        return [
            'Model Number',
            'Customer / Company',
            'Installation Date',
            'Installation Address',
            'Warranty Upto',
        ];
    }

    use RegistersEventListeners;

    public static function afterSheet(AfterSheet $event)
    {
        $sheet = $event->sheet->getDelegate();
        $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(60);
        $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(50);
        $sheet->getStyle('1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);

        $sheet->getStyle('1')->getFont()->getColor()
            ->setARGB('1F497D');

        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'D4D4D4'],
                ],
            ],
        ];

        $sheet->getStyle('1')->applyFromArray($styleArray);
    }
}
