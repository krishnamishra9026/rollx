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
                                class="mdi mdi-plus"></i> Add
                            New</a>
                            @else

                            <a href="{{ route('chef.order.sales.create') }}" class="btn btn-sm btn-dark float-end"><i
                                class="mdi mdi-plus"></i> Add
                            New</a>

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

        <div class="row" style="display: none;">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">                        

                        <p class="mt-3">Choose Color to mark stock</p>
                        <input type="radio" class="btn-check" 
                                name="subject" id="os">
                        <label for="os" class="btn btn-success">
                            Full Plate
                        </label>
                        
                        <input type="radio" class="btn-check" 
                                name="subject" id="db">
                        <label for="db" class="btn btn-danger">
                                Half Plate
                        </label>

                        <input type="radio" class="btn-check" 
                                name="subject" id="cn" checked>
                        <label for="cn" class="btn btn-warning">
                                Button 3
                        </label>

                        <input type="radio" class="btn-check" 
                                name="subject" id="ds">
                        <label for="ds" class="btn btn-info">
                                Button 4
                        </label>

                        <input type="radio" class="btn-check" 
                                name="subject" id="ds">
                        <label for="ds" class="btn btn-secondary">
                                Button 5
                        </label>


                        <input type="radio" class="btn-check" 
                                name="subject" id="ds">
                        <label for="ds" class="btn btn-warning">
                                Button 6
                        </label>


                        <input type="radio" class="btn-check" 
                                name="subject" id="ds">
                        <label for="ds" class="btn btn-dark">
                                Button 7
                        </label>


                    </div>
                </div>
            </div>
        </div>


        @include('chef.orders.sales.filter')

        @if(isset($order_id))

        @if($sales && count($sales))

        <div class="row">       

            <div class="col-xl-3 col-lg-4">
                <div class="card tilebox-one">
                    <div class="card-body text-center">                    
                        <h5 class="mt-0">Total Quantity</h5>
                        <h2 class="my-2" id="active-users-count">{{ $sales[0]->order->quantity }}</h2>
                        <a class="mb-0 text-dark" href="{{ route('chef.orders.index') }}">    
                            <small>View Details </small>                   
                        </a>
                    </div>
                </div>          
            </div> 

            <div class="col-xl-3 col-lg-4">
                <div class="card tilebox-one">
                    <div class="card-body text-center">                    
                        <h5 class="mt-0">Sold Quantity</h5>
                        <h2 class="my-2" id="active-users-count">{{ $sales[0]->order->quantity  - $sales[0]->order->stock }}</h2>
                        <a class="mb-0 text-dark" href="{{ route('chef.orders.index') }}">    
                            <small>View Details </small>                   
                        </a>
                    </div>
                </div>          
            </div> 

            <div class="col-xl-3 col-lg-4">
                <div class="card tilebox-one">
                    <div class="card-body text-center">                    
                        <h5 class="mt-0">Remaining Quantity</h5>
                        <h2 class="my-2" id="active-users-count">{{ $sales[0]->order->stock }}</h2>
                        <a class="mb-0 text-dark" href="{{ route('chef.orders.index') }}">    
                            <small>View Details </small>                   
                        </a>
                    </div>
                </div>          
            </div> 

             <div class="col-xl-3 col-lg-4">
                <div class="card tilebox-one">
                    <div class="card-body text-center">                    
                        <h5 class="mt-0">Not Sold Quantity</h5>
                        <h2 class="my-2" id="active-users-count">{{ $sales[0]->order->quantity  - $sales[0]->order->stock }}</h2>
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

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table id="basic-datatable" class="table table-striped border dt-responsive nowrap w-100"
                                    style="font-size: 13px;">
                                    <thead class="text-dark">
                                        <tr>
                                            <th class="fw-bold">Sale Id</th>
                                            <th class="fw-bold">Order Id</th>
                                            <th class="fw-bold">Product Name</th>
                                            <th class="fw-bold">Quantity</th>
                                            <th class="fw-bold">Order Date</th>
                                            <th class="fw-bold">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sales as $sale)
                                            <tr>
                                                <td>{{ $sale->id }}</td>
                                                <td><a href="{{ route('chef.orders.show', $sale->order_id) }}"> #{{ $sale->order_id }} </a></td>
                                                <td>{{ $sale->order->product->name }}</td>
                                                <td>{{ $sale->quantity }}</td>
                                                <td>{{ \Carbon\Carbon::parse($sale->created_at)->format('M d, Y') }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-success"
                                                        id="changeStatus{{ $sale->id }}"
                                                        onclick="showHideO({{ $sale->id }})">{{ ucfirst($sale->status) }}</button>
                                                    <select style="display: none;" class="form-select form-select-sm custom-select"
                                                        id="changeSelect{{ $sale->id }}"
                                                        onchange="changeStatus({{ $sale->id }}, this.value)"
                                                        style="display: block">
                                                        <option value="pending" {{ $sale->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="processing" {{ $sale->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                                        <option value="processed" {{ $sale->status == 'processed' ? 'selected' : '' }}>Processed</option>
                                                        <option value="cancelled" {{ $sale->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                        <option value="completed" {{ $sale->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                        <option value="shipped" {{ $sale->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                                        <option value="delivered" {{ $sale->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                                        <option value="refunded" {{ $sale->status == 'refunded' ? 'selected' : '' }}>Refunded</option>
                                                        <option value="failed" {{ $sale->status == 'failed' ? 'selected' : '' }}>Failed</option>
                                                        <option value="returned" {{ $sale->status == 'returned' ? 'selected' : '' }}>Returned</option>
                                                    </select>
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
