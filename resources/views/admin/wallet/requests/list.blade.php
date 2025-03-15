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
  
                    <h4 class="page-title">Wallet Balance Requests</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        @include('admin.wallet.requests.filter')
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
                                            <th class="fw-bold">ID</th>
                                            <th class="fw-bold">Franchise</th>
                                            <th class="fw-bold">Updated By</th>
                                            <th class="fw-bold">Amount</th>
                                            <th class="fw-bold">Status</th>
                                            <th class="fw-bold">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach($requests as $request)
                                            <tr>
                                                <td>{{ $request->id }}</td>
                                                <td> <a href="{{ route('admin.franchises.show', $request->franchise->id) }}"
                                                    class="text-body fw-semibold"> {{ $request->franchise->firstname }} {{ $request->franchise->lastname }} </a></td>
                                                <td> <a href="{{ route('admin.users.show', $request->admin->id ?? 1) }}"
                                                    class="text-body fw-semibold"> {{ @$request->admin->firstname }} {{ @$request->admin->lastname }} </a></td>
                                                <td class="text-cente">{{ $request->amount }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $request->status == 'approved' ? 'success' : ($request->status == 'rejected' ? 'danger' : 'warning') }}">
                                                        {{ ucfirst($request->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if($request->status == 'pending')
                                                        <form action="{{ route('admin.wallet-requests.update', $request->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="status" value="approved">
                                                            <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                                        </form>
                                                        <form action="{{ route('admin.wallet-requests.update', $request->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="status" value="rejected">
                                                            <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                                        </form>
                                                    @else
                                                        <span class="text-muted">No actions available</span>
                                                    @endif
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $requests->appends(request()->query())->links('pagination::bootstrap-5') }}
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
