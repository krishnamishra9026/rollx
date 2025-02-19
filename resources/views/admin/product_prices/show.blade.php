@extends('layouts.admin')
@section('title', 'Product Details')
@section('head')
    <link href="{{ asset('assets/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark me-1 mb-2"><i
                                class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                    </div>
                    <h4 class="page-title">{{ $product->product }}</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="min-height: 303px;">
                    <div class="card-header bg-dark text-white">
                        <h5 class="float-start">Product ID # {{ $product->id }}</h5>
                        <a href="{{ route('admin.product-prices.edit', $product->id) }}" class="text-white float-end mt-1"><i
                                class="fa fa-edit me-1"></i> Edit</a>
                    </div>
                    <div class="card-body">
                        <table style="width:100%; margin-bottom:20px">
                            <tbody>
                                <tr>
                                    
                                    <td style="width:33%" class=""><span class="fw-bold">Product Name
                                        </span><br>
                                        {{ ucfirst($product->name) }}
                                    </td>

                                     <td style="width:33%" class="text-center"><span class="fw-bold">Product Description
                                        </span><br>
                                        {{ ucfirst($product->description) }}
                                    </td>

                                    <td style="width:33%" class="text-end"><span class="fw-bold">Product Status
                                        </span><br>
                                        @if ($product->status)
                                            <span class="badge border badge-success-lighten">Enabled</span>
                                        @else
                                            <span class="badge border badge-danger-lighten">Disabled</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width:100%; margin-bottom:20px">
                            <tbody>
                                <tr>
                                    <td style="width: 33%" class="text-start"><span class="fw-bold">Model Number
                                        </span><br>
                                        {{ $product->model_number }}
                                    </td>
                                    <td style="width:33%" class="text-center"><span class="fw-bold">Serial Number
                                        </span><br>
                                        {{ $product->serial_number }}
                                    </td>
                                    <td style="width: 33%" class="text-end"><span class="fw-bold">Quantity
                                        </span><br>
                                        {{ $product->quantity }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width:100%; margin-bottom:20px">
                            <tbody>
                                <tr>

                                    <td style="width: 33%" class="text-start"><span class="fw-bold">Created At
                                    </span><br>
                                    {{ \Carbon\Carbon::parse($product->created_at)->format('M d, Y h:i A') }}
                                </td>
                                <td style="width: 33%" class="text-center"><span class="fw-bold">Updated At
                                </span><br>
                                {{ \Carbon\Carbon::parse($product->updated_at)->format('M d, Y h:i A') }}
                            </td>

                            <td style="width: 33%" class="text-end"><span class="fw-bold">Price
                                        </span><br>
                                        {{ $product->price }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width:100%; margin-bottom:20px">
                            <tbody>
                                <tr>
                                    <td style="width: 100%" class="text-start"><span class="fw-bold">Product Description
                                        </span><br>
                                        {{ $product->reference ?? "Not Found" }}
                                    </td>

                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        Images
                    </div>
                    <div class="card-body text-center">
                        <div class="row">
                            @forelse ($product->images as $image)
                                <div class="col-sm-4">
                                    <img src="{{ asset('storage/uploads/products/' . $product->id . '/images' . '/' . $image->name) }}"
                                        width="150px" height="100px" class="me-2 mt-2 mb-2 border">
                                    <a href="{{ asset('storage/uploads/products/' . $product->id . '/images' . '/' . $image->name) }}"
                                        download="">Download</a>
                                </div>
                            @empty
                                <div class="col-sm-12">
                                    <p class="my-5">No Images Found</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>


    
        </div>
    </div>
@endsection
@push("scripts")
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/vendor/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/responsive.bootstrap4.min.js') }}"></script>
<script>
    $(function() {
        $("#basic-datatable").DataTable({
            paging: !0,
            pageLength: 20,
            lengthChange: !1,
            searching: !1,
            ordering: !1,
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
@endpush
