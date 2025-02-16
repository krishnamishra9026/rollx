@extends('layouts.admin')
@section('title', 'View Job')

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">

                    <div class="page-title-right">
                      <button class="btn btn-sm btn-primary me-1" id="printButton">Download</button>
                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark me-1"><i
                                class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                    </div>

                    <h4 class="page-title">Job Id #{{ $job->id }}</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h5 class="float-start">Job Details</h5>
                        <a href="{{ route('admin.jobs.edit', $job->id) }}" class="text-white float-end mt-1"><i class="fa fa-edit me-1"></i> Edit</a>
                    </div>
                    <div class="card-body">
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 33.33%"><span class="fw-bold">Equipment </span><br> {{ $job->equipment->equipment_name }}
                                    </td>
                                    <td style="width:33.33%" class="text-center"><span class="fw-bold">Scheduled for </span><br>
                                        {{ \Carbon\Carbon::parse($job->start_date)->format('M d, Y') }} {{ \Carbon\Carbon::parse($job->start_time)->format('h:i A') }} to {{ \Carbon\Carbon::parse($job->end_time)->format('h:i A') }}</td>
                                    <td style="width:33.33%" class="text-end"><span class="fw-bold">Job Status </span><br>
                                        @if ($job->status == 'pending')
                                            <span
                                                class="badge border badge-warning-lighten">{{ ucfirst($job->status) }}</span>
                                        @else
                                            <span
                                                class="badge border badge-success-lighten">{{ ucfirst($job->status) }}</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                            <table style="width:100%; margin-bottom:10px">
                                <tbody>
                                    <tr>
                                        <td style="width: 33.33%"><span class="fw-bold">Service Type </span><br> {{ $job->jobType->type }}
                                        </td>
                                        <td style="width:33.33%" class="text-center"><span class="fw-bold">Added On </span><br>
                                            {{ \Carbon\Carbon::parse($job->created_at)->format('M d, Y') }}</td>
                                        <td style="width:33.33%" class="text-end"><span class="fw-bold"></span><br>
                                        </td>
                                    </tr>
                                </tbody>
                        </table>
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 100%"><span class="fw-bold">Job Description </span><br> {{ $job->description }}
                                    </td>
                                </tr>
                            </tbody>
                    </table>
                    <table style="width:100%; margin-bottom:10px">
                        <tbody>
                            <tr>
                                <td style="width: 100%"><span class="fw-bold">Job Remark </span><br> {{ $job->remark }}
                                </td>
                            </tr>
                        </tbody>
                </table>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-dark text-white text-center">
                        <h4 class="card-title">Actions</h4>
                    </div>
                    <div class="card-body">
                    <div class="row my-1">
                        <div class="col-sm-12">
                            <div class="d-grid">
                                <button type="button" class="btn btn-outline-primary">Send Notification</button>
                            </div>
                        </div>
                        <div class="col-sm-12 my-2">
                            <div class="d-grid">
                                <button type="button" class="btn btn-outline-success">Send Email</button>
                            </div>
                        </div>
                    </div>
                   </div>
                </div>
            </div> --}}
            <div class="col-md-12 table-responive">
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
                        @foreach ($job->equipment->order->parts as $part)
                            <tr>
                                <td>#{{ $part->part_id }}</td>
                                <td>{{ $part->part->part }}</td>
                                <td>{{ $part->part->category->category }}</td>
                                <td>{{ $part->quantity }}</td>
                                <td>{{ $part->part->model_number }}</td>
                                <td>{{ $part->part->serial_number }}</td>
                                <td>{{ \Carbon\Carbon::parse($part->installation_date)->format('M d, Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($part->warranty_upto)->format('M d, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <div class="card" style="min-height: 282px;">
                    <div class="card-header bg-dark text-white">
                        Customer Details
                    </div>
                    <div class="card-body">
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 50%"><span class="fw-bold">Customer / Company Name </span><br> {{ $job->customer->company }}</td>
                                    <td style="width: 50%"><span class="fw-bold">Date Added </span><br> {{ \Carbon\Carbon::parse($job->customer->created_at)->format('M d, Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 100%"><span class="fw-bold">Address </span><br> {{ $job->address->address }} {{ $job->address->city }} {{ $job->address->state }} {{ $job->address->country }} {{ $job->address->zipcode }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 50%"><span class="fw-bold">Email Address </span><br> {{ $job->customer->email }}</td>
                                    <td style="width: 50%"><span class="fw-bold">Contact Number </span><br> {{ $job->customer->contact }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </table>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div>

            <div class="col-md-6">
                <div class="card" style="min-height: 282px;">
                    <div class="card-header bg-dark text-white">
                        Technician Details
                    </div>
                    <div class="card-body">
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 50%"><span class="fw-bold">Technician Name </span><br> {{ $job->technician->firstname }} {{ $job->technician->lastname }}</td>
                                    <td style="width: 50%"><span class="fw-bold">Date Added </span><br> {{ \Carbon\Carbon::parse($job->technician->created_at)->format('M d, Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 100%"><span class="fw-bold">Address </span><br> {{ $job->technician->address }} {{ $job->technician->city }} {{ $job->technician->state }} {{ $job->technician->country }} {{ $job->technician->zipcode }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 50%"><span class="fw-bold">Email Address </span><br> {{ $job->technician->email }}</td>
                                    <td style="width: 50%"><span class="fw-bold">Contact Number </span><br> {{ $job->technician->phone }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </table>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h5 class="float-start">Technician Remarks</h5>
                    </div>
                    <div class="card-body">
                        @isset($job->technician_remark)
                        <p>{{ $job->technician_remark }}</p>
                        @else
                        <p class="text-center py-4">No Remarks</p>
                        @endisset
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h5 class="float-start">EPOD</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <ul class="list-group">
                                    @forelse($job->proof as $proof)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span>
                                                <img src="{{ asset('storage/uploads/jobs/'.$job->id.'/proof'.'/'.$proof->photo) }}" width="300px" height="300px" style="border:1px solid #777"/>
                                            <br>
                                            <small>Technician : {{ $job->technician->firstname }} {{ $job->technician->lastname }}</small>
                                            <br>
                                            <small>{{ \Carbon\Carbon::parse($proof->created_at)->format('D, M d, Y h:i A') }}</small>
                                            </span>
                                            <a href="{{ asset('storage/uploads/jobs/'.$job->id.'/proof'.'/'.$proof->photo) }}" class="btn btn-sm btn-primary" download=""><i class="fa fa-download"></i></a>
                                        </li>
                                    @empty
                                        <p class="text-center py-4">No EPOD uploaded</p>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h5 class="float-start">Customer Signature</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                @isset($job->signature)
                                <div>
                                    <p>Customer Signature</p>
                                    <a href="{{ $job->signature->signature}}" download="{{ $job->customer->name }} Signature">
                                    <img src="{{ $job->signature->signature}}" width="300px" height="300px" style="border:1px solid #777" class="downloadable"/>
                                    </a>
                                    <br>
                                    <small>Click on the Image to download!</small>
                                    <br>
                                    <small>{{ $job->customer->name }}</small>
                                    <br>
                                    <small>{{ \Carbon\Carbon::parse( $job->signature->created_at)->format('D, M d, Y h:i A') }}</small>
                                </div>
                                @else
                                <p class="text-center py-4">No Customer Signature</p>
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

    </div> <!-- container -->


@endsection
@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(e) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Delete it!"
            }).then(t => {
                t.isConfirmed && document.getElementById("delete-form" + e).submit()
            })
        }
    </script>
    <script>
    document.getElementById('printButton').addEventListener('click', function() {
        window.print();
    });
</script>
@endpush
