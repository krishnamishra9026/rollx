@extends('layouts.chef')
@section('title', 'Dashboard')
@section('content')
<!-- Start Content-->

 <style>
        .quantity-box {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .quantity-box button {
            width: 30px;
            height: 30px;
            font-size: 18px;
            cursor: pointer;
        }
        .quantity-box input {
            width: 50px;
            text-align: center;
            font-size: 16px;
        }
    </style>
    
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">Dashboard</li>
                    </ol>
                </div>
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-4 col-lg-4">
            <div class="card tilebox-one">
                <div class="card-body text-center">
                    <h5 class="mt-0">Total Orders</h5>
                    <h2 class="my-2" id="active-users-count">{{ $total_orders }}</h2>
                    <a class="mb-0 text-dark" href="{{ route('chef.purchase-orders.index') }}">
                        <small>View Details </small>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4">
            <div class="card tilebox-one">
                <div class="card-body text-center">
                    <h5 class="mt-0">Not Started</h5>
                    <h2 class="my-2" id="active-users-count">{{ $not_started }}</h2>
                    <a class="mb-0 text-dark" href="{{ route('chef.purchase-orders.index', ['status' => 'PO Generated']) }}">
                        <small>View Details </small>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4">
            <div class="card tilebox-one">
                <div class="card-body text-center">
                    <h5 class="mt-0">In Progress</h5>
                    <h2 class="my-2" id="active-users-count">{{ $in_progress }}</h2>
                    <a class="mb-0 text-dark" href="{{ route('chef.purchase-orders.index', ['status' => 'In Progress']) }}">
                        <small>View Details </small>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4">
            <div class="card tilebox-one">
                <div class="card-body text-center">
                    <h5 class="mt-0">Completed</h5>
                    <h2 class="my-2" id="active-users-count">{{ $completed }}</h2>
                    <a class="mb-0 text-dark" href="{{ route('chef.purchase-orders.index', ['status' => 'Completed']) }}">
                        <small>View Details </small>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4">
            <div class="card tilebox-one">
                <div class="card-body text-center">
                    <h5 class="mt-0">Delivered</h5>
                    <h2 class="my-2" id="active-users-count">{{ $delivered }}</h2>
                    <a class="mb-0 text-dark" href="{{ route('chef.purchase-orders.index', ['status' => 'Delivered']) }}">
                        <small>View Details </small>
                    </a>
                </div>
            </div>
        </div>

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
                                            <th class="fw-bold">Product Name</th>
                                            <th class="fw-bold">Quantity</th>
                                            <th class="fw-bold">Mark Sold</th>
                                            <th class="fw-bold">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $order->product_name }}</td>
                                                <td>{{ $order->quantity }}</td>
                                                <td>
                                                    @if($order->product_name == 'Momo')

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
                                                    @else
                                                    <div class="quantity-box">
                                                        <button type="button" class="decrease">-</button>
                                                        <input type="number" name="quantity" class="quantity quantity-select" data-id="{{ $order->id }}" data-price="{{ $order->product->price }}" value="1" min="1" max="{{ $order->quantity }}">
                                                        <button type="button" class="increase">+</button>
                                                    </div>
                                                    @endif
                                                </td>                                            
                                                <td>
                                                    <a href="#" class="border bg-white dropdown-toggle arrow-none card-drop"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">

                                                        <a href="{{ route('chef.orders.show', $order->id) }}"
                                                            class="dropdown-item"><i class="fa fa-eye me-1"></i>
                                                            View</a>

                                                        @if($order->status == 'delivered' || $order->status == 'completed')

                                                        <a href="{{ route('chef.order.sales.index', ['order_id' => $order->id]) }}"
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

</div> <!-- container -->
@endsection
@push('scripts')

<script type="text/javascript">
    $(document).on("blur", '.quantity-select', function(event) {

        let quantity = $(this).val();
        let rowId = $(this).attr("data-id");
        let price = $(this).attr("data-price");


        $.ajax({
            url: "{{ route('chef.order.sales.save') }}",
            method: "POST",
            data: {
                id: rowId,
                quantity: quantity,
                price: price,
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                location.reload();
            },
            error: function () {
                console.error("Error updating quantity for row");
            },
        });
    });

        $(document).ready(function () {
            $(".increase").click(function () {
                let input = $(this).siblings(".quantity");
                let max = $(this).siblings(".quantity").attr("max");
                let value= parseInt(input.val()) + 1;
                if (value <= max) {
                    input.val(value);  
                    $(".quantity").trigger('focus');
                }     
            });

            $(".decrease").click(function () {
                let input = $(this).siblings(".quantity");
                if (parseInt(input.val()) > 1) {
                    let value= parseInt(input.val()) - 1;
                    input.val(value);      
                    $(".quantity").trigger('focus')        
                }
            });
        });

    </script>
    @endpush
