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
  
                    <h4 class="page-title">Wallet</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        @include('admin.wallet.filter')
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table id="basic-datatable" class="table table-striped border dt-responsive nowrap w-100"style="font-size: 13px;">
                                    <thead class="text-dark">
                                        <tr>
                                            <th class="fw-bold">Franchise Id</th>
                                            <th class="fw-bold">Franchise Name</th>
                                            <th class="fw-bold">Wallet Balance</th>
                                            <th class="fw-bold">Add Amount</th>
                                            <th class="fw-bold">Deduct Amount</th>
                                            <th class="fw-bold">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($franchises as $franchise)
                                            <tr>
                                                <td>{{ $franchise->id }}</td>
                                                <td>
                                                    <a href="{{ route('admin.franchises.show', $franchise->id) }}" class="text-body fw-semibold">
                                                        {{ $franchise->firstname }} {{ $franchise->lastname }}
                                                    </a>
                                                </td>
                                                <td class="text-center">{{ $franchise->wallet->balance ?? 0 }}</td>
                                                
                                                <td>
                                                    <form action="{{ route('admin.wallet.store') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="franchise_id" value="{{ $franchise->id }}">
                                                        <input type="number" style="height: 34px;" name="amount" value="0" 
                                                               class="form-control" required>
                                                </td>

                                                <td>
                                                        <input type="number" style="height: 34px;" name="deduct" value="0" 
                                                               class="form-control" required>
                                                </td>

                                                <td>
                                                        <button type="submit" class="btn btn-sm btn-primary w-100">
                                                            Update Balance
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                {{ $franchises->appends(request()->query())->links('pagination::bootstrap-5') }}
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
