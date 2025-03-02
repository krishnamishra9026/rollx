<?php

namespace App\Exports\Admin;

use App\Models\Lead;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LeadsExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
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
        $query = Lead::query();

        $query = Lead::with(['admin'])
            ->select('id', 'firstname', 'lastname', 'email', 'phone', 'state', 'city', 'admin_id', 'status', 'next_call_datetime', 'created_at');

        if (!empty($this->filters['date'])) {
            $query->where('created_at', $this->filters['date']);
        }

        if (!empty($this->filters['product']) && !empty($this->filters['product'])) {
            $query->where('product_id', $this->filters['product']);
        }              

        return $query->orderBy('id', 'desc');
    }

    public function map($lead): array
    {                                        
        return [
            $lead->id,
            $lead->firstname. ' '. $lead->lastname,
            $lead->email,
            $lead->phone,
            $lead->state,
            $lead->city,
            $lead->admin ? $lead->admin->firstname.' '.@$lead->admin->lastname : 'N/A',
            $lead->status,
            isset($lead->next_call_datetime) && !empty($lead->next_call_datetime) ? date('Y-m-d H:i:s', strtotime($lead->next_call_datetime)) : 'N/A',
            $lead->created_at->format('Y-m-d H:i:s'),
        ];
    }

    public function headings(): array
    {
        return [
            'Lead Id',
            'Name',
            'Email',
            'Phone',
            'State',
            'City',
            'Assigned Sale Employee',
            'Status',
            'Next call date time',
            'Created At',
        ];
    }
}
