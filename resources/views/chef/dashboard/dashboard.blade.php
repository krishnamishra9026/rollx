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

    @include('chef.includes.flash-message')

     <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <h4 class="page-title">Click on bellow buttons to record Sold Items</h4>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            @if ($orders && count($orders))
                                @foreach ($orders as $order)
                                    @if (($order->product->selling_type ?? '') != 'quantity')

                                        @if($order->stock >= ($order->ProductPlateSetting->full_plate_quantity ?? 1) )
                                        <div class="col-sm-3 mt-2 d-flex">
                                            <a href="{{ route('chef.sales.save', ['order_id' => $order->id, 'quantity' => ($order->ProductPlateSetting->full_plate_quantity ?? 1), 'status' => 'Sold']) }}" 
                                               class="btn btn-{{ @$order->product->sold_color ?? 'success' }} rounded-pill w-100 d-flex flex-column align-items-center justify-content-center text-center">
                                                <span>Full Plate ({{ ($order->ProductPlateSetting->full_plate_quantity ?? 1) }} Quantity)</span>  
                                                <span class="d-block fw-bold">{{ @$order->product->name }} #{{ $order->id }}</span>
                                            </a>
                                        </div>
                                        @endif

                                        @if($order->stock >= ($order->ProductPlateSetting->half_plate_quantity ?? 1) )
                                        <div class="col-sm-3 mt-2 d-flex">
                                            <a href="{{ route('chef.sales.save', ['order_id' => $order->id, 'quantity' => $order->ProductPlateSetting->half_plate_quantity ?? 1, 'status' => 'Sold']) }}" 
                                               class="btn btn-{{ @$order->product->sold_color ?? 'danger' }} rounded-pill w-100 d-flex flex-column align-items-center justify-content-center text-center">
                                                <span>Half Plate ({{ ($order->ProductPlateSetting->half_plate_quantity ?? 1) }} Quantity)</span>  
                                                <span class="d-block fw-bold">{{ @$order->product->name }} #{{ $order->id }}</span>
                                            </a>
                                        </div>
                                        @endif

                                    @else

                                        @if($order->stock >= 1) )
                                        <div class="col-sm-3 mt-2 d-flex">
                                            <a href="{{ route('chef.sales.save', ['order_id' => $order->id, 'quantity' => 1, 'status' => 'Sold']) }}" 
                                               class="btn btn-{{ @$order->product->sold_color ?? 'success' }} rounded-pill w-100 d-flex flex-column align-items-center justify-content-center text-center">
                                                <span>Full Plate (1 Quantity)</span>  
                                                <span class="d-block fw-bold">{{ @$order->product->name }} #{{ $order->id }}</span>
                                            </a>
                                        </div>
                                        @endif

                                    @endif
                                @endforeach
                            @else
                                <p>No item available to sell...</p>
                            @endif
                        </div>

                    </div>
                </div>

            </div>
        </div>



     <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <h4 class="page-title">Click on bellow buttons to record Wastage Items</h4>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            @if ($orders && count($orders))
                                @foreach ($orders as $order)
                                    <p style="display: none;" class="mt-2">
                                        Order <a href="{{ route('chef.orders.show', $order->id) }}">#{{ $order->id }}</a>
                                    </p>

                                    @if (($order->product->selling_type ?? '') != 'quantity')

                                        @if($order->stock >= ($order->ProductPlateSetting->full_plate_quantity ?? 1) )
                                        <div class="col-sm-3 mt-2 d-flex">
                                            <a href="{{ route('chef.sales.save', ['order_id' => $order->id, 'quantity' => ($order->ProductPlateSetting->full_plate_quantity ?? 1), 'status' => 'Wastage']) }}" 
                                               class="btn btn-{{ @$order->product->sold_color ?? 'success' }} rounded-pill w-100 d-flex flex-column align-items-center justify-content-center text-center">
                                                <span>Full Plate ({{ ($order->ProductPlateSetting->full_plate_quantity ?? 1) }} Quantity)</span>  
                                                <span class="d-block fw-bold">{{ @$order->product->name }} #{{ $order->id }}</span>
                                            </a>
                                        </div>
                                        @endif

                                        @if($order->stock >= ($order->ProductPlateSetting->half_plate_quantity ?? 1) )
                                        <div class="col-sm-3 mt-2 d-flex">
                                            <a href="{{ route('chef.sales.save', ['order_id' => $order->id, 'quantity' => ($order->ProductPlateSetting->half_plate_quantity ?? 1), 'status' => 'Wastage']) }}" 
                                               class="btn btn-{{ @$order->product->sold_color ?? 'danger' }} rounded-pill w-100 d-flex flex-column align-items-center justify-content-center text-center">
                                                <span>Half Plate ({{ ($order->ProductPlateSetting->half_plate_quantity ?? 1) }} Quantity)</span>  
                                                <span class="d-block fw-bold">{{ @$order->product->name }} #{{ $order->id }}</span>
                                            </a>
                                        </div>
                                        @endif
                                        
                                    @else

                                        @if($order->stock >= 1) )
                                        <div class="col-sm-3 mt-2 d-flex">
                                            <a href="{{ route('chef.sales.save', ['order_id' => $order->id, 'quantity' => 1, 'status' => 'Wastage']) }}" 
                                               class="btn btn-{{ @$order->product->sold_color ?? 'success' }} rounded-pill w-100 d-flex flex-column align-items-center justify-content-center text-center">
                                                <span>Full Plate (1 Quantity)</span>  
                                                <span class="d-block fw-bold">{{ @$order->product->name }} #{{ $order->id }}</span>
                                            </a>
                                        </div>
                                        @endif

                                    @endif
                                @endforeach
                            @else
                                <p>No item available to sell...</p>
                            @endif
                        </div>

                    </div>
                </div>

            </div>
        </div>

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
