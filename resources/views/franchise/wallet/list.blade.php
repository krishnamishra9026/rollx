@extends('layouts.franchise')
@section('title', 'Purchase Orders')
@section('head')
    <link href="{{ asset('assets/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <style type="text/css">
        .no-wrap {
            white-space: nowrap;
        }
    </style>
    <div class="container-fluid Purchase_Orders">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
  
                    <h4 class="page-title">Wallet</h4>
                </div>
            </div>
        </div>
        @include('franchise.includes.flash-message')

        @if(auth()->user()->balance < 1 )
            <div class="alert alert-warning alert-dismissiblew fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong><i class="dripicons-warning me-2"></i> </strong> Your wallet balance is low, Please contact Admin!
            </div>
        @endif

        @include('franchise.wallet.filter')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    
                    <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                        <p class="mb-0"><strong>{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</strong> Wallet Balance is {{ auth()->user()->balance }}</p>

                        <form action="{{ route('franchise.wallet-requests.store') }}" method="POST" class="d-flex gap-2">
                            @csrf
                            <input type="number" name="amount" class="form-control form-control-sm" required min="1" placeholder="Enter amount">
                            <button type="submit" class="btn btn-primary btn-sm no-wrap">Request Amount</button>
                        </form>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table id="basic-datatable" class="table table-striped border dt-responsive nowrap w-100"
                                    style="font-size: 13px;">
                                    <thead class="text-dark">
                                        <tr>
                                            <th class="fw-bold">Id</th>
                                            <th class="fw-bold">Type</th>
                                            <th>Credited</th>
                                            <th>Debited</th>
                                            <th class="fw-bold">Balance</th>
                                            <th class="fw-bold">Description</th>
                                            <th class="fw-bold">Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactions as $transaction)
                                            <tr>
                                                <td>{{ $transaction->id }}</td>

                                                <td>
                                                    <button type="button" class="badge {{ $transaction->type == 'deposit' ? 'bg-primary' : 'bg-success' }}" style="min-width: 65px;">
                                                        {{ucfirst($transaction->type)}}
                                                    </button>
                                                </td>

                                                @if($transaction->type == 'deposit')
                                                    
                                                <td>{{ str_replace("-", "", $transaction->amount) }}</td>
                                                <td>0</td>
                                                @else
                                                <td>0</td>
                                                <td>{{ str_replace("-", "", $transaction->amount) }}</td>
                                                @endif

                                                <td>{!!  $transaction->meta['balance'] ?? $transaction->wallet->balance !!}</td>
                                                <td>{!!  str_replace('/admin/', '/franchise/', $transaction->meta['description'] ?? 'Added balance in wallet') ?? 'Added balance in wallet' !!}</td>
                                                <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('M d, Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $transactions->appends(request()->query())->links('pagination::bootstrap-5') }}
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
                    orderable: !0
                }, {
                    orderable: !0
                }, {
                    orderable: !0
                }, {
                    orderable: !0
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
