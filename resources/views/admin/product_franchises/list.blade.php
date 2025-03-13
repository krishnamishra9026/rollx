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
  
                    <h4 class="page-title">Assign Product to Franchises</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
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
                                            <th class="fw-bold">Product Id</th>
                                            <th class="fw-bold">Product Name</th>
                                            <th class="fw-bold" colspan="3" width="65%">Select Franchises</th>
                                            <th class="fw-bold">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)

                                        @php
                                            $assignedFranchises = $product->franchises->pluck('franchise_id')->toArray();
                                        @endphp
                                        <tr>

                                            <form action="{{ route('admin.product-franchises.store') }}" method="POST" id="filterForm">
                                                @csrf
                                                <td>{{ $product->id }}</td>
                                                <td> <a href="{{ route('admin.products.show', $product->id) }}"
                                                    class="text-body fw-semibold"> {{ $product->name }} </a></td>
                                                    <td colspan="3" width="65%">

                                                        <select name="franchise_id[{{ $product->id }}][]" class="form-control" multiple  data-toggle=select2 >
                                                             <option disabled selected>Select</option>
                                                            @foreach ($franchises as $franchise)
                                                            <option value="{{ $franchise->id }}" 
                                                                {{ in_array($franchise->id, old('franchise_id.' . $product->id, $assignedFranchises)) ? 'selected' : '' }}>
                                                                {{ $franchise->firstname }} {{ $franchise->lastname }}
                                                            </option>
                                                            @endforeach
                                                        </select>

                                                        @error('franchise_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror

                                                    </td>
                                                    <td>
                                                        <button type="submit" class="btn btn-sm btn-success w-50">Assign</button>
                                                    </td>
                                                </form>

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
