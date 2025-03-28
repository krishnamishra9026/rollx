@extends('layouts.admin')
@section('title', 'Products')
@section('head')
    <link href="{{ asset('assets/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<style type="text/css">
    .notification::before {
        content: "🔔 ";
        font-size: 16px;
    }

    input[type="checkbox"].status:not(:checked) + label {
    background-color: #dc3545 !important; /* Red color for disabled state */
    border-color: #dc3545 !important;
    color: white;
}

/* Change color when enabled */
input[type="checkbox"].status:checked + label {
    background-color: #28a745 !important; /* Green color for enabled state */
    border-color: #28a745 !important;
    color: white;
}


</style>
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">

                    <div class="page-title-right">

                        <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-dark float-end"><i  class="mdi mdi-plus"></i> Product</a>
                        <a href="{{ route('admin.product.quantity') }}" class="btn btn-sm btn-secondary float-end me-1"><i  class="mdi mdi-plus"></i> Quantity</a>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-primary float-end me-1"><i  class="mdi mdi-refresh"></i> Reset</a>
                        <button type="submit" class="btn btn-sm btn-danger float-end me-1" form="filterForm"><i  class="mdi mdi-filter"></i> Filter</button>
                    </div>

                    <h4 class="page-title">Products</h4>
                </div>
            </div>
        </div>

        @include('admin.includes.flash-message')

        @if(session('errors'))
        @foreach(session('errors') as $error)
        <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong><i class="dripicons-wrong me-2"></i> </strong>{{ $error }}
        </div>
        @endforeach
        @endif

        @include('admin.products.filter')
        <div class="row py-3">
            <div class="col-12">
                <div class="card">

                    <div class="card-header ">

                        <div class="row">
                            <div class="col-md-8 col-sm-12 mt-1">
                                <a href="{{ route('admin.products.export', ['product' => request('product'), 'order_date' => request('order_date'), 'order' => request('order'), 'status' => request('status') ]) }}" class="btn btn-sm btn-primary text-left">
                                    <i class="mdi mdi-export"></i> Export
                                </a>

                                <a href="{{ route('admin.products.download.sample.csv') }}" class="btn btn-sm btn-secondary" style="float: right;" ><i class="mdi mdi-download"></i> Sample CSV</a>

                            </div>
                            <div class="col-md-4 col-sm-12 mt-1 text-center" style="display: block;">
                                <form action="{{ route('admin.products.import') }}" method="POST" enctype="multipart/form-data" class="d-flex flex-column flex-sm-row align-items-center gap-2">
                                    @csrf
                                    <input type="file" name="file" required class="form-control form-control-sm">
                                    <button type="submit" class="btn btn-sm btn-success" style="white-space: nowrap;"><i class="mdi mdi-import"></i> Import CSV</button>
                                </form>
                            </div>
                        </div>

                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table id="basic-datatable" class="table table-striped border dt-responsive nowrap w-100"
                                    style="font-size: 14px;">
                                    <thead class="bg-dark">
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Outlet Name</th>
                                            <th title="Double Click on quantity to edit quantity of a particular product after enter quantity click outside to save Quantity!"> <i class="mdi mdi-map-marker-outline" style="color: red;"></i> Qty</th>
                                            <th>Sold Qty</th>
                                            <th>Avilable Qty</th>
                                            <th>Price</th>
                                            <th>Orders</th>
                                            <th>Sales</th>
                                            <th>Status</th>
                                            <th>Date Added</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $product->id }}</td>
                                                <td><a href="{{ route('admin.products.show', $product->id) }}"
                                                    class="text-body fw-semibold">{{ $product->name }}</a>
                                                </td>
                                                <td>{{ $product->outlet_name }}</td>
                                               <td>
                                                    <span class="quantity-text" style="cursor: pointer;" data-id="{{ $product->id }}">{{ $product->quantity }}</span>
                                                    <input type="number" class="edit-quantity" data-id="{{ $product->id }}" value="{{ $product->quantity }}" style="display: none; width: 40%">
                                                </td>

                                                <td>{{ $product->sold_quantity ?? 0 }}</td>
                                                <td>{{ $product->available_quantity ?? $product->quantity }}</td>

                                                <td>{{ $product->price }}</td>
                                                <td> <a href="{{ route('admin.orders.index', ['product' => $product->id]) }}" >{{ $product->orders->count() }} </a></td>
                                                <td> <a href="{{ route('admin.sales.index', ['product' => $product->id]) }}" >{{ $product->sales->count() }} </a></td>
                                                <td><input type="checkbox" id="switch{{ $product->id }}"
                                                        @if ($product->status == true) checked @endif
                                                        data-switch="success" value="{{ $product->id }}" class="status" />
                                                    <label for="switch{{ $product->id }}" data-on-label="Enable"
                                                        data-off-label="DIsable"></label>
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($product->created_at)->format('M d, Y') }}</td>
                                                <td class="text-end">
                                                    <a href="#" class="dropdown-toggle arrow-none card-drop"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a href="{{ route('admin.products.edit', $product->id) }}"
                                                            class="dropdown-item"><i class="fa fa-edit me-1"></i>
                                                            Edit
                                                        </a>
                                                        <a href="{{ route('admin.products.show', $product->id) }}"
                                                            class="dropdown-item"><i class="fa fa-eye me-1"></i>
                                                            View</a>

                                                        @if($product->orders->count() > 0)
                                                        <a href="{{ route('admin.orders.index', ['product' => $product->id]) }}"
                                                            class="dropdown-item"><i class="fa fa-eye me-1"></i>
                                                            View Orders</a>
                                                        @endif

                                                        @if($product->sales->count() > 0)
                                                        <a href="{{ route('admin.sales.index', ['product' => $product->id]) }}"
                                                            class="dropdown-item"><i class="fa fa-eye me-1"></i>
                                                            View Sales</a>
                                                        @endif

                                                        @if($product->productPrices->count() > 0)
                                                        <a href="{{ route('admin.product-prices.index', ['product' => $product->id]) }}"
                                                            class="dropdown-item"><i class="fa fa-eye me-1"></i>
                                                            View Prices</a>
                                                        @else
                                                        <a href="{{ route('admin.product-prices.create', ['product' => $product->id]) }}"
                                                            class="dropdown-item"><i class="fa fa-eye me-1"></i>
                                                            Add Franchise Price</a>
                                                        @endif

                                                        @if($product->franchises->count() > 0)
                                                        <a href="{{ route('admin.product-franchises.index', ['product' => $product->id]) }}"
                                                            class="dropdown-item"><i class="fa fa-eye me-1"></i>
                                                            View Assigned Franchises</a>
                                                        @else
                                                        <a href="{{ route('admin.product-franchises.index', ['product' => $product->id]) }}"
                                                            class="dropdown-item"><i class="fa fa-eye me-1"></i>
                                                            Assign to Franchises</a>
                                                        @endif

                                                        <a href="{{ route('admin.product.quantity', ['product' => $product->id]) }}"
                                                            class="dropdown-item"><i class="fa fa-plus me-1"></i>
                                                            Add Quantity</a>

                                                        <a href="javascript:void(0);"
                                                            onclick="confirmDelete({{ $product->id }})"
                                                            class="dropdown-item"><i class="fa fa-trash-alt me-1"></i>
                                                            Delete
                                                        </a>
                                                        <form id='delete-form{{ $product->id }}'
                                                            action='{{ route('admin.products.destroy', $product->id) }}'
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
                                {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
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


<script type="text/javascript">
    

        $(document).on("click", ".quantity-text", function() {
        let $span = $(this);
        let $input = $span.siblings(".edit-quantity");

        $span.hide(); // Hide the span
        $input.show().focus(); 
    });


    $(document).on("blur", ".edit-quantity", function() {
        let $input = $(this);
        let newQuantity = $input.val();
        let productId = $input.data("id");
        let $span = $input.siblings(".quantity-text");

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
        $.ajax({
            url: "{{ route('admin.products.update.quantity') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: productId,
                quantity: newQuantity
            },
            success: function(response) {
                $span.text(newQuantity); // Update span text
            },
            error: function(xhr) {
                alert("Error updating quantity.");
            },
            complete: function() {
                $input.hide(); // Hide input after update
                $span.show(); // Show the span again
            }
        });
    });

</script>

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
                },  {
                    orderable: !0
                 }, {
                    orderable: !0
                },  {
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

        $(".status").change(function() {
            var url = '{{ route('admin.products.change-status', ':id') }}';
            url = url.replace(':id', this.value);
            window.location.href = url;
        });
    </script>
@endpush
