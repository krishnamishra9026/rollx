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
                        <a href="{{ route('admin.warehouse-items.create') }}" class="btn btn-sm btn-dark float-end"><i  class="mdi mdi-plus"></i> Item</a>
                        @endif
                        <a href="{{ route('admin.warehouse-items.index') }}" class="btn btn-sm btn-primary float-end me-1"><i  class="mdi mdi-refresh"></i> Reset</a>
                        <button type="submit" class="btn btn-sm btn-danger float-end me-1" form="filterForm"><i  class="mdi mdi-filter"></i> Filter</button>
                    </div>

                    <h4 class="page-title">Warehouse Items</h4>
                </div>
            </div>
        </div>

        @include('admin.includes.flash-message')
        <p id="message"></p>
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
                                            <th>Total Inventory</th>
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
                                                <td class="text-center"> <a href="{{ route('admin.warehouse-inventory.index', ['item_id' => $item->id]) }}">{{ $item->inventory()->count() }} </a></td>
                                                <td class="text-center">{{ $item->inventory()->sum('quantity') }}</td>
                                               
                                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('M d, Y') }}</td>

                                                <td>
                                                    <a class="btn btn-sm btn-primary" data-item_id="{{ $item->id }}" id="add-inventory"><i  class="mdi mdi-plus"></i> Inventory</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('admin.warehouse-inventory.index', ['item_id' => $item->id]) }}"><i  class="fa fa-eye me-1"></i> Inventory</a>
                                                </td>

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

        <!-- Inventory Modal -->
        <div class="modal fade" id="inventoryModal" tabindex="-1" aria-labelledby="inventoryModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="inventoryModalLabel">Add Warehouse Inventory</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="inventoryForm">
                            <div class="mb-1">
                                <input type="hidden" name="warehouse_item_id" id="warehouse_item_id">
                                <label for="name" class="form-label">Unit</label>
                                <select id="unit" class="form-select @error('unit') is-invalid @enderror" name="unit" required>
                                    <option value="">Select Unit</option>
                                    <option value="Kg" {{ old('unit') == 'Kg' ? 'selected' : '' }}>Kg</option>
                                    <option value="Packet" {{ old('unit') == 'Packet' ? 'selected' : '' }}>Packet</option>
                                    <option value="Litre" {{ old('unit') == 'Litre' ? 'selected' : '' }}>Litre</option>
                                    <option value="Piece" {{ old('unit') == 'Piece' ? 'selected' : '' }}>Piece</option>
                                    <option value="Box" {{ old('unit') == 'Box' ? 'selected' : '' }}>Box</option>
                                </select>
                            </div>

                            <div class="mb-1">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" required>
                            </div>
                            <div class="mb-1">
                                <label for="cost" class="form-label">Cost</label>
                                <input type="number" step="0.01" class="form-control" id="cost" name="cost" required>
                            </div>
                            <div class="mb-1">
                                <label for="date_inward" class="form-label">Date Inward</label>
                                <input type="date" class="form-control" max="{{ date('Y-m-d') }}" id="date_inward" name="date_inward" required>
                            </div>
                            <div class="mb-1">
                                <label for="date_outward" class="form-label">Date Outward</label>
                                <input type="date" class="form-control" min="{{ date('Y-m-d') }}" id="date_outward" name="date_outward">
                            </div>
                            <button type="submit" class="btn btn-success">Save</button>
                        </form>
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

    $(document).on('click', '#add-inventory',  function() {
        var item_id = $(this).data('item_id');
        $("#warehouse_item_id").val(item_id);
        $('#inventoryModal').modal('show');
    });

    
    $(document).ready(function() {

        $(".quantity-text").on("click", function() {
        let $span = $(this);
        let $input = $span.siblings(".edit-quantity");

        $span.hide(); // Hide the span
        $input.show().focus(); // Show the input and focus on it
    });

        $(document).ready(function() {
            $('#inventoryForm').submit(function(e) {
                e.preventDefault();
                
                let formData = {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    warehouse_item_id: $('#warehouse_item_id').val(),
                    unit: $('#unit').val(),
                    quantity: $('#quantity').val(),
                    cost: $('#cost').val(),
                    date_inward: $('#date_inward').val(),
                    date_outward: $('#date_outward').val()
                };

                $.ajax({
                    url: "{{ route('admin.warehouse-inventory.add') }}",
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        $('#message').text(response.message).addClass('text-success');
                        alert(response.message);
                        $('#inventoryForm')[0].reset();
                        $('#inventoryModal').modal('hide');
                        setTimeout(function() {
                            location.reload();
                        }, 500);
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        alert("Error: " + Object.values(errors).join(", "));
                    }
                });
            });
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
