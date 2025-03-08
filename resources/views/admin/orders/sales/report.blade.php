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
                <div class="page-title-right">
                    <a href="{{ route('admin.order.sales.index') }}" class="btn btn-sm btn-primary float-end me-1">
                        <i class="mdi mdi-refresh"></i> Reset
                    </a>
                    <button type="submit" class="btn btn-sm btn-danger float-end me-1" form="filterForm">
                        <i class="mdi mdi-filter"></i> Filter
                    </button>
                </div>
                <h4 class="page-title">Sales</h4>
            </div>
        </div>
    </div>

    @include('admin.includes.flash-message')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Tabs -->
                    <ul class="nav nav-tabs" id="salesTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="chart-tab" data-bs-toggle="tab" href="#chart" role="tab">Sales Chart</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="list-tab" data-bs-toggle="tab" href="#list" role="tab">Sales List</a>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content mt-3" id="salesTabsContent">
                        <!-- Sales Chart Tab -->
                        <div class="tab-pane fade show active" id="chart" role="tabpanel">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <canvas id="salesChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Sales List Tab -->
                        <div class="tab-pane fade" id="list" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12 table-responsive">
                                    <table id="basic-datatable" class="table table-striped border dt-responsive nowrap w-100" style="font-size: 13px;">
                                        <thead class="text-dark">
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Franchise Name</th>
                                                <th>Product Name</th>
                                                <th>Total Quantity</th>
                                                <th>Sale Ids</th>
                                                <th>Total Sales</th>
                                                <th>Created At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($salesData as $sale)
                                                <tr>
                                                    <td><a href="{{ route('admin.orders.show', $sale->order->id)  }}">{{ $sale->order_id }}</a></td>
                                                    <td>
                                                        <a href="{{ route('admin.franchises.show', $sale->order->franchise->id)  }}">
                                                            {{ $sale->order->franchise->firstname.' '.$sale->order->franchise->lastname ?? 'N/A' }}
                                                        </a>
                                                    </td>

                                                    <td>
                                                        <a href="{{ route('admin.products.show', $sale->order->product->id)  }}">
                                                            {{ $sale->order->product->name ?? 'N/A' }}
                                                        </a>
                                                    </td>

                                                    <td>{{ $sale->total_quantity }}</td>
                                                    <td><a href="{{ route('admin.sales.index', ['order' => $sale->order->id])  }}">{{ $sale->sales_ids }}</a></td>
                                                    <td>Rs.{{ number_format($sale->total_sales, 2) }}</td>
                                                    <td>{{ $sale->order->created_at->format('d M Y H:i A') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $salesData->appends(request()->query())->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div> <!-- End Tab Content -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')



<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('salesChart').getContext('2d');
    var salesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($chartData['labels']),
            datasets: [{
                label: 'Total Sales (Rs.)',
                data: @json($chartData['data']),
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
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
