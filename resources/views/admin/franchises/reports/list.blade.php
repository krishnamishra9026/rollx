@extends('layouts.admin')
@section('title', 'Sales')
@section('head')
    <link href="{{ asset('assets/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container-fluid Purchase_Orders">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
               
                    <h4 class="page-title">Sale Report</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')

        @include('admin.franchises.reports.filter')

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs" id="salesTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="list-tab" data-bs-toggle="tab" data-bs-target="#listPanel" type="button" role="tab">Sales List</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link " id="chart-tab" data-bs-toggle="tab" data-bs-target="#chartPanel" type="button" role="tab">Sales Chart</button>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content" id="salesTabsContent">
                            <!-- Chart Tab -->
                            <div class="tab-pane fade " id="chartPanel" role="tabpanel">
                                <canvas id="franchiseSalesChart"></canvas>
                            </div>

                            <!-- Table Tab -->
                            <div class="tab-pane show active" id="listPanel" role="tabpanel">
                                <div class="table-responsive">
                                    <table id="basic-datatable" class="table table-striped border dt-responsive nowrap w-100" style="font-size: 13px;">
                                        <thead class="text-dark">
                                            <tr>
                                                <th>Franchise Id</th>
                                                <th>Franchise Name</th>
                                                <th>Orders</th>
                                                <th>Sales</th>
                                                <th>Qty. Ordered</th>
                                                <th>Qty. Sold</th>
                                                <th>Qty. Wastage</th>
                                                <th>Qty. Left</th>
                                                <th>Revenue</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sales as $report)
                                            <tr>
                                                <td>{{ $report->id }}</td>
                                                <td><a href="{{ route('admin.franchises.show', $report->id) }}">{{ $report->firstname }} {{ $report->lastname }}</a></td>
                                                <td><a href="{{ route('admin.orders.index', ['product' => $report->id]) }}">{{ $report->total_orders }}</a></td>
                                                <td><a href="{{ route('admin.sales.index', ['product' => $report->id]) }}">{{ $report->total_sales }}</a></td>
                                                <td>{{ $report->total_quantity_ordered ?? 0 }}</td>
                                                <td>{{ $report->total_quantity_sold ?? 0 }}</td>
                                                <td>{{ $report->total_wastage_quantity ?? 0 }}</td>
                                                <td>{{ $report->total_quantity_ordered - ($report->total_quantity_sold + $report->total_wastage_quantity ?? 0) }}</td>
                                                <td>{{ number_format($report->total_revenue, 2) }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $sales->appends(request()->query())->links('pagination::bootstrap-5') }}
                                </div>
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
        document.addEventListener("DOMContentLoaded", function () {
            const ctx = document.getElementById('franchiseSalesChart').getContext('2d');
            
            const chartData = @json($chartData);

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartData.labels, // Franchise Names
                    datasets: [
                        {
                            label: 'Total Sales',
                            data: chartData.sales,
                            backgroundColor: 'rgba(54, 162, 235, 0.6)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Total Revenue',
                            data: chartData.revenue,
                            backgroundColor: 'rgba(75, 192, 192, 0.6)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Total Wastage',
                            data: chartData.wastage,
                            backgroundColor: 'rgba(255, 99, 132, 0.6)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
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
