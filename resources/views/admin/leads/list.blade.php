@extends('layouts.admin')
@section('title', 'Leads')
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
                        @can('View Leads')
                        <a href="{{ route('admin.leads.create') }}" class="btn btn-sm btn-secondary float-end ms-1"><i
                                class="mdi mdi-plus"></i> Lead</a>
                        @endcan

                        <button type="submit" class="btn btn-sm btn-danger ms-1" > <i class="mdi mdi-filter"></i> Filter </button> 

                        <a href="{{ route('admin.leads.index', ['status' => request()->get('status')]) }}" class="btn btn-sm btn-primary ms-1" > <i class="mdi mdi-refresh"></i> Reset</a>
                        &nbsp;

                        <a href="{{ route('admin.leads.assign-leads') }}" class="btn btn-sm btn-dark float-end"><i
                                class="mdi mdi-account-arrow-right"></i> Assign</a>

                    </div>
                    <h4 class="page-title">Leads</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        @include('admin.leads.filter')
        <div class="row">
            <div class="col-12">
                <div class="card">

                     <div class="card-header ">

                        <div class="row">
                            <div class="col-md-8 col-sm-12 mt-1">
                                <a href="{{ route('admin.leads.export', ['product' => request('product'), 'order_date' => request('order_date'), 'order' => request('order'), 'status' => request('status') ]) }}" class="btn btn-sm btn-primary text-left">
                                    <i class="mdi mdi-export"></i> Export
                                </a>

                                <a href="{{ route('admin.leads.download.sample.csv') }}" class="btn btn-sm btn-secondary" style="float: right;" ><i class="mdi mdi-download"></i> Sample CSV</a>

                            </div>
                            <div class="col-md-4 col-sm-12 mt-1 text-center" style="display: block;">
                                <form action="{{ route('admin.leads.import') }}" method="POST" enctype="multipart/form-data" class="d-flex flex-column flex-sm-row align-items-center gap-2">
                                    @csrf
                                    <input type="file" name="file" required class="form-control form-control-sm">
                                    <button type="submit" class="btn btn-sm btn-success" style="white-space: nowrap;"><i class="mdi mdi-import"></i> Import CSV</button>
                                </form>
                            </div>
                        </div>

                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100"
                                    style="font-size: 14px;">
                                    <thead class="bg-dark">
                                        <tr>
                                            <th class="fw-bold">Id</th>
                                            <th class="fw-bold">Contact Person</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>City</th>
                                            @if( Auth::guard('administrator')->user()->roles()->first()->name == 'Administrator')
                                            <th>Sale Emplaoye(Select to assign)</th>
                                            @endif
                                            <th>Status(Select to change)</th>
                                            <th>Next Call Date Time</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($leads as $lead)
                                            <tr data-id="{{ $lead->id }}">
                                                <td>{{ $lead->id }}</td>
                                                <td class="table-user">

                                                    <img @isset($lead->avatar) src="{{ asset('storage/uploads/technican/' . $lead->avatar) }}" @else src="{{ asset('assets/images/users/avatar.png') }}" @endisset
                                                        alt="table-user" class="me-2 rounded-circle">
                                                    <a href="{{ route('admin.leads.show', $lead->id) }}"
                                                        class="text-body fw-semibold">{{ $lead->firstname }}
                                                        {{ $lead->lastname }}</a>
                                                </td>
                                                <td>{{ $lead->email }}</td>
                                                <td>{{ $lead->phone }}</td>
                                                <td>{{ $lead->city }}</td>

                                                @if( Auth::guard('administrator')->user()->roles()->first()->name == 'Administrator')
                                                <td>

                                                    <select class="form-select form-select-sm custom-select" id="changeSelect{{ $lead->id }}"  onchange="changeAdmin({{ $lead->id }}, this.value)">
                                                            <option value="">Please select</option>
                                                            @if($sale_employees && count($sale_employees))
                                                                @foreach($sale_employees as $sale_employee)
                                                                <option value="{{ $sale_employee->id }}" {{ $lead->admin_id ==  $sale_employee->id ? 'selected' : ''}}>{{ $sale_employee->firstname }} {{ $sale_employee->lastname }}</option>
                                                                @endforeach
                                                            @endif
                                                    </select>
                                                </td>
                                                @endif

                                                <td>

                                                    <select class="form-select form-select-sm custom-select"
                                                        id="changeSelect{{ $lead->id }}"
                                                        onchange="changeStatus({{ $lead->id }}, this.value)"
                                                        style="display: block">
                                                            <option value="">Please select Status</option>
                                                            <option value="Pending" {{ $lead->status == 'Pending' ? 'selected' : ''}}>Pending</option>
                                                            <option value="Fresh" {{ $lead->status == 'Fresh' ? 'selected' : ''}}>Fresh</option>
                                                            <option value="Interested" {{ $lead->status == 'Interested' ? 'selected' : ''}}>Interested</option>
                                                            <option value="Non Contactable" {{ $lead->status == 'Non Contactable' ? 'selected' : ''}}>Non Contactable</option>
                                                            <option value="Paspect" {{ $lead->status == 'Paspect' ? 'selected' : ''}}>Paspect</option>
                                                            <option value="Closed" {{ $lead->status == 'Closed' ? 'selected' : ''}}>Closed</option>
                                                            <option value="Not Interested" {{ $lead->status == 'Not Interested' ? 'selected' : ''}}>Not Interested</option>
                                                            <option disabled value="Converted" {{ $lead->status == 'Converted' ? 'selected' : ''}}>Converted</option>
                                                    </select>
                                                </td>
                                                <td>                                                  
                                                <input type="datetime-local" data-id="{{ $lead->id }}" id="next_call_datetime" name="next_call_datetime" value="{{ $lead->next_call_datetime }}" class="form-control datetimepicker" required >
                                                </td>
                                                <td class="text-end">
                                                    <a href="#" class="dropdown-toggle arrow-none card-drop"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        @can('Edit Lead')
                                                        <a href="{{ route('admin.leads.edit', $lead->id) }}"
                                                            class="dropdown-item"><i class="fa fa-edit me-1"></i>
                                                            Edit Lead</a>
                                                        @endcan

                                                        @can('View Leads')
                                                        <a href="{{ route('admin.leads.show', $lead->id) }}"
                                                            class="dropdown-item"><i class="fa fa-eye me-1"></i>
                                                            View Leads</a>
                                                        @endcan

                                                        <a href="{{ route('admin.leads.convert', $lead->id) }}"
                                                            class="dropdown-item"><i class="fa fa-eye me-1"></i>
                                                            Conver to Franchise</a>

                                                        @can('Delete Lead')
                                                         <a href="javascript:void(0);"
                                                            onclick="confirmDelete({{ $lead->id }})"
                                                            class="dropdown-item"><i class="fa fa-trash-alt me-1"></i>
                                                            Delete</a>
                                                        @endcan

                                                             <form id='delete-form{{ $lead->id }}'
                                                            action='{{ route('admin.leads.destroy', $lead->id) }}'
                                                            method='POST'>
                                                            <input type='hidden' name='_token'
                                                                value='{{ csrf_token() }}'>
                                                            <input type='hidden' name='_method' value='DELETE'>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $leads->appends(request()->query())->links('pagination::bootstrap-5') }}
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
                    <form method="POST" id="changePasswordForm" action="{{ route('admin.leads.reset-password') }}">
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


      <script type="text/javascript">
        
        $(document).on("blur", '.datetimepicker', function(event) {

            let datetime = $(this).val();
            let rowId = $(this).attr("data-id");

            $.ajax({
                url: "{{ route('admin.leads.update-date') }}",
                method: "POST",
                data: {
                    id: rowId,
                    datetime: datetime,
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (response) {
                    location.reload();
                },
                error: function () {
                    console.error("Error updating datetime for row " + id);
                },
            });

        });

        function changeAdmin(id, value) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                }
            });
            var formData = {
                lead_id: id,
                admin_id: value
            };
            $.ajax({
                type: 'POST',
                url: '{{ route('admin.leads.assign-admin') }}',
                data: formData,
                dataType: 'json',
                beforeSend: function() {
                    console.log(formData);
                },
                success: function(res, status) {
                    window.location.reload();
                },
                error: function(res, status) {
                    console.log(res);
                }
            });
        }

        function changeStatus(id, value) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                }
            });
            var formData = {
                lead_id: id,
                status: value
            };
            $.ajax({
                type: 'POST',
                url: '{{ route('admin.leads.change-status') }}',
                data: formData,
                dataType: 'json',
                beforeSend: function() {
                    console.log(formData);
                },
                success: function(res, status) {
                    window.location.reload();
                },
                error: function(res, status) {
                    console.log(res);
                }
            });
        }
    </script>



    </script>

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
