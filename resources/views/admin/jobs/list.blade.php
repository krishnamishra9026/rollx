@extends('layouts.admin')
@section('title', 'Jobs')
@section('head')
    <link href="{{ asset('assets/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ route('admin.jobs.create') }}" class="btn btn-sm btn-dark float-end"><i
                                class="mdi mdi-plus"></i> Add
                            New</a>
                                <a href="{{ route('admin.jobs.index') }}" class="btn btn-sm btn-primary float-end me-1"><i
                                    class="mdi mdi-refresh"></i> Reset</a>
                                    <button type="submit" class="btn btn-sm btn-danger float-end me-1" form="filterForm"><i
                                        class="mdi mdi-filter"></i> Filter</button>
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger float-end me-1" style="display: none"
                            id="delete-all">
                            <i class="mdi mdi-delete"></i> {{ __('Delete') }}</a>
                    </div>
                    <h4 class="page-title">Jobs</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        @include('admin.jobs.filter')
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table id="basic-datatable" class="table table-striped border dt-responsive nowrap w-100"
                                    style="font-size: 13px;">
                                    <thead class="text-dark">
                                        <tr>
                                            <th class="fw-bold">Job Id</th>
                                            <th class="fw-bold">Customer</th>
                                            <th class="fw-bold">Service Type</th>
                                            <th class="fw-bold">Schedule</th>
                                            <th class="fw-bold">Address</th>
                                            <th class="fw-bold">Status</th>
                                            <th class="fw-bold">Technician</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jobs as $job)
                                            <tr>
                                                <td>{{ $job->id }}</td>
                                                <td>
                                                    <a href="{{ route('admin.customers.show', $job->user_id) }}"
                                                        class="text-body fw-semibold">{{ $job->customer->company }}</a>
                                                </td>
                                                <td>
                                                    {{ $job->equipment->equipment_name }}
                                                    <br>
                                                    {{ $job->jobType->type }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($job->start_date)->format('M d, Y') }} <br> {{ \Carbon\Carbon::parse($job->start_time)->format('h:i A') }}<br> {{ \Carbon\Carbon::parse($job->end_time)->format('h:i A') }}</td>

                                                <td class="text-start">
                                                    {{ $job->address->address }}
                                                    <br>{{ $job->address->city }}
                                                    {{ $job->address->country }}
                                                    {{ $job->address->zipcode }}
                                                </td>

                                                <td>
                                                    @if($job->status == 'pending')
                                                        <h4>
                                                            <span class="badge border badge-warning-lighten">{{ ucfirst($job->status) }}</span>
                                                        </h4>
                                                    @else
                                                        <h4>
                                                            <span class="badge border badge-success-lighten">{{ ucfirst($job->status) }}</span>
                                                        </h4>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.technicians.show', $job->technician_id) }}"
                                                        class="text-body fw-semibold">{{ $job->technician->firstname }} {{ $job->technician->lastname }}</a>
                                                </td>
                                                <td>
                                                    <a href="#" class="border bg-white dropdown-toggle arrow-none card-drop"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        @if($job->status == 'completed')
                                                        @if(count($job->proof) > 0 || isset($job->signature))
                                                        <a href="{{ route('admin.jobs.epod', $job->id) }}"
                                                            class="dropdown-item"><i class="fa fa-file me-1"></i>
                                                            EPOD</a>
                                                        @endif
                                                        @endif
                                                        <a href="{{ route('admin.jobs.edit', $job->id) }}"
                                                            class="dropdown-item"><i class="fa fa-edit me-1"></i>
                                                            Edit</a>
                                                        <a href="{{ route('admin.jobs.show', $job->id) }}"
                                                            class="dropdown-item"><i class="fa fa-eye me-1"></i>
                                                            View</a>
                                                        <a href="javascript:void(0);"
                                                            onclick="confirmDelete({{ $job->id }})"
                                                            class="dropdown-item"><i class="fa fa-trash-alt me-1"></i>
                                                            Delete</a>
                                                        <form id='delete-form{{ $job->id }}'
                                                            action='{{ route('admin.jobs.destroy', $job->id) }}'
                                                            method='POST'>
                                                            <input type='hidden' name='_token'
                                                                value='{{ csrf_token() }}'>
                                                            <input type='hidden' name='_method' value='DELETE'>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $jobs->appends(request()->query())->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/vendor/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/responsive.bootstrap4.min.js') }}"></script>


    <!-- Datatable Init js -->
    <script>
        $(function() {
            $("#basic-datatable").DataTable({
                paging: !1,
                pageLength: 20,
                lengthChange: !1,
                searching: !1,
                ordering: !0,
                info: !1,
                autoWidth: !1,
                responsive: !0,
                order: [
                    [0, "desc"]
                ],
                columnDefs: [{
                    targets: [0],
                    visible: !0,
                    searchable: !0
                }],
                columns: [{
                    orderable: !0,
                }, {
                    orderable: !0,
                }, {
                    orderable: !0,
                }, {
                    orderable: !0
                }, {
                    orderable: !0
                }, {
                    orderable: !0
                }, {
                    orderable: !0
                }, {
                    orderable: !1
                }, ]
            })
        });

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
@endpush
