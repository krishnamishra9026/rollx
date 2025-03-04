@extends('layouts.admin')
@section('title', 'Sales')
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

                        <a href="{{ route('admin.order.sales.index') }}" class="btn btn-sm btn-primary float-end me-1"><i class="mdi mdi-refresh"></i> Reset</a>

                        <button type="submit" class="btn btn-sm btn-danger float-end me-1" form="filterForm"><i class="mdi mdi-filter"></i> Filter</button>
                    </div>
                    <h4 class="page-title">Sales</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        @include('admin.orders.sales.filter')
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <a href="{{ route('admin.sales.export', ['product' => request('product'), 'order_date' => request('order_date'), 'order' => request('order'), 'status' => request('status') ]) }}" class="btn btn-sm btn-primary float-left me-1"><i
                                    class="mdi mdi-export"></i> Export</a>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table id="basic-datatable" class="table table-striped border dt-responsive nowrap w-100"
                                    style="font-size: 13px;">
                                    <thead class="text-dark">
                                        <tr>
                                            <th class="fw-bold">Sale Id</th>
                                            <th class="fw-bold">Product Name</th>
                                            <th class="fw-bold">Order Id</th>
                                            <th class="fw-bold">Francise Name</th>
                                            <th class="fw-bold">Chef Name</th>
                                            <th class="fw-bold">Quantity</th>
                                            <th class="fw-bold">Price</th>
                                            <th class="fw-bold">Order Date</th>
                                            <th class="fw-bold">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sales as $sale)
                                            <tr>
                                                <td>{{ $sale->id }}</td>
                                                <td><a href="{{ route('admin.products.show', $sale->order->product->id)  }}">{{ $sale->order->product->name }}</a> </td>
                                                <td><a href="{{ route('admin.orders.show', $sale->order->id)  }}">#{{ $sale->order->id }}</a> </td>
                                                <td><a href="{{ route('admin.franchises.show', $sale->franchise->id)  }}">{{ @$sale->franchise->firstname }} {{ @$sale->franchise->lastname }}</a></td>
                                                @if($sale->chef_id)
                                                <td><a href="{{ route('admin.chefs.show', $sale->chef->id)  }}">{{ @$sale->chef->firstname }} {{ @$sale->chef->lastname }}</a></td>
                                                @else
                                                <td>---</td>
                                                @endif
                                                <td>{{ $sale->quantity }}</td>
                                                <td>{{ $sale->price }}</td>
                                                <td>{{ \Carbon\Carbon::parse($sale->created_at)->format('M d, Y') }}</td>
                                                <td>
                                                    <button type="button" class="badge {{ $sale->status == 'Sold' ? 'bg-success' : 'bg-primary' }}" style="min-width: 50px;">
                                                        {{ ucfirst($sale->status) }}
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $sales->appends(request()->query())->links('pagination::bootstrap-5') }}
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
        function showHide(id) {
            $("#changeStatus" + id).hide();
            $("#changeSelect" + id).show();
        }
    </script>
@endpush
