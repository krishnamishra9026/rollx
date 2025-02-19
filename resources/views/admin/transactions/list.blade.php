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
                                            <th>Remaining Balance</th>
                                            <th>Wallet Balance</th>
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
                                                        
                                                    {{ $balances[$ownerId] }}
                                                </td>

                                                <td>{{ $transaction->wallet->balance }}</td>

                                                <td>{{ ucfirst($transaction->type) }}</td>
                                                <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('M d, Y') }}</td>
                                                <td class="text-end" style="display: none;">
                                                    <a href="#" class="dropdown-toggle arrow-none card-drop"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a href="{{ route('admin.transactions.edit', $transaction->id) }}"
                                                            class="dropdown-item"><i class="fa fa-edit me-1"></i>
                                                            Edit
                                                        </a>
                                                        <a href="{{ route('admin.transactions.show', $transaction->id) }}"
                                                            class="dropdown-item"><i class="fa fa-eye me-1"></i>
                                                            View</a>
                                                        <a href="javascript:void(0);"
                                                            onclick="confirmDelete({{ $transaction->id }})"
                                                            class="dropdown-item"><i class="fa fa-trash-alt me-1"></i>
                                                            Delete
                                                        </a>
                                                        <form id='delete-form{{ $transaction->id }}'
                                                            action='{{ route('admin.transactions.destroy', $transaction->id) }}'
                                                            method='POST'>
                                                            <input type='hidden' name='_token'
                                                                value='{{ csrf_token() }}'>
                                                            <input type='hidden' name='_method' value='DELETE'>
                                                        </form>
                                                    </div>
                                                </td>
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
@endpush
