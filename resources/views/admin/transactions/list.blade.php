@extends('layouts.admin')
@section('title', 'Products')
@section('head')
    <link href="{{ asset('assets/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Transactions</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        @include('admin.transactions.filter')
        <div class="row py-3">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table id="basic-datatable" class="table table-striped border dt-responsive nowrap w-100"
                                    style="font-size: 14px;">
                                    <thead class="bg-dark">
                                        <tr>
                                            <th>Id</th>
                                            <th>Franchise Name</th>
                                            <th>Amount</th>
                                            <th>Description</th>
                                            <th>Wallet Balance</th>
                                            <th>Transaction Type</th>
                                            <th>Date Added</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $balance = 0; @endphp
                                        @foreach ($transactions as $transaction)
                                            
                                             @php
                                                $ownerId = $transaction->wallet->owner->id;
                                                
                                                if (!isset($balances[$ownerId])) {
                                                    $balances[$ownerId] = 0;
                                                }

                                                if ($transaction->type === 'deposit') {
                                                    $balances[$ownerId] += $transaction->amount;
                                                } elseif ($transaction->type === 'withdraw') {
                                                    $balances[$ownerId] += $transaction->amount;
                                                }
                                            @endphp

                                            <tr>
                                                <td>{{ $transaction->id }}</td>
                                                <td><a href="{{ route('admin.franchises.show', $transaction->wallet->owner->id) }}"
                                                    class="text-body fw-semibold">{{ $transaction->wallet->owner->firstname }} {{ $transaction->wallet->owner->lastname }}</a>
                                                </td>
                                                <td>
                                                    {{ $transaction->amount }}
                                                </td>

                                                <td>
                                                    {!! $transaction->meta['description'] ?? 'Added Balance to Wallet' !!}
                                                </td>

                        

                                                <td>{{ $transaction->wallet->balance }}</td>

                                                <td>{{ ucfirst($transaction->type) }}</td>
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
@endpush
