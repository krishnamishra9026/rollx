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
               
                    <h4 class="page-title">Products Franchise waise Sale Report</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')

        @include('admin.products.franchise.sales.reports.filter')

        <div class="row">
            <div class="col-12">
                <div class="card">
       

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
                                                    <th>Date</th>
                                                    <th>Franchise Name</th>
                                                    <th>Product Name</th>
                                                    <th>Qty. Ordered</th>
                                                    <th>Qty. Sold</th>
                                                    <th>Qty. Wastage</th>
                                                    <th>Qty. Left</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $prevDate = null;
                                         
                                                @endphp

                                                @foreach ($sales as $report)
                                                    <tr>
                                                        <td>
                                                            @if ($prevDate !== $report['sale_date'])
                                                                {{ $report['sale_date'] }}
                                                                @php $prevDate = $report['sale_date']; @endphp
                                                            @endif
                                                        </td>

                                                        <td>
                                                                <a href="{{ route('admin.franchises.show', $report['franchise_id']) }}">
                                                                    {{ $report['franchise_name'] }}
                                                                </a>
                                                        </td>

                                                        <td>
                                                                <a href="{{ route('admin.franchises.show', $report['product_id']) }}">
                                                                    {{ $report['product_name'] }}
                                                                </a>
                                                        </td>

                                                        <td>{{ $report['total_ordered'] ?? 0 }}</td>
                                                        <td>{{ $report['total_sold'] ?? 0 }}</td>
                                                        <td>{{ $report['total_wastage'] ?? 0 }}</td>
                                                        <td>{{ $report['total_left_to_sell'] ?? ($report['total_ordered'] ?? 0) - (($report['total_sold'] ?? 0) + ($report['total_wastage'] ?? 0)) }}</td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
