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
               
                    <h4 class="page-title">Franchises Product waise Sale Report</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')

        @include('admin.franchises.products.reports.filter')

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
                                                    <th>Franchise Name</th>
                                                    <th>Product Name</th>
                                                    <th>Qty. Ordered</th>
                                                    <th>Qty. Sold</th>
                                                    <th>Qty. Wastage</th>
                                                    <th>Qty. Left</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($sales as $report)
                                                    @php
                                                        $productCount = $report->products->count();
                                                    @endphp
                                                    @if ($productCount > 0)
                                                        @foreach ($report->products as $index => $product)
                                                            <tr>
                                                                @if ($index === 0)
                                                                    <td rowspan="{{ $productCount }}">
                                                                        <a href="{{ route('admin.franchises.show', $report->id) }}">
                                                                            {{ $report->firstname }} {{ $report->lastname }}
                                                                        </a>
                                                                    </td>
                                                                @endif
                                                                <td><a href="{{ route('admin.products.show', $product->id) }}">{{ $product->name }}</a></td>
                                                    
                                                                <td>{{ $product->ordered_quantity ?? 0 }}</td>
                                                                <td>{{ $product->sold_quantity ?? 0 }}</td>
                                                                <td>{{ $product->wastage_quantity ?? 0 }}</td>
                                                                <td>{{ ($product->ordered_quantity ?? 0) - (($product->sold_quantity ?? 0) + ($product->wastage_quantity ?? 0)) }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td><a href="{{ route('admin.franchises.show', $report->id) }}">{{ $report->firstname }} {{ $report->lastname }}</a></td>
                                                            <td colspan="5" class="text-center">No Products Assigned</td>
                                                        </tr>
                                                    @endif
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
                    orderable: !1,
                }, {
                    orderable: !1,
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

    </script>
@endpush
