@extends('layouts.admin')
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
  
                    <h4 class="page-title">Add Quantity to Product</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        @include('admin.products.quantity.filter')
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <ul class="nav nav-tabs" id="franchiseTabs">
                            <li class="nav-item">
                                <a class="nav-link active" id="product-tab" data-bs-toggle="tab" href="#productList">Add Quantity</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="franchise-tab" data-bs-toggle="tab" href="#franchiseList">Add History </a>
                            </li>
                        </ul>

                        <div class="tab-content mt-3">
                            <!-- Product Franchise List -->
                            <div class="tab-pane fade show active" id="productList">

                                

                                <div class="table-responsive">

                                    <div class="card-dd mb-2">
                                        <button type="submit" class="btn btn-sm btn-success me-1 mb-2" style="float: right;" form="CreateOrders">Save</button>
                                    </div>

                                    <table id="product-datatable" class="table table-striped border dt-responsive nowrap w-100" style="font-size: 13px;">
                                        <thead class="text-dark">
                                            <tr>
                                                <th class="fw-bold text-nowrap">Product Id</th>
                                                <th class="fw-bold text-nowrap">Product Name</th>
                                                <th class="fw-bold text-nowrap">Product Total Quantity</th>
                                                <th class="fw-bold text-nowrap">Product Sold Quantity</th>
                                                <th class="fw-bold text-nowrap">Product Avilable Quantity</th>
                                                <th class="fw-bold text-nowrap">Add Quantity</th>
                                            </tr>
                                        </thead>
                                        <form method="POST" action="{{ route('admin.product-quantities.store') }}" id="CreateOrders">
                                        @csrf
                                        <tbody>
                                            @foreach ($products as $product)
                                                <tr>
                                                    <td>{{ $product->id }}</td>
                                                    <td>
                                                        <a href="{{ route('franchise.products.show', $product->id) }}" class="text-body fw-semibold">
                                                            {{ $product->name }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        {{ $product->quantity }}
                                                    </td>

                                                    <td>
                                                        {{ $product->sold_quantity }}
                                                    </td>

                                                    <td>
                                                        {{ $product->available_quantity }}
                                                    </td>

                                                    <td class="float-center">
                                                        <input type="number" name="quantity[]" value="0" class="form-control" required min="0">
                                                        <input type="hidden" name="product_id[]" value="{{ $product['id'] }}">
                                                    </td>

                                                 
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tr>
                                            <td colspan="7">
                                                <button type="submit" class="btn btn-sm btn-success" style="float: right;">Save</button>
                                            </td>
                                        </tr>
                                    </form>
                                    </table>
                                    {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
                                </div>
                            </div>

                            <!-- Franchise Product List -->
                            <div class="tab-pane fade" id="franchiseList">

                                <div class="col-md-12 table-responsive">
                                    <table id="basic-datatable" class="table table-striped border dt-responsive nowrap w-100" style="font-size: 13px;">
                                        <thead class="bg-dark">
                                            <tr>
                                                <th class="fw-bold">Product Id</th>
                                                <th class="fw-bold">Product Name</th>
                                                <th class="fw-bold">Product Old Quantity</th>
                                                <th class="fw-bold">Product Added Quantity</th>
                                                <th class="fw-bold">Product New Quantity</th>
                                                <th class="fw-bold">Added On</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($logs as $log)
                                                <tr>
                                                    <td>{{ $log->product_id }}</td>
                                                    <td>{{ $log->product->name }}</td>
                                                    <td>{{ $log->old_quantity }}</td>
                                                    <td>{{ $log->added_quantity }}</td>
                                                    <td>{{ $log->new_quantity }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($log->date_added)) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $logs->appends(request()->query())->links('pagination::bootstrap-5') }}
                                           
                                    
                                </div>
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
                    orderable: !0,
                }, {        
                    orderable: !0,
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
