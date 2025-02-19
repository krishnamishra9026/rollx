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
                        <h4 class="page-title">Click on bellow buttons to record sale</h4>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            @foreach ($orders as $order)
                                @if ((strpos($order->product->name, "Momo") !== false) || (strpos($order->product->name, ",momo") !== false))
                                    <div class="col-sm-3 mt-2 d-flex">
                                        <a href="{{ route('chef.sales.save', ['order_id' => $order->id, 'quantity' => $quantity_per_plate]) }}" 
                                           class="btn btn-{{ $order->product->sold_color ?? 'success' }} w-100 d-flex align-items-center justify-content-center">
                                            Full Plate {{ $order->product->name }}
                                        </a>
                                    </div>

                                    <div class="col-sm-3 mt-2 d-flex">
                                        <a href="{{ route('chef.sales.save', ['order_id' => $order->id, 'quantity' => $quantity_per_plate/2]) }}" 
                                           class="btn btn-{{ $order->product->sold_color ?? 'danger' }} w-100 d-flex align-items-center justify-content-center">
                                            Half Plate {{ $order->product->name }}
                                        </a>
                                    </div>
                                @else
                                    <div class="col-sm-3 mt-2 d-flex">
                                        <a href="{{ route('chef.sales.save', ['order_id' => $order->id, 'quantity' => 1]) }}" 
                                           class="btn btn-{{ $order->product->sold_color ?? 'success' }} w-100 d-flex align-items-center justify-content-center">
                                            Full Plate {{ $order->product->name }}
                                        </a>
                                    </div>
                                @endif
                            @endforeach

                     
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
