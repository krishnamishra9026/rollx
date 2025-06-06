@extends('layouts.chef')
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
                        @isset($order->id)
                        <a href="{{ route('chef.order.sales.create', ['order_id' => $order->id]) }}" class="btn btn-sm btn-dark float-end"><i
                                class="mdi mdi-plus"></i> Sale</a>
                            @else

                            <a href="{{ route('chef.order.sales.create') }}" class="btn btn-sm btn-dark float-end"><i
                                class="mdi mdi-plus"></i> Sale</a>

                            @endisset

                                <a href="{{ route('chef.order.sales.index') }}" class="btn btn-sm btn-primary float-end me-1"><i
                                    class="mdi mdi-refresh"></i> Reset</a>
                                    <button type="submit" class="btn btn-sm btn-danger float-end me-1" form="filterForm"><i
                                        class="mdi mdi-filter"></i> Filter</button>
                    </div>
                    <h4 class="page-title">Sales</h4>
                </div>
            </div>
        </div>
        @include('chef.includes.flash-message')

        @include('chef.orders.sales.filter')

        @if(isset($order_id))

        @if($sales && count($sales))

        <div class="row">       

            <div class="col-xl-3 col-lg-4">
                <div class="card tilebox-one">
                    <div class="card-body text-center btn btn-primary">                    
                        <h5 class="mt-0 text-uppercase">Total Quantity</h5>
                        <h2 class="my-2" id="active-users-count">{{ $sales[0]->order->quantity }}</h2>
                        <a class="mb-0 text-dark" href="{{ route('chef.orders.index') }}">    
                            <small>View Details </small>                   
                        </a>
                    </div>
                </div>          
            </div> 

            <div class="col-xl-3 col-lg-4">
                <div class="card tilebox-one">
                    <div class="card-body text-center btn btn-secondary">                    
                        <h5 class="mt-0 text-uppercase">Sold Quantity</h5>
                        <h2 class="my-2" id="active-users-count">{{ $sales[0]->order->quantity  - $sales[0]->order->stock }}</h2>
                        <a class="mb-0 text-dark" href="{{ route('chef.orders.index') }}">    
                            <small>View Details </small>                   
                        </a>
                    </div>
                </div>          
            </div> 


            <div class="col-xl-3 col-lg-4">
                <div class="card tilebox-one">
                    <div class="card-body text-center btn btn-success">                    
                        <h5 class="mt-0 text-uppercase"> Quantity Sold By Me</h5>
                        <h2 class="my-2" id="active-users-count">{{ $sales->where('chef_id', auth()->user()->id)->sum('quantity') }}</h2>
                        <a class="mb-0 text-dark" href="{{ route('chef.orders.index') }}">    
                            <small>View Details </small>                   
                        </a>
                    </div>
                </div>          
            </div> 

             <div class="col-xl-3 col-lg-4">
                <div class="card tilebox-one">
                    <div class="card-body text-center btn btn-danger">                    
                        <h5 class="mt-0 text-uppercase">NOt sold Quantity</h5>
                        <h2 class="my-2" id="active-users-count">{{  $sales[0]->order->stock }}</h2>
                        <a class="mb-0 text-dark" href="{{ route('chef.orders.index') }}">    
                            <small>View Details </small>                   
                        </a>
                    </div>
                </div>          
            </div>  

        </div>

        @endif
        
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('chef.sales.export', ['product' => request('product'), 'order_date' => request('order_date'), 'order' => request('order'), 'status' => request('status') ]) }}" class="btn btn-sm btn-primary float-left me-1"><i
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
                                                <td>{{ @$sale->order->product->name }}</td>
                                                <td><a href="{{ route('chef.orders.show', $sale->order_id) }}"> #{{ $sale->order_id }} </a></td>
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
