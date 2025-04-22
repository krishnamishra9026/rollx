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

    .quantity-cell {
        padding: 4px 8px;
        border-radius: 4px;
        display: inline-block;
    }

    .threshold-warning {
        border: 2px solid #dc3545;
        color: #dc3545;
        font-weight: bold;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-dark float-end"><i class="mdi mdi-plus"></i> Product</a>
                    <a href="{{ route('admin.product.quantity') }}" class="btn btn-sm btn-secondary float-end me-1"><i class="mdi mdi-plus"></i> Quantity</a>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-primary float-end me-1"><i class="mdi mdi-refresh"></i> Reset</a>
                    <button type="submit" class="btn btn-sm btn-danger float-end me-1" form="filterForm"><i class="mdi mdi-filter"></i> Filter</button>
                </div>
                <h4 class="page-title">Products</h4>
            </div>
        </div>
    </div>

    @include('admin.products.filter')

    <div class="row py-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatable" class="table table-striped border dt-responsive nowrap w-100" style="font-size: 14px;">
                            <thead class="bg-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Outlet Name</th>
                                    <th title="Double Click on quantity to edit quantity of a particular product after enter quantity click outside to save Quantity!"> <i class="mdi mdi-map-marker-outline" style="color: red;"></i> Qty</th>
                                    <th>Sold Qty</th>
                                    <th>Available Qty</th>
                                    <th>Price</th>
                                    <th>Orders</th>
                                    <th>Sales</th>
                                    <th>Product unit</th>
                                    <th>Status</th>
                                    <th>Date Added</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td><a href="{{ route('admin.products.show', $product->id) }}" class="text-body fw-semibold">{{ $product->name }}</a></td>
                                        <td>{{ $product->outlet_name }}</td>
                                        <td>
                                            <div class="quantity-cell {{ $product->quantity <= $product->threshold ? 'threshold-warning' : '' }}"
                                                data-bs-toggle="tooltip" 
                                                data-bs-placement="top"
                                                title="{{ $product->quantity <= $product->threshold ? 'Stock below threshold ('.$product->threshold.')' : '' }}">
                                                {{ $product->quantity }}
                                            </div>
                                        </td>
                                        <td>{{ $product->sold_quantity ?? 0 }}</td>
                                        <td>{{ $product->available_quantity ?? $product->quantity }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td> <a href="{{ route('admin.orders.index', ['product' => $product->id]) }}" >{{ $product->orders->count() }} </a></td>
                                        <td> <a href="{{ route('admin.sales.index', ['product' => $product->id]) }}" >{{ $product->sales->count() }} </a></td>
                                        <td>{{ @$product->unit->name }}</td>
                                        <td>
                                            <input type="checkbox" id="switch{{ $product->id }}" 
                                                @if ($product->status == true) checked @endif
                                                data-switch="success" value="{{ $product->id }}" class="status" />
                                            <label for="switch{{ $product->id }}" data-on-label="Enable" data-off-label="Disable"></label>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($product->created_at)->format('M d, Y') }}</td>
                                        <td class="text-end">
                                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="{{ route('admin.products.edit', $product->id) }}" class="dropdown-item"><i class="fa fa-edit me-1"></i> Edit</a>
                                                <a href="{{ route('admin.products.show', $product->id) }}" class="dropdown-item"><i class="fa fa-eye me-1"></i> View</a>
                                                @if($product->orders->count() > 0)
                                                    <a href="{{ route('admin.orders.index', ['product' => $product->id]) }}" class="dropdown-item"><i class="fa fa-eye me-1"></i> View Orders</a>
                                                @endif
                                                @if($product->sales->count() > 0)
                                                    <a href="{{ route('admin.sales.index', ['product' => $product->id]) }}" class="dropdown-item"><i class="fa fa-eye me-1"></i> View Sales</a>
                                                @endif
                                                @if($product->productPrices->count() > 0)
                                                    <a href="{{ route('admin.product-prices.index', ['product' => $product->id]) }}" class="dropdown-item"><i class="fa fa-eye me-1"></i> View Prices</a>
                                                @else
                                                    <a href="{{ route('admin.product-prices.create', ['product' => $product->id]) }}" class="dropdown-item"><i class="fa fa-eye me-1"></i> Add Franchise Price</a>
                                                @endif
                                                @if($product->franchises->count() > 0)
                                                    <a href="{{ route('admin.product-franchises.index', ['product' => $product->id]) }}" class="dropdown-item"><i class="fa fa-eye me-1"></i> View Assigned Franchises</a>
                                                @else
                                                    <a href="{{ route('admin.product-franchises.index', ['product' => $product->id]) }}" class="dropdown-item"><i class="fa fa-eye me-1"></i> Assign to Franchises</a>
                                                @endif
                                                <a href="{{ route('admin.product.quantity', ['product' => $product->id]) }}" class="dropdown-item"><i class="fa fa-plus me-1"></i> Add Quantity</a>

                                                @if($product->warehouse_inventory && !$product->franchise_sale)
                                                <a href="{{ route('admin.products.assignments.create', $product->id) }}" class="dropdown-item"><i class="mdi mdi-plus me-1"></i> Assignment</a>
                                                @endif

                                                <a href="javascript:void(0);" onclick="confirmDelete({{ $product->id }})" class="dropdown-item"><i class="fa fa-trash-alt me-1"></i> Delete</a>
                                                <form id='delete-form{{ $product->id }}' action='{{ route('admin.products.destroy', $product->id) }}' method='POST'>
                                                    <input type='hidden' name='_token' value='{{ csrf_token() }}'>
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
@endsection

@push('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets/js/vendor/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('assets/js/vendor/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/responsive.bootstrap4.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // DataTable initialization
        $("#basic-datatable").DataTable({
            paging: false,
            pageLength: 20,
            lengthChange: false,
            searching: false,
            ordering: true,
            info: false,
            autoWidth: false,
            responsive: true,
            order: [[0, "desc"]],
            columnDefs: [{
                targets: [0],
                visible: true,
                searchable: true
            }],
            columns: [
                { orderable: true },
                { orderable: true },
                { orderable: true },
                { orderable: true },
                { orderable: true },
                { orderable: true },
                { orderable: true },
                { orderable: true },
                { orderable: true },
                { orderable: true },
                { orderable: true },
                { orderable: false },
                { orderable: false }
            ]
        });

        $(".status").change(function() {
            var url = '{{ route('admin.products.change-status', ':id') }}';
            url = url.replace(':id', this.value);
            window.location.href = url;
        });

        function confirmDelete(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("delete-form" + id).submit();
                }
            });
        }
    });
</script>
@endpush
