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





        @include('franchise.products.sales.reports.filter')

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="tab-content" id="salesTabsContent">
                            <!-- List Tab -->
                            <div class="tab-pane fade show active" id="list" role="tabpanel">
                                <div class="table-responsive">
                                    <table id="basic-datatable" class="table table-striped border dt-responsive nowrap w-100" style="font-size: 13px;">
                                        <thead class="text-dark">
                                            <tr>
                                                <th>Sale Date</th>
                                                <th>Product Name</th>
                                                <th>Qty. Ordered</th>
                                                <th>Qty. Sold</th>
                                                <th>Qty. Wastage</th>
                                                <th>Qty. Left</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $saleDateCounts = array_count_values($sales->pluck('sale_date')->toArray());
                                                $printedDates = [];
                                            @endphp

                                            @foreach ($sales as $report)
                                                <tr>
                                                    @if (!in_array($report->sale_date, $printedDates))
                                                        <td rowspan="{{ $saleDateCounts[$report->sale_date] }}">{{ $report->sale_date }}</td>
                                                        @php $printedDates[] = $report->sale_date; @endphp
                                                    @endif
                                                    <td>
                                                        <a href="{{ route('franchise.products.show', $report->product_id) }}">
                                                            {{ $report->product_name }}
                                                        </a>
                                                    </td>
                                                    <td>{{ $report->ordered_quantity ?? 0 }}</td>
                                                    <td>{{ $report->sold_quantity ?? 0 }}</td>
                                                    <td>{{ $report->wastage_quantity ?? 0 }}</td>
                                                    <td>{{ $report->ordered_quantity - ($report->sold_quantity + $report->wastage_quantity ?? $left_quantity) }}</td>
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
