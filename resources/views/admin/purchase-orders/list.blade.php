@extends('layouts.admin')
@section('title', 'Purchase Orders')
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
                        <a href="{{ route('admin.purchase-orders.create') }}" class="btn btn-sm btn-dark float-end"><i
                                class="mdi mdi-plus"></i> Add
                            New</a>
                        <a href="{{ route('admin.purchase-orders.index') }}"
                            class="btn btn-sm btn-primary float-end me-1"><i class="mdi mdi-refresh"></i> Reset</a>
                        <button type="submit" class="btn btn-sm btn-danger float-end me-1" form="filterForm"><i
                                class="mdi mdi-filter"></i> Filter</button>
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger float-end me-1" style="display: none"
                            id="delete-all">
                            <i class="mdi mdi-delete"></i> {{ __('Delete') }}</a>
                    </div>
                    <h4 class="page-title">Overseas Purchase Orders</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        @include('admin.purchase-orders.filter')
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
                                            <th class="fw-bold">Purchase Order Id</th>
                                            <th class="fw-bold">Model Number</th>
                                            <th class="fw-bold">Quantity</th>
                                            <th class="fw-bold">Order Date</th>
                                            <th class="fw-bold">Due Date</th>
                                            <th class="fw-bold">Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ '#PO-00' . $order->id }}</td>
                                                <td>{{ $order->model_number }}</td>
                                                <td>{{ $order->quantity }}</td>
                                                <td>{{ \Carbon\Carbon::parse($order->order_date)->format('M d, Y') }}</td>
                                                <td>
                                                    {{ $order->due_date }} {{ $order->due_date > 1 ? 'Weeks' : 'Week' }}
                                                </td>
                                                <td>
                                                    {{ ucfirst($order->status) }}
                                                </td>


                                                {{-- <td>
                                                    <button type="button" class="btn btn-sm btn-success"
                                                        id="changeStatus{{ $order->id }}"
                                                        onclick="showHide({{ $order->id }})">{{ ucfirst($order->status) }}</button>
                                                    <select class="form-select form-select-sm custom-select"
                                                        id="changeSelect{{ $order->id }}"
                                                        onchange="changeStatus({{ $order->id }}, this.value)"
                                                        style="display: none">
                                                        @if ($order->status != 'pending')
                                                            <option value="pending"
                                                                {{ $order->status == 'pending' ? 'selected' : '' }}>Pending
                                                            </option>
                                                        @endif
                                                        @if ($order->status != 'PO Generated')
                                                            <option value="PO Generated"
                                                                {{ $order->status == 'PO Generated' ? 'selected' : '' }}>
                                                                PO Generated</option>
                                                        @endif
                                                        @if ($order->status != 'In Progress')
                                                            <option value="In Progress"
                                                                {{ $order->status == 'In Progress' ? 'selected' : '' }}>In
                                                                Progress</option>
                                                        @endif
                                                        @if ($order->status != 'Completed')
                                                            <option value="Completed"
                                                                {{ $order->status == 'Completed' ? 'selected' : '' }}>
                                                                Completed</option>
                                                        @endif
                                                        @if ($order->status != 'Delivered')
                                                            <option value="Delivered"
                                                                {{ $order->status == 'Delivered' ? 'selected' : '' }}>
                                                                Delivered</option>
                                                        @endif
                                                    </select>
                                                </td> --}}
                                                <td>
                                                    <a href="#"
                                                        class="border bg-white dropdown-toggle arrow-none card-drop"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a href="{{ route('admin.purchase-orders.edit', $order->id) }}"
                                                            class="dropdown-item"><i class="fa fa-edit me-1"></i>
                                                            Edit</a>
                                                        <a href="{{ route('admin.purchase-orders.show', $order->id) }}"
                                                            class="dropdown-item"><i class="fa fa-eye me-1"></i>
                                                            View</a>
                                                        <a href="javascript:void(0);"
                                                            onclick="confirmClone({{ $order->id }})"
                                                            class="dropdown-item"><i class="fa fa-copy me-1"></i>
                                                            Clone</a>
                                                        <a href="javascript:void(0);"
                                                            onclick="confirmDelete({{ $order->id }})"
                                                            class="dropdown-item"><i class="fa fa-trash-alt me-1"></i>
                                                            Delete</a>
                                                        <form id='delete-form{{ $order->id }}'
                                                            action='{{ route('admin.purchase-orders.destroy', $order->id) }}'
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
                                {{ $orders->appends(request()->query())->links('pagination::bootstrap-5') }}
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

        function confirmClone(e) {
            var url = '{{ route('admin.purchase-orders.clone', ':id') }}';
            Swal.fire({
                title: "Are you sure?",
                text: "You want to clone this Order!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Clone it!"
            }).then(t => {
                t.isConfirmed && (location.href = url = url.replace(':id', e));
            })
        }
    </script>
    <script>
        function changeStatus(id, value) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                }
            });
            var formData = {
                order_id: id,
                status: value
            };
            $.ajax({
                type: 'POST',
                url: '{{ route('admin.purchase-orders.change-status') }}',
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
    <script>
        function showHide(id) {
            $("#changeStatus" + id).hide();
            $("#changeSelect" + id).show();
        }
    </script>
@endpush
