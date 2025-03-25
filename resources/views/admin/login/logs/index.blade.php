@extends('layouts.admin')
@section('title', 'Roles')
@section('head')
    <link href="{{ asset('assets/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
       
                    
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <div class="row">
            @if (count($logs) > 0)
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 table-responsive">
                                        <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>Role ID</th>
                                                    <th>Login Type</th>
                                                    <th>Login User Name</th>
                                                    <th >Login Date Time  </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($logs as $role)
                                                    <tr>
                                                        <td>{{ $role->id }}</td>
                                                        <td>{{ ucfirst($role->user_type) }}</td>
                                                        @if($role->user_type == 'admin')
                                                        <td><a href="{{ route('admin.users.show', $role->admin_id) }}">{{ $role->admin?->firstname }} {{ $role->admin?->lastname }} </a></td>
                                                        @elseif($role->user_type == 'chef')
                                                        <td><a href="{{ route('admin.chefs.show', $role->chef_id) }}">{{ $role->chef?->firstname }} {{ $role->chef?->lastname }} </a></td>
                                                        @else
                                                        <td><a href="{{ route('admin.franchises.show', $role->franchise_id) }}">{{ $role->franchise?->firstname }} {{ $role->franchise?->lastname }} </a></td>
                                                        @endif

                                                        <td>{{ date('d-m-y H:i:s A', strtotime($role->login_time)) }} </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ $logs->appends(request()->query())->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            @else
                <p class="py-5 text-center">No Roles Found</p>
            @endif
        </div>
    </div>
@endsection
@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/vendor/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/responsive.bootstrap4.min.js') }}"></script>
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
                    [0, "asc"]
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
                    orderable: !1
                }, ]
            })
        });
    </script>

    <script type="text/javascript">

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
