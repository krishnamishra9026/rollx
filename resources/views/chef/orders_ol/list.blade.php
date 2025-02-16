@extends('layouts.chef')
@section('title', 'Purchase Orders')
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
                                <a href="{{ route('chef.purchase-orders.index') }}" class="btn btn-sm btn-primary float-end me-1"><i
                                    class="mdi mdi-refresh"></i> Reset</a>
                                    <button type="submit" class="btn btn-sm btn-danger float-end me-1" form="filterForm"><i
                                        class="mdi mdi-filter"></i> Filter</button>
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger float-end me-1" style="display: none"
                            id="delete-all">
                            <i class="mdi mdi-delete"></i> {{ __('Delete') }}</a>
                    </div>
                    <h4 class="page-title">Purchase Orders</h4>
                </div>
            </div>
        </div>
        @include('chef.includes.flash-message')
        @include('chef.purchase-orders.filter')
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
                                            <th class="fw-bold">Purchase Order Id</th>                                           
                                            <th class="fw-bold">Date</th>
                                            <th class="fw-bold">Customer</th>
                                            <th class="fw-bold">Project Name</th>
                                            <th class="fw-bold">Address</th>
                                            <th class="fw-bold">Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ '#PO-00'.$order->id }}</td>                                               
                                                <td>{{ \Carbon\Carbon::parse($order->order->date)->format('M d, Y') }}</td>
                                                <td>                                                    
                                                    <a href="{{ route('admin.customers.show', $order->order->user_id) }}"
                                                        class="text-body fw-semibold">{{ $order->order->customer->name }}</a>
                                                </td>
                                                <td>{{ $order->order->project_name }}</td>
                                                <td class="text-start">
                                                    {{ $order->order->address->address }}
                                                    <br>{{ $order->order->address->city }}
                                                    {{ $order->order->address->country }}
                                                    {{ $order->order->address->zipcode }}
                                                </td>
                                                
                                                <td>
                                                    @if($order->order->status == 'pending')
                                                        <h4>
                                                            <span class="badge border badge-warning-lighten">{{ ucfirst($order->order->status) }}</span>
                                                        </h4>
                                                    @else
                                                        <h4>
                                                            <span class="badge border badge-success-lighten">{{ ucfirst($order->order->status) }}</span>
                                                        </h4>
                                                    @endif
                                                </td>                                               
                                                <td>
                                                    <a href="#" class="border bg-white dropdown-toggle arrow-none card-drop"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">                                                       
                                                        <a href="{{ route('chef.purchase-orders.show', $order->id) }}"
                                                            class="dropdown-item"><i class="fa fa-eye me-1"></i>
                                                            View</a>                                                       
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $orders->appends(request()->query())->links('pagination::bootstrap-5') }}
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
                    orderable: !0
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
