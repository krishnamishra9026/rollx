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
                    <div class="card-header">
                        <ul class="nav nav-tabs" id="transactionTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="list-tab" data-bs-toggle="tab" data-bs-target="#list" type="button" role="tab">Transaction List</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="chart-tab" data-bs-toggle="tab" data-bs-target="#chart" type="button" role="tab">Chart</button>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content" id="transactionTabsContent">
                            <!-- Transaction List Tab -->
                            <div class="tab-pane fade show active" id="list" role="tabpanel">
                                <div class="table-responsive">
                                    <table id="basic-datatable" class="table table-striped border dt-responsive nowrap w-100" style="font-size: 14px;">
                                        <thead class="bg-dark">
                                            <tr>
                                                <th>Id</th>
                                                <th>Franchise</th>
                                                <th>Type</th>
                                                <th>Credited</th>
                                                <th>Debited</th>
                                                <th>Balance</th>
                                                <th>Description</th>
                                                <th>Date Added</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($transactions as $transaction)
                                                <tr>
                                                    <td>{{ $transaction->id }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.franchises.show', $transaction->wallet->owner->id) }}" class="text-body fw-semibold">
                                                            {{ $transaction->wallet->owner->firstname }} {{ $transaction->wallet->owner->lastname }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="badge {{ $transaction->type == 'deposit' ? 'bg-primary' : 'bg-success' }}" style="min-width: 65px;">
                                                            {{ ucfirst($transaction->type) }}
                                                        </button>
                                                    </td>
                                                    @if($transaction->type == 'deposit')                                                    
                                                    <td>{{ str_replace("-", "", $transaction->amount) }}</td>
                                                    <td>0</td>
                                                    @else
                                                    <td>0</td>
                                                    <td>{{ str_replace("-", "", $transaction->amount) }}</td>
                                                    @endif
                                                    <td>{!! $transaction->meta['balance'] ?? $transaction->wallet->balance !!}</td>
                                                    <td>{!! $transaction->meta['description'] ?? 'Added Balance to Wallet' !!}</td>
                                                    <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('M d, Y') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $transactions->appends(request()->query())->links('pagination::bootstrap-5') }}
                                </div>
                            </div>

                            <!-- Chart Tab -->
                            <div class="tab-pane fade" id="chart" role="tabpanel">
                                <canvas id="transactionChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
@push('scripts')

 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
        document.addEventListener("DOMContentLoaded", function() {
            const transaction_list = @json($transaction_list);
            
            const labels = [...new Set(transaction_list.map(item => item.date))];
            const types = [...new Set(transaction_list.map(item => item.type))];

            const datasets = types.map(type => ({
                label: type,
                data: labels.map(label => {
                    const record = transaction_list.find(d => d.date === label && d.type === type);
                    return record ? record.count : 0;
                }),
                borderColor: getRandomColor(),
                fill: false
            }));

            const ctx = document.getElementById('transactionChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: datasets
                },
                options: {
                    responsive: true,
                    scales: {
                        x: { title: { display: true, text: 'Date' } },
                        y: { title: { display: true, text: 'Transaction Count' }, beginAtZero: true }
                    }
                }
            });

            function getRandomColor() {
                return `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 1)`;
            }
        });
    </script>


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
