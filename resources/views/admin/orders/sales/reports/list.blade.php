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
        

        <div class="row">       
            <div class="col-xl-4 col-lg-4">
                <div class="card tilebox-one">
                    <div class="card-body text-center btn btn-primary">                    
                        <h5 class="mt-0 text-uppercase">Total Quantity</h5>
                        <h2 class="my-2" id="active-users-count">{{ @$total_quatity }}</h2>
                        <h5 class="mt-0 text-uppercase">Total Sale</h5>
                        <h2 class="my-2" id="active-users-count">{{ @$total_sales }}</h2>
                    </div>
                </div>          
            </div>
      
            <div class="col-xl-4 col-lg-4">
                <div class="card tilebox-one">
                    <div class="card-body text-center btn btn-secondary">                    
                        <h5 class="mt-0 text-uppercase">Total Sold Quantity</h5>
                        <h2 class="my-2" id="active-users-count">{{ @$total_sold_quatity }}</h2>
                        <h5 class="mt-0 text-uppercase">Total Sold Sale</h5>
                        <h2 class="my-2" id="active-users-count">{{ @$total_sold_sales }}</h2>
                    </div>
                </div>          
            </div>
       
            <div class="col-xl-4 col-lg-4">
                <div class="card tilebox-one">
                    <div class="card-body text-center btn btn-success">                    
                        <h5 class="mt-0 text-uppercase">Total Wastage Quantity</h5>
                        <h2 class="my-2" id="active-users-count">{{ @$total_wastage_quatity }}</h2>
                        <h5 class="mt-0 text-uppercase">Total Wastage Sale</h5>
                        <h2 class="my-2" id="active-users-count">{{ @$total_wastage_sales }}</h2>
                    </div>
                </div>          
            </div>
   
        </div>

        @include('admin.orders.sales.reports.filter')

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table id="basic-datatable" class="table table-striped border dt-responsive nowrap w-100"
                                    style="font-size: 13px;">
                                    <thead class="text-dark">
                                        <tr>
                                            <th class="fw-bold">Francise Name</th>
                                            <th class="fw-bold">Product Name</th>
                                            <th class="fw-bold">Quantity</th>
                                            <th class="fw-bold">Amount</th>
                                            <th class="fw-bold">Order Dcreated_atate</th>
                                            <th class="fw-bold">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sales as $sale)
                                            <tr>
                                                <td><a href="{{ route('admin.franchises.show', $sale->franchise->id)  }}">{{ @$sale->franchise->firstname }} {{ @$sale->franchise->lastname }}</a></td>
                                                <td><a href="{{ route('admin.products.show', $sale->product->id)  }}">{{ @$sale->product->name }}</a></td>
                                                <td>{{ $sale->quantity }}</td>
                                                <td>{{ $sale->price }}</td>
                                                <td>{{ \Carbon\Carbon::parse($sale->created_at)->format('M d, Y') }}</td>
                                                <td>
                                                    <button type="button" class="badge {{ $sale->status == 'Sold' ? 'bg-success' : 'bg-primary' }}" style="min-width: 50px;">
                                                        {{ ucfirst($sale->status) }}
                                                    </button>
                                                  
                                                </td>
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
