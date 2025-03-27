@extends('layouts.admin')
@section('title', 'User')
@section('head')
    <link href="{{ asset('assets/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">

                        @can('Create User')
                            <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-dark float-end ms-1"><i
                                    class="mdi mdi-plus"></i> User</a>
                        @endcan
                        <button type="submit" class="btn btn-sm btn-danger"><i class="mdi mdi-filter "></i> Filter</button>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-primary"><i class="mdi mdi-refresh"></i>  Reset</a>
                    </div>
                    <h4 class="page-title">Users</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        @include('admin.users.filter')
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th class="bg-green">User Id</th>
                                            <th class="bg-green">Role</th>
                                            <th class="bg-green">User</th>
                                            <th class="bg-green">Email</th>
                                            <th class="bg-green">Phone</th>
                                            <th class="bg-green">Direct Login</th>
                                            <th class="bg-green text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($superadmins as $admin)
                                            <tr>
                                                <td>{{ $admin->id }}</td>
                                                <td class="text-success">
                                                    @foreach ($admin->roles as $role)
                                                        {{ $role->name }}
                                                    @endforeach
                                                </td>
                                                <td class="table-user">

                                                    <img @isset($admin->avatar) src="{{ asset('storage/uploads/admins/' . $admin->slug . '/' . $admin->avatar) }}" @else src="https://placehold.co/150x150/0657BB/FFF?text={{ $admin->firstname[0] }}{{ $admin->lastname[0]; }}" @endisset
                                                        alt="table-user" class="me-1 rounded-circle" width="30px">
                                                    <a href="javascript:void(0);"
                                                        class="text-body fw-semibold">{{ $admin->firstname }}
                                                        {{ $admin->lastname }}</a>
                                                </td>
                                                
                                                <td>{{ $admin->email }}</td>
                                                <td>{{ $admin->dialcode }} {{ $admin->phone }}</td>
                                                

                                                <td>
                                                     <a href="{{ route('admin.intend-login', $admin->id) }}" class="btn btn-sm btn-primary">Login</a>
                                                </td>

                                                <td class="text-end">
                                                    <a href="#" class="dropdown-toggle arrow-none card-drop"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        @can('Edit User')
                                                            <a href="javascript:void(0);" class="dropdown-item change-password"
                                                                data-bs-toggle="modal" data-bs-target="#modal-password"
                                                                data-id="{{ $admin->id }}"
                                                                data-name="{{ $admin->firstname }} {{ $admin->lastname }}"><i
                                                                    class="mdi mdi-lock-outline me-1"></i> Change Password</a>
                                                        @endcan
                                                        @can('View User')
                                                            <a href="{{ route('admin.users.show', $admin->id) }}"
                                                                class="dropdown-item"><i class="mdi mdi-eye me-1"></i>
                                                                View
                                                                User</a>
                                                        @endcan
                                                        @can('Edit User')
                                                            <a href="{{ route('admin.users.edit', $admin->id) }}"
                                                                class="dropdown-item"><i
                                                                    class="mdi mdi-circle-edit-outline me-1"></i>
                                                                Edit
                                                                User</a>
                                                        @endcan
                                                        @can('Delete User')
                                                            <a href="javascript:void(0);"
                                                                onclick="confirmDelete({{ $admin->id }})"
                                                                class="dropdown-item"><i
                                                                    class="mdi mdi-trash-can-outline me-1"></i>
                                                                Delete
                                                                User</a>
                                                            <form id='delete-form{{ $admin->id }}'
                                                                action='{{ route('admin.users.destroy', $admin->id) }}'
                                                                method='POST'>
                                                                <input type='hidden' name='_token'
                                                                    value='{{ csrf_token() }}'>
                                                                <input type='hidden' name='_method' value='DELETE'>
                                                            </form>
                                                        @endcan
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $superadmins->appends(request()->query())->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-password" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-passwordLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <p class="modal-title text-center" id="primary-header-modalLabel"><strong>Want to Change Password of
                        </strong><span id="volunteer_name">{{ old('volunteer_name') }}</span></p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="changePasswordForm"
                        action="{{ route('admin.users.reset-password') }}">
                        @csrf
                        <input type="hidden" value="{{ old('volunteer_name') }}" name="volunteer_name"
                            id="volunteer_name_input">
                        <input type="hidden" value="{{ old('id') }}" name="id" id="id">
                        <div class="form-group mb-2 {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label for="password">New password *</label>
                            <input type="password" id="password" name="password" placeholder="Enter new password"
                                class="form-control">
                            @error('password')
                                <code id="name-error" class="text-danger">{{ $message }}</code>
                            @enderror
                        </div>
                        <div class="form-group mb-2 {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                            <label for="password_confirmation">Confirm password *</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control" placeholder="Re-enter new password">
                        </div>
                    </form>
                </div>
                <div class="text-center mb-3">
                    <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="changePasswordForm" class="btn btn-sm btn-success">Confirm</button>
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
                    [0, "asc"]
                ],
                columnDefs: [{
                    targets: [0],
                    visible: !0,
                    searchable: !0
                }],
                columns: [{
                    orderable: !1
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
                }, {
                    orderable: !1
                }, ]
            })
        });
    </script>

    <script type="text/javascript">
        $("#all-rows").change(function() {
            var c = [];
            this.checked ? ($(".checkbox-row").prop("checked", !0), $("input:checkbox[name=rows]:checked").each(
                function() {
                    c.push($(this).val())
                }), $("#delete-all").css("display", "block")) : ($(".checkbox-row").prop("checked", !1),
                c = [], $("#delete-all").css("display", "none"))
        });

        $(".checkbox-row").change(function() {
            rows = [], $("input:checkbox[name=rows]:checked").each(function() {
                rows.push($(this).val())
            }), 0 == rows.length ? $("#delete-all").css("display", "none") : $("#delete-all").css("display",
                "block")
        });

        $("#delete-all").click(function(e) {
            rows = [], $("input:checkbox[name=rows]:checked").each(function() {
                rows.push($(this).val())
            }), Swal.fire({
                title: "Are you sure?",
                text: "You want to delete selected rows!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Delete selected!"
            }).then(t => {
                t.isConfirmed && ($("#delete-all").text("Deleting..."), e.preventDefault(), $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('admin.users.bulk-delete') }}",
                    data: {
                        users: rows,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(e) {
                        location.reload()
                    }
                }))
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

        $(".status").change(function() {
            var url = "{{ route('admin.users.change-status', ':id') }}";
            url = url.replace(':id', this.value);
            window.location.href = url;
        });

        $(".change-password").click(function() {
            var a = $(this).data("id"),
                t = $(this).data("name");
            $("#id").val(a), $("#volunteer_name").text(t), $("#volunteer_name_input").val(t)
        });
    </script>


    @error('password')
        <script>
            $(document).ready(function() {
                $('#modal-password').modal('show');
            });
        </script>
    @enderror
@endpush


<!-- <td style="display: none;"><input type="checkbox" id="switch{{ $admin->id }}"
                                                        @if ($admin->status == true) checked @endif
                                                        data-switch="success" value="{{ $admin->id }}" class="status" />
                                                    <label for="switch{{ $admin->id }}" data-on-label="Yes"
                                                        data-off-label="No"></label>
                                                </td> -->