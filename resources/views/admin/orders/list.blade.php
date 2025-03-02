@extends('layouts.admin')
@section('title', 'Orders')
@section('head')
    <link href="{{ asset('assets/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
@endsection
<?php
$route = url()->full();
session()->put('route', $route);
?>
@section('content')
<style type="text/css">
    
    .no-wrap {
    white-space: nowrap;
}

</style>
    <div class="container-fluid Local_Orders">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-primary float-end me-1"><i
                                class="mdi mdi-refresh"></i> Reset</a>
                        <button type="submit" class="btn btn-sm btn-danger float-end me-1" form="filterForm"><i
                                class="mdi mdi-filter"></i> Filter</button>
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger float-end me-1" style="display: none"
                            id="delete-all">
                            <i class="mdi mdi-delete"></i> {{ __('Delete') }}</a>
                    </div>
                    <h4 class="page-title">Orders</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        @include('admin.orders.filter')
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <a href="{{ route('admin.orders.export', ['product' => request('product'), 'order_date' => request('order_date'), 'order' => request('order'), 'status' => request('status') ]) }}" class="btn btn-sm btn-primary float-left me-1"><i class="mdi mdi-export"></i> Export</a>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table id="basic-datatable" class="table table-striped border dt-responsive w-100"
                                    style="font-size: 13px;">
                                    <thead class="text-dark">
                                        <tr>
                                            <th>Id</th>
                                            <th class="no-wrap">Order Date Time</th>
                                            <th>Qty</th>
                                            <th class="no-wrap">Sub Total</th>
                                            <th>Total</th>
                                            <th>Stock</th>
                                            <th class="no-wrap">Franchise Name</th>
                                            <th class="no-wrap">Product Name</th>
                                            <th class="no-wrap">Change Status</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y H:i A') }}</td>
                                                <td>{{ $order->quantity }}</td>
                                                <td>{{ $order->sub_total }}</td>
                                                <td>{{ $order->total }}</td>
                                                <td>{{ $order->stock }}</td>
                                                <td>
                                                    <a href="{{ route('admin.franchises.show', $order->franchise_id) }}"
                                                        class="text-body fw-semibold">{{ $order->franchise->firstname }} {{ $order->franchise->lastname }}</a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.products.show', $order->product_id) }}"
                                                        class="text-body fw-semibold">
                                                    {{ $order->product->name }}   
                                                    </a>                                                
                                                </td>
                                                <td>
                                                    <select class="form-select form-select-sm custom-select" onchange="changeStatus({{ $order->id }}, this.value)" >
                                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                                            <option value="processed" {{ $order->status == 'processed' ? 'selected' : '' }}>Processed</option>
                                                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                                            <option value="refunded" {{ $order->status == 'refunded' ? 'selected' : '' }}>Refunded</option>
                                                            <option value="failed" {{ $order->status == 'failed' ? 'selected' : '' }}>Failed</option>
                                                            <option value="returned" {{ $order->status == 'returned' ? 'selected' : '' }}>Returned</option>
                                                    </select>   
                                                </td>
                                                <td>
                                                    <a href="#"
                                                        class="border bg-white dropdown-toggle arrow-none card-drop mt-11"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">

                                                        @can('View Order')
                                                        <a href="{{ route('admin.orders.show', $order->id) }}"
                                                            class="dropdown-item"><i class="fa fa-eye me-1"></i>
                                                            View</a>
                                                        @endcan

                                                        @if($order->sales->count() > 0)
                                                        <a href="{{ route('admin.order.sales.index', ['order' => $order->id] ) }}"
                                                            class="dropdown-item"><i class="fa fa-eye me-1"></i>
                                                            View Sales</a>
                                                        @endif

                                                        @can('Delete Order')
                                                        <a href="javascript:void(0);"
                                                            onclick="confirmDelete({{ $order->id }})"
                                                            class="dropdown-item"><i class="fa fa-trash-alt me-1"></i>
                                                            Delete</a>
                                                        @endcan
                                                        <form id='delete-form{{ $order->id }}'
                                                            action='{{ route('admin.orders.destroy', $order->id) }}'
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

        function confirmClone(e) {
            var url = '{{ route('admin.orders.clone', ':id') }}';
            Swal.fire({
                title: "Are you sure?",
                text: "You want to clone this Order!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Clone it!"
            }).then(t => {
                t.isConfirmed && (location.href = url = url.replace(':id', e));
            })
        }
    </script>
    <script>
        function changeStatus(id, value) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                }
            });
            var formData = {
                order_id: id,
                status: value
            };
            $.ajax({
                type: 'POST',
                url: '{{ route('admin.orders.change-status') }}',
                data: formData,
                dataType: 'json',
                beforeSend: function() {
                    console.log(formData);
                },
                success: function(res, status) {
                    window.location.reload();
                },
                error: function(res, status) {
                    console.log(res);
                }
            });
        }
    </script>
@endpush
