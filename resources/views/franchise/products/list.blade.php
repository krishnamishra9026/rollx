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
                        Points : <span class="points">{{ auth()->user()->balance }}</span>
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
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)

                                            <tr>
                                                <td>{{ $product->id }}</td>
                                                <td><a href="{{ route('franchise.products.show', $product->id) }}"
                                                    class="text-body fw-semibold">{{ $product->name }}</a>
                                                </td>
                                               <td>
                                                    <div class="quantity-box">
                                                        <button type="button" class="decrease">-</button>
                                                        <input type="number" name="quantity" class="quantity quantity-select"  data-id="{{ $product->id }}" data-price="{{ $product->price }}" value="1" min="1" max="{{ $product->quantity }}">
                                                        <button type="button" class="increase">+</button>
                                                    </div>
                                                </td>


                                                <td>{{ $product->price }}</td>
                                                <td class="total-cost">{{ $product->price }}</td>
                                                <td>{{ \Carbon\Carbon::parse($product->created_at)->format('M d, Y') }}</td>
                                                <td class="text-end">
                                                    <a href="#" class="dropdown-toggle arrow-none card-drop"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a href="{{ route('franchise.products.edit', $product->id) }}"
                                                            class="dropdown-item"><i class="fa fa-edit me-1"></i>
                                                            Edit
                                                        </a>
                                                        <a href="{{ route('franchise.products.show', $product->id) }}"
                                                            class="dropdown-item"><i class="fa fa-eye me-1"></i>
                                                            View</a>

                                                        <a href="{{ route('franchise.orders.create', ['product_id' => $product->id]) }}"
                                                            class="dropdown-item"><i class="fa fa-eye me-1"></i>
                                                            Place Order</a>

                                                        <a href="javascript:void(0);"
                                                            onclick="confirmDelete({{ $product->id }})"
                                                            class="dropdown-item"><i class="fa fa-trash-alt me-1"></i>
                                                            Delete
                                                        </a>
                                                        
                                                    </div>
                                                </td>
                                            </tr>

                                            <form id='delete-form{{ $product->id }}'
                                                action='{{ route('franchise.products.destroy', $product->id) }}'
                                                method='POST'>
                                                <input type='hidden' name='_token'
                                                value='{{ csrf_token() }}'>
                                                <input type='hidden' name='_method' value='DELETE'>
                                            </form>
                                            
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
        
        $(document).on("blur", '.quantity-box .quantity-select', function(event) {

            let quantity = $(this).val();
            let rowId = $(this).attr("data-id");
            let price = $(this).attr("data-price");


            $.ajax({
                url: "{{ route('franchise.orders.save') }}",
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
                input.val(value);
                //input.trigger('focus');
                var price = input.attr('data-price');
                let total = value * price;
                let points = parseInt($('.points').html());
                $(this).closest("tr").find('.total-cost').html(total.toFixed(2));
                $('.points').html(points - total);


            });

            $(".decrease").click(function () {
                let input = $(this).siblings(".quantity");
                if (parseInt(input.val()) > 1) {

                    let value= parseInt(input.val()) - 1;
                    input.val(value);
                    //input.trigger('focus');

                    var price = input.attr('data-price');
                    let total = value * price;
                    $(this).closest("tr").find('.total-cost').html(total.toFixed(2));
                    let points = parseInt($('.points').html());
                    $('.points').html(points - total);

                }
            });
        });
    </script>
s
@endpush
