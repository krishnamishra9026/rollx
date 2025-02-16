@extends('layouts.admin')
@section('title', 'View Equipment')

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
                    <h4 class="page-title">View Equipment</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h5 class="float-start">{{ $equipment->equipment_name }}</h5>
                        <a href="{{ route('admin.inventory-equipment.edit', $equipment->id) }}" class="text-white float-end mt-1"><i
                                class="fa fa-edit me-1"></i> Edit</a>
                    </div>
                    <div class="card-body">
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 50%"><span class="fw-bold">Date Added </span><br>
                                        {{ \Carbon\Carbon::parse($equipment->date_added)->format('M d Y')  }}</td>
                                    <td style="width: 50%" class="text-end"><span class="fw-bold">Quantity </span><br>
                                        {{ count($equipment->serial_nos) }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr class="pt-2">
                                    <td style="width: 100%;"><span class="fw-bold">Remark </span><br>
                                        {{ $equipment->remark }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12 table-responive">
                <h4 class="page-title">Available Serial Numbers</h4>
                <table class="table table-striped" style="font-size: 14px" id="parts-table">
                    <thead>
                        <tr>
                            <th class="bg-dark text-white">Serial No.</th>
                            <th class="bg-dark text-white text-end">Status</th>
                        </tr>
                    </thead>
                    <tbody id="parts-row">
                        @foreach ($equipment->serial_nos as $serial_no)
                            <tr>
                                <td>{{ $serial_no->serial_no }}</td>
                                <td class="text-end"><span class="badge badge-outline-success">Available</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-12 table-responive">
                <h4 class="page-title">Used Serial Numbers</h4>
                @if(count($equipment->deducted_serial_nos) > 0)
                <table class="table table-striped" style="font-size: 14px" id="parts-table">
                    <thead>
                        <tr>
                            <th class="bg-dark text-white">Serial No.</th>
                            <th class="bg-dark text-white text-end">Status</th>
                        </tr>
                    </thead>
                    <tbody id="parts-row">
                        @foreach ($equipment->deducted_serial_nos as $serial_no)
                            <tr>
                                <td>{{ $serial_no->serial_no }}</td>
                                <td class="text-end"><span class="badge badge-outline-danger">Used</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="card">
                    <div class="card-body">
                        <p class="text-center py-4">Not Found</p>
                    </div>
                </div>
                @endif
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
                        </tr>
                    </thead>
                    <tbody id="parts-row">
                        @foreach ($equipment->parts as $part)
                            <tr>
                                <td>#{{ $part->part_id }}</td>
                                <td>{{ $part->part->part }}</td>
                                <td>{{ $part->part->category->category }}</td>
                                <td>{{ $part->quantity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
