@extends('layouts.franchise')
@section('title', 'Products')
@section('head')
    <link href="{{ asset('assets/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
 <style>
        .quantity-box {
            display: flex;
            align-items: center;
            height: 19px;
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
        <div class="row">
            <div class="col-12">

                <div class="page-title-box">
                    <div class="page-title-right">


                        <a href="{{ route('franchise.products.index') }}" class="btn btn-sm btn-primary float-end me-1"><i
                            class="mdi mdi-refresh"></i> Reset</a>
                            
                            <button type="submit" class="btn btn-sm btn-danger float-end me-1" form="filterForm"><i
                                class="mdi mdi-filter"></i> Filter</button>
                            
                            </div>
                            <h4 class="page-title">Products</h4>
                        </div>

                    </div>
                </div>
        @include('franchise.includes.flash-message')
        @include('franchise.products.filter')
        <div class="row py-3">
            <div class="col-12">
                <div class="card">
                    
                    <div class="card-header text-end">
                        <strong>Points:</strong> <span class="points">{{ auth()->user()->balance }}</span>
                        <button type="submit" class="btn btn-sm btn-success me-1" form="CreateOrders">Create Orders</button>
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
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Total Price</th>
                                            <th>Date Added</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>    

                                    <form method="POST" action="{{ route('franchise.orders.save') }}"  id="CreateOrders">
                                    @csrf
                                        <tbody>
                                        @foreach ($products as $key => $product)
                                            
                                            <tr>
                                                <input type="hidden" name="data[{{ $key }}][product_id]" value="{{ $product->id }}">
                                                <input type="hidden" name="data[{{ $key }}][price]" value="{{ $product->getPriceByFranchise(auth()->user()->id) }}">
                                                <td>{{ $product->id }}</td>
                                                <td><a href="{{ route('franchise.products.show', $product->id) }}"
                                                    class="text-body fw-semibold">{{ $product->name }}</a>
                                                </td>
                                               <td>
                                                    <div class="quantity-box">
                                                        <button type="button" class="decrease">-</button>
                                                        <input type="number" name="data[{{ $key }}][quantity]" class="quantity" data-price="{{ $product->getPriceByFranchise(auth()->user()->id) }}" value="0" min="0" max="{{ $product->quantity }}">
                                                        <button type="button" class="increase">+</button>
                                                    </div>
                                                </td>


                                                <td>{{ $product->getPriceByFranchise(auth()->user()->id) }}</td>
                                                <td class="total-cost">{{ $product->getPriceByFranchise(auth()->user()->id) }}</td>
                                                <td>{{ \Carbon\Carbon::parse($product->created_at)->format('M d, Y') }}</td>
                                                <td class="text-end">
                                                    <a href="#" class="dropdown-toggle arrow-none card-drop"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">

                                                        <a href="{{ route('franchise.orders.create', ['product_id' => $product->id]) }}"
                                                            class="dropdown-item"><i class="fa fa-eye me-1"></i>
                                                            Place Order</a> 
                                                 
                                                        <a href="{{ route('franchise.products.show', $product->id) }}"
                                                            class="dropdown-item"><i class="fa fa-eye me-1"></i>
                                                            View</a>

                                                        @if($product->franchise_orders(auth()->user()->id)->count() > 0)
                                                        <a href="{{ route('franchise.orders.index', ['product' => $product->id]) }}"
                                                            class="dropdown-item"><i class="fa fa-eye me-1"></i>
                                                            View Orders</a>
                                                        @endif

                                                        @if($product->franchise_sales(auth()->user()->id)->count() > 0)
                                                        <a href="{{ route('franchise.sales.index', ['product' => $product->id]) }}"
                                                            class="dropdown-item"><i class="fa fa-eye me-1"></i>
                                                            View Sales</a>
                                                        @endif
                                                        
                                                    </div>
                                                </td>

                                            </tr>                                          
                                        @endforeach
                                        </tbody>
                                    <tr>
                                        <td colspan="7">
                                        <button type="submit" class="btn btn-success text-end" form="CreateOrders" style="float: right;">Create Orders</button>
                                        </td>
                                    </tr>

                                    </form>

                                    
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
                },  {
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
    </script>

     <script>
        $(document).ready(function () {
            $(".increase").click(function () {
                let input = $(this).siblings(".quantity");
                let value= parseInt(input.val()) + 1;
                var price = input.attr('data-price');
                let total = value * price;
                let points = parseInt($('.points').html());
                $(this).closest("tr").find('.total-cost').html(total.toFixed(2));
                let rPoints = points - price;
                if (rPoints > 0) {
                $('.points').html(points - price);
                input.val(value);
            }else{
                alert('Not sufficiant points to create order!');
            }


            });

            $(".decrease").click(function () {
                let input = $(this).siblings(".quantity");
                if (parseInt(input.val()) > 0) {

                    let value= parseInt(input.val()) - 1;
                    input.val(value);

                    var price = input.attr('data-price');
                    let total = value * price;
                    $(this).closest("tr").find('.total-cost').html(total.toFixed(2));
                    let points = parseInt($('.points').html());
                    $('.points').html(points + parseInt(price));

                }
            });
        });
    </script>
@endpush
