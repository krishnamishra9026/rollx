@extends('layouts.admin')
@section('title', 'Equipment Details')
@section("head")
<style>
    .py-3 {
    padding-top: 1.2rem !important;
    padding-bottom: 1.2rem !important;
}
</style>
@endsection
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark me-1"><i
                                class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                    </div>
                    <h4 class="page-title">{{ $equipment->equipment_name }}</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <div class="row">
            <div class="col-md-6">
                <div class="card" style="min-height: 303px;">
                    <div class="card-header bg-dark text-white">
                        <h5 class="float-start">Equipment Id # {{ $equipment->id }}</h5>
                        <a href="{{ route('admin.equipments.edit', $equipment->id) }}" class="text-white float-end mt-1"><i
                                class="fa fa-edit me-1"></i> Edit</a>
                    </div>
                    <div class="card-body">
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 50%" class="text-start"><span class="fw-bold">Assemble Type
                                        </span><br>
                                        @if($equipment->equipment_assemble_type == 'supplier')
                                        <span class="badge badge-outline-danger">Customize part</span>
                                    @else
                                        <span class="badge badge-outline-dark">Fully assembled equipment</span>
                                    @endif
                                    </td>
                                    <td style="width:50%" class="text-end">
                                        @if ($equipment->status)
                                            <span class="badge border badge-success-lighten">Enabled</span>
                                        @else
                                            <span class="badge border badge-danger-lighten">Disabled</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                            <table style="width:100%; margin-bottom:10px">
                                <tbody>
                                    <tr>
                                        <td style="width:50%" class="text-start"><span class="fw-bold">Installation
                                                Date</span><br>
                                            {{ \Carbon\Carbon::parse($equipment->installation_date)->format('M d, Y') }}
                                        </td>
                                        <td style="width:50%" class="text-end"><span class="fw-bold">Warranty
                                            Upto</span><br>
                                            {{ $equipment->warranty_upto == "custom" ?\Carbon\Carbon::parse( $equipment->warranty_date )->format('M d, Y') : $equipment->warranty_upto.' Week'}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table style="width:100%; margin-bottom:10px">
                                <tbody>
                                    <tr>
                                        <td style="width:50%" class="text-start"><span class="fw-bold">Serial No.</span><br>
                                            {{ $equipment->serial_number ?? "" }} </td>
                                        <td style="width:50%" class="text-end"><span class="fw-bold">Added On</span><br>
                                            {{ \Carbon\Carbon::parse($equipment->created_at)->format('M d, Y') }} </td>
                                    </tr>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card" style="min-height: 303px;">
                    <div class="card-header py-3 bg-dark text-white">
                        Customer Details
                    </div>
                    <div class="card-body">
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 50%" class="text-start"><span class="fw-bold">Customer / Company Name
                                        </span><br> {{ $equipment->customer->company }}</td>
                                    <td style="width: 50%" class="text-end"><span class="fw-bold">Date Added </span><br>
                                        {{ \Carbon\Carbon::parse($equipment->customer->created_at)->format('M d, Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 50%" class="text-start"><span class="fw-bold">Email Address
                                        </span><br> {{ $equipment->customer->email }}</td>
                                    <td style="width: 50%" class="text-end"><span class="fw-bold">Contact Number </span><br>
                                        {{ $equipment->customer->contact }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 100%" class="text-start"><span class="fw-bold">Address </span><br>
                                        {{ $equipment->address->address }} {{ $equipment->address->city }}
                                        {{ $equipment->address->state }} {{ $equipment->address->country }}
                                        {{ $equipment->address->zipcode }}</td>
                                </tr>
                            </tbody>
                        </table>

                    </div> <!-- end card-body-->
                </div>
            </div>

            <div class="col-md-12 table-responive">
                <h4 class="page-title">Parts Details</h4>
                <table class="table table-striped" style="font-size: 14px" id="parts-table">
                    <thead>
                        <tr>
                            <th class="bg-dark text-white">Part ID</th>
                            <th class="bg-dark text-white">Part Name</th>
                            <th class="bg-dark text-white">Category</th>
                            <th class="bg-dark text-white">Qty</th>
                            <th class="bg-dark text-white">Model No</th>
                            <th class="bg-dark text-white">Serial No</th>
                            <th class="bg-dark text-white">Installation Date</th>
                            <th class="bg-dark text-white">Warranty Upto</th>
                        </tr>
                    </thead>
                    <tbody id="parts-row">
                        @foreach ($equipment->parts as $part)
                            <tr>
                                <td>#{{ $part->part_id }}</td>
                                <td>{{ $part->part->part }}</td>
                                <td>{{ $part->part->category->category }}</td>
                                <td>{{ $part->quantity }}</td>
                                <td>{{ $part->part->model_number }}</td>
                                <td>{{ $part->part->serial_number }}</td>
                                <td>{{ \Carbon\Carbon::parse($part->installation_date)->format('M d, Y') }}</td>
                                <td>{{ $equipment->warranty_upto == "custom" ?\Carbon\Carbon::parse( $equipment->warranty_date )->format('M d, Y') : $equipment->warranty_upto.' Week'}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-12 table-responive">
                <h4 class="page-title">Service History</h4>
                <table class="table table-striped" style="font-size: 14px" id="service-history-table">
                    <thead class="text-dark">
                        <tr>
                            <th class="bg-dark text-white">Job Id</th>
                            <th class="bg-dark text-white">Service Type</th>
                            <th class="bg-dark text-white">Schedule</th>
                            <th class="bg-dark text-white">Address</th>
                            <th class="bg-dark text-white">Remark</th>
                            <th class="bg-dark text-white">Status</th>
                            <th class="bg-dark text-white">Technician</th>
                            <th class="bg-dark text-white"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($equipment->jobs as $job)
                            <tr>
                                <td>{{ $job->id }}</td>
                                <td>
                                    {{ $job->equipment->equipment_name }}
                                    <br>
                                    {{ $job->jobType->type }}
                                </td>
                                <td>{{ \Carbon\Carbon::parse($job->start_date)->format('M d, Y') }} <br>

                                    </td>

                                <td class="text-start">
                                    {{ $job->address->address }}
                                    <br>{{ $job->address->city }}
                                    {{ $job->address->country }}
                                    {{ $job->address->zipcode }}
                                </td>
                                <td>{{ $job->technician_remark ?? "Not Found" }}</td>
                                <td>
                                    @if ($job->status == 'pending')
                                        <h4>
                                            <span
                                                class="badge border badge-warning-lighten">{{ ucfirst($job->status) }}</span>
                                        </h4>
                                    @else
                                        <h4>
                                            <span
                                                class="badge border badge-success-lighten">{{ ucfirst($job->status) }}</span>
                                        </h4>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.technicians.show', $job->user_id) }}"
                                        class="text-body fw-semibold">{{ $job->technician->firstname }}
                                        {{ $job->technician->lastname }}</a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.jobs.show', $job->id) }}" class="text-primary">
                                        <i class="fa fa-eye me-1"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
