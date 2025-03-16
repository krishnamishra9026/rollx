@extends('layouts.franchise')
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
        @include('franchise.includes.flash-message')


        <div class="row">       
            <div class="col-xl-3 col-lg-4">
                <div class="card tilebox-one">
                    <div class="card-body text-center btn btn-primary">                    
                        <h5 class="mt-0 text-uppercase">Total Qty Orderd</h5>
                        <h2 class="my-2" id="active-users-count">{{ $totals->total_quantity_ordered ?? 0 }}</h2>
                        <h5 class="mt-0 text-uppercase">Total Amount Ordered</h5>
                        <h2 class="my-2" id="active-users-count">{{ $totals->total_amount_ordered ?? 0 }}</h2>
                    </div>
                </div>          
            </div>
      
            <div class="col-xl-3 col-lg-4">
                <div class="card tilebox-one">
                    <div class="card-body text-center btn btn-secondary">                    
                        <h5 class="mt-0 text-uppercase">Total Qty Sold </h5>
                        <h2 class="my-2" id="active-users-count">{{ $totals->total_quantity_sold ?? 0 }}</h2>
                        <h5 class="mt-0 text-uppercase">Total Amount Sold</h5>
                        <h2 class="my-2" id="active-users-count">{{ $totals->total_amount_sold ?? 0 }}</h2>
                    </div>
                </div>          
            </div>
       
            <div class="col-xl-3 col-lg-4">
                <div class="card tilebox-one">
                    <div class="card-body text-center btn btn-success">                    
                        <h5 class="mt-0 text-uppercase">Total Qty Wastage</h5>
                        <h2 class="my-2" id="active-users-count">{{ $totals->total_quantity_wastage ?? 0 }}</h2>
                        <h5 class="mt-0 text-uppercase">Total Amount Wastage</h5>
                        <h2 class="my-2" id="active-users-count">{{ $totals->total_amount_wastage ?? 0 }}</h2>
                    </div>
                </div>          
            </div>


            <div class="col-xl-3 col-lg-4">
                <div class="card tilebox-one">
                    <div class="card-body text-center btn btn-danger">                    
                        <h5 class="mt-0 text-uppercase">Total Qty Left</h5>
                        <h2 class="my-2" id="active-users-count">{{ $totals->total_quantity_ordered - $totals->total_quantity }}</h2>
                        <h5 class="mt-0 text-uppercase">Total Amount Left</h5>
                        <h2 class="my-2" id="active-users-count">{{ $totals->total_amount_ordered - $totals->total_amount }}</h2>
                    </div>
                </div>          
            </div>
   
        </div>


        @include('franchise.products.reports.filter')

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <!-- Tabs Navigation -->
                        <ul class="nav nav-tabs" id="salesTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="list-tab" data-bs-toggle="tab" href="#list" role="tab">Sales List</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="chart-tab" data-bs-toggle="tab" href="#chart" role="tab">Sales Chart</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content" id="salesTabsContent">
                            <!-- List Tab -->
                            <div class="tab-pane fade show active" id="list" role="tabpanel">
                                <div class="table-responsive">
                                    <table id="basic-datatable" class="table table-striped border dt-responsive nowrap w-100" style="font-size: 13px;">
                                        <thead class="text-dark">
                                            <tr>
                                                <th>Prod Id</th>
                                                <th>Product Name</th>
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
                                                <td><a href="{{ route('franchise.products.show', $report->id) }}">{{ $report->name }}</a></td>
                                                <td><a href="{{ route('franchise.orders.index', ['product' => $report->id]) }}">{{ $report->total_orders }}</a></td>
                                                <td><a href="{{ route('franchise.sales.index', ['product' => $report->id]) }}">{{ $report->total_sales }}</a></td>
                                                <td>{{ $report->total_quantity_ordered ?? 0 }}</td>
                                                <td>{{ $report->total_quantity_sold ?? 0 }}</td>
                                                <td>{{ $report->total_wastage_quantity ?? 0 }}</td>
                                                <td>{{ $report->total_quantity_ordered - ($report->total_quantity_sold + $report->total_wastage_quantity ?? 0) }}</td>
                                                <td>₹{{ number_format($report->total_revenue, 2) }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $sales->appends(request()->query())->links('pagination::bootstrap-5') }}
                                </div>
                            </div>

                            <!-- Chart Tab -->
                            <div class="tab-pane fade" id="chart" role="tabpanel">
                                <canvas id="salesChart"></canvas>
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
        const ctx = document.getElementById('salesChart').getContext('2d');

        const chartData = {
            labels: @json($product_list->pluck('name')),  // X-axis: Product Names
            datasets: [
                {
                    label: 'Total Quantity Ordered',
                    data: @json($product_list->pluck('total_quantity_ordered')),
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Total Quantity Sold',
                    data: @json($product_list->pluck('total_quantity')),
                    backgroundColor: 'rgba(54, 20, 343, 0.5)',
                    borderColor: 'rgba(54, 20, 343, 1)',
                    borderWidth: 1
                }
            ]
        };

        new Chart(ctx, {
            type: 'bar', // Change to 'line' if preferred
            data: chartData,
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' }
                },
                scales: {
                    y: { beginAtZero: true }
                }
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
