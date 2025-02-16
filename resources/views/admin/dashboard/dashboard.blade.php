@extends('layouts.admin')
@section('title', 'Dashboard')
@section('head')
    <link href="{{ asset('assets/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">                        
                        <li class="breadcrumb-item">Dashboard</li>
                    </ol>
                </div>
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>
    <div class="row">         

        <div class="col-xl-3 col-lg-4">
            <div class="card tilebox-one">
                <div class="card-body text-center">                    
                    <h5 class="mt-0">Franchises</h5>
                    <h2 class="my-2" id="active-users-count">{{ $franchises }}</h2>
                    <a class="mb-0 text-dark" href="{{ route('admin.franchises.index') }}">    
                        <small>View Details </small>                   
                    </a>
                </div>
            </div>          
        </div>
        <div class="col-xl-3 col-lg-4">
            <div class="card tilebox-one">
                <div class="card-body text-center">                    
                    <h5 class="mt-0">Orders</h5>
                    <h2 class="my-2" id="active-users-count">{{ $orders }}</h2>
                    <a class="mb-0 text-dark" href="{{ route('admin.orders.index') }}">    
                        <small>View Details </small>                   
                    </a>
                </div>
            </div>          
        </div>

        <div class="col-xl-3 col-lg-4">
            <div class="card tilebox-one">
                <div class="card-body text-center">                    
                    <h5 class="mt-0">Users</h5>
                    <h2 class="my-2" id="active-users-count">{{ $users }}</h2>
                    <a class="mb-0 text-dark" href="{{ route('admin.admins.index') }}">    
                        <small>View Details </small>                   
                    </a>
                </div>
            </div>          
        </div>

    </div>
    <!-- end page title -->

</div> <!-- container -->
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