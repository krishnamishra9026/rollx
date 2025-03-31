@extends('layouts.franchise')
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
  
                    <h4 class="page-title">Price Setting</h4>
                </div>
            </div>
        </div>
        @include('franchise.includes.flash-message')
        @include('franchise.settings.plate-filter')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <button type="submit" class="btn btn-sm btn-success me-1" style="float: right;" form="CreateOrders">Save</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table id="basic-datatable" class="table table-striped border dt-responsive nowrap w-100" style="font-size: 13px;">
                                    <thead class="text-dark">
                                        <tr>
                                            <th class="fw-bold">Product Id</th>
                                            <th class="fw-bold">Product Name</th>
                                            <th class="fw-bold">Product Price</th>
                                        </tr>
                                    </thead>
                                    <form method="POST" action="{{ route('franchise.settings.products-price.save') }}" id="CreateOrders">
                                        @csrf
                                        <tbody>
                                            @foreach ($products as $product)
                                                <tr>
                                                    <td>{{ $product['id'] }}</td>
                                                    <td>
                                                        <a href="{{ route('franchise.products.show', $product['id']) }}" class="text-body fw-semibold">
                                                            {{ $product['name'] }}
                                                        </a>
                                                    </td>

                                                    <td class="float-center">
                                                        <input type="number" name="price[]" value="{{ $product->getPriceByFranchise(auth()->user()->id) ?? $product->price }}" class="form-control" required min="1">
                                                    </td>

                                                    <td class="float-center">
                                                        <input type="number" name="sale_price[]" value="{{ $product->getPriceByFranchise(auth()->user()->id) ?? $product->sale_price }}" class="form-control" required min="1">
                                                        <input type="hidden" name="product_id[]" value="{{ $product['id'] }}">
                                                    </td>

                                                 
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tr>
                                            <td colspan="5">
                                                <button type="submit" class="btn btn-sm btn-success" style="float: right;">Save</button>
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
