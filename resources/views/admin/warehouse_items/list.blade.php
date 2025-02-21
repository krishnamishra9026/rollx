@extends('layouts.admin')
@section('title', 'Products')
@section('head')
    <link href="{{ asset('assets/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<style type="text/css">
    .notification::before {
        content: "🔔 ";
        font-size: 16px;
    }
</style>
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">

                    <div class="page-title-right">

                        @if(Auth::guard('administrator')->user()->roles()->first()->name == 'Administrator')
                        <a href="{{ route('admin.warehouse-items.create') }}" class="btn btn-sm btn-dark float-end"><i  class="mdi mdi-plus"></i> Add  Item</a>
                        @endif
                       <!--  <a href="{{ route('admin.warehouse-items.index') }}" class="btn btn-sm btn-primary float-end me-1"><i  class="mdi mdi-refresh"></i> Reset</a>
                        <button type="submit" class="btn btn-sm btn-danger float-end me-1" form="filterForm"><i  class="mdi mdi-filter"></i> Filter</button> -->
                    </div>

                    <h4 class="page-title">Warehouse Items</h4>
                </div>
            </div>
        </div>

        @include('admin.includes.flash-message')
        @include('admin.warehouse_items.filter')
        <div class="row py-3">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table id="basic-datatable" class="table table-striped border dt-responsive nowrap w-100"
                                    style="font-size: 14px;">
                                    <thead class="bg-dark">
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Unit</th>
                                            <th>Total Quantity</th>
                                            <th>Date Added</th>
                                            <th>Inventory</th>
                                            @if(Auth::guard('administrator')->user()->roles()->first()->name == 'Administrator')
                                            <th class="text-end">Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td><a href="{{ route('admin.warehouse-items.edit', $item->id) }}"
                                                    class="text-body fw-semibold">{{ $item->name }}</a>
                                                </td>
                                                <td>{{ $item->unit }}</td>
                                                <td>{{ $item->inventory()->count() }}</td>
                                               
                                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('M d, Y') }}</td>
                                                <td><a class="btn btn-success" href="{{ route('admin.warehouse-inventory.index', ['item_id' => $item->id]) }}">View Inventory</a></td>
                                                @if(Auth::guard('administrator')->user()->roles()->first()->name == 'Administrator')
                                                <td class="text-end">
                                                    
                                                    <a href="#" class="dropdown-toggle arrow-none card-drop"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a href="{{ route('admin.warehouse-items.edit', $item->id) }}"
                                                            class="dropdown-item"><i class="fa fa-edit me-1"></i>
                                                            Edit
                                                        </a>
                                                
                                                        <a href="javascript:void(0);"
                                                            onclick="confirmDelete({{ $item->id }})"
                                                            class="dropdown-item"><i class="fa fa-trash-alt me-1"></i>
                                                            Delete
                                                        </a>
                                                        <form id='delete-form{{ $item->id }}'
                                                            action='{{ route('admin.warehouse-items.destroy', $item->id) }}'
                                                            method='POST'>
                                                            <input type='hidden' name='_token'
                                                                value='{{ csrf_token() }}'>
                                                            <input type='hidden' name='_method' value='DELETE'>
                                                        </form>
                                                    </div>
                                                </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $items->appends(request()->query())->links('pagination::bootstrap-5') }}
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


<script type="text/javascript">
    
    $(document).ready(function() {

        $(".quantity-text").on("click", function() {
        let $span = $(this);
        let $input = $span.siblings(".edit-quantity");

        $span.hide(); // Hide the span
        $input.show().focus(); // Show the input and focus on it
    });

    $(".edit-quantity").on("blur", function() {
        let $input = $(this);
        let newQuantity = $input.val();
        let productId = $input.data("id");
        let $span = $input.siblings(".quantity-text");

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
        $.ajax({
            url: "{{ route('admin.warehouse-items.update.quantity') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: productId,
                quantity: newQuantity
            },
            success: function(response) {
                $span.text(newQuantity); // Update span text
            },
            error: function(xhr) {
                alert("Error updating quantity.");
            },
            complete: function() {
                $input.hide(); // Hide input after update
                $span.show(); // Show the span again
            }
        });
    });
});

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
                },  {
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
