@extends('layouts.franchise')
@section('title', 'Purchase Orders')
@section('head')
    <link href="{{ asset('assets/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container-fluid Purchase_Orders">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ route('franchise.orders.index') }}" class="btn btn-sm btn-primary float-end me-1"><i class="mdi mdi-refresh"></i> Reset</a>
                        <button type="submit" class="btn btn-sm btn-danger float-end me-1" form="filterForm"><i class="mdi mdi-filter"></i> Filter</button>
                    </div>
                    <h4 class="page-title">Orders</h4>
                </div>
            </div>
        </div>
        @include('franchise.includes.flash-message')
        @include('franchise.orders.filter')
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <a href="{{ route('franchise.orders.export', ['product' => request('product'), 'order_date' => request('order_date'), 'order' => request('order'), 'status' => request('status') ]) }}" class="btn btn-sm btn-primary float-left me-1"><i class="mdi mdi-export"></i> Export</a>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table id="basic-datatable" class="table table-striped border dt-responsive nowrap w-100"
                                    style="font-size: 13px;">
                                    <thead class="text-dark">
                                        <tr>
                                            <th class="fw-bold">Order Id</th>
                                            <th class="fw-bold">Product Name</th>
                                            <th class="fw-bold">Qty</th>
                                            <th class="fw-bold">Sub Total</th>
                                            <th class="fw-bold">Total</th>
                                            <th class="fw-bold">Sold Qty</th>
                                            <th class="fw-bold">Wastage Qty</th>
                                            <th class="fw-bold">Total Qty</th>
                                            <th class="fw-bold">Stock</th>
                                            <th class="fw-bold">Order Date Time</th>
                                            <th class="fw-bold">Status</th>
                                            <th class="fw-bold">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td><a href="{{ route('franchise.products.show', $order->product->id)  }}">{{ $order->product_name }}</a></td>
                                                <td>{{ $order->quantity }}</td>
                                                <td>{{ $order->sub_total }}</td>
                                                <td>{{ $order->total }}</td>
                                                <td>{{ $order->sales()->where('status', 'Sold')->sum('quantity') }}</td>
                                                <td>{{ $order->sales()->where('status', 'Wastage')->sum('quantity') }}</td>
                                                <td>{{ $order->quantity - $order->stock }}</td>
                                                <td>{{ $order->stock }}</td>
                                                <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y H:i A') }}</td>
                                                <td>
                                                @php
                                                    $statusClasses = [
                                                        'pending' => 'bg-primary',
                                                        'accepted' => 'bg-secondary',
                                                        'processing' => 'bg-secondary',
                                                        'processed' => 'bg-danger',
                                                        'cancelled' => 'bg-warning',
                                                        'completed' => 'bg-success info',
                                                        'shipped' => 'bg-light text-dark',
                                                        'delivered' => 'bg-success',
                                                        'refunded' => 'bg-primary',
                                                        'failed' => 'bg-dark text-light',
                                                        'returned' => 'bg-info',
                                                    ];

                                                    $badgeClass = $statusClasses[$order->status] ?? 'bg-secondary';
                                                    @endphp

                                                    <button class="badge {{ $badgeClass }}" style="min-width: 65px;"> {{ ucfirst($order->status) }}</button>
                                                </td>
                                                <td>
                                                    <a href="#" class="border bg-white dropdown-toggle arrow-none card-drop"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">

                                                        <a href="{{ route('franchise.orders.show', $order->id) }}"
                                                            class="dropdown-item"><i class="fa fa-eye me-1"></i>
                                                            View</a>

                                                        @if($order->status == 'delivered' || $order->status == 'completed')

                                                        <a href="{{ route('franchise.order.sales.index', ['order_id' => $order->id]) }}"
                                                            class="dropdown-item"><i class="fa fa-eye me-1"></i>
                                                            View/Create Sales</a>

                                                        @endif

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
                text: "PO needs to be deleted on Moneyworks manually!",
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
                url: '{{ route("franchise.orders.change-status") }}',
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

    <script>
        function showHide(id) {
            $("#changeStatus" + id).hide();
            $("#changeSelect" + id).show();
        }
    </script>
@endpush
