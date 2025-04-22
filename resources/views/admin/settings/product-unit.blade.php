@extends('layouts.admin')
@section('title', 'Product Units')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-unit-modal">
                            <i class="mdi mdi-plus-circle me-1"></i>Add Product Unit
                        </button>
                    </div>
                    <h4 class="page-title">Product Units</h4>
                </div>
            </div>
        </div>

        @include('admin.includes.flash-message')

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-centered table-striped dt-responsive nowrap w-100" id="products-datatable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Abbreviation</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($units as $unit)
                                    <tr>
                                        <td>{{ $unit->name }}</td>
                                        <td>{{ $unit->abbreviation }}</td>
                                        <td>{{ $unit->description }}</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" 
                                                data-bs-target="#edit-unit-modal-{{ $unit->id }}">
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteUnit({{ $unit->id }})">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Unit Modal -->
    <div class="modal fade" id="add-unit-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('admin.product-unit.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add Product Unit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Abbreviation</label>
                            <input type="text" class="form-control" name="abbreviation" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach($units as $unit)
    <!-- Edit Unit Modal -->
    <div class="modal fade" id="edit-unit-modal-{{ $unit->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('admin.product-unit.update', $unit->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Product Unit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $unit->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Abbreviation</label>
                            <input type="text" class="form-control" name="abbreviation" value="{{ $unit->abbreviation }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="3">{{ $unit->description }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
@endsection

@push('scripts')
<script>
function deleteUnit(id) {
    if (confirm('Are you sure you want to delete this unit?')) {
        let form = document.createElement('form');
        form.action = `{{ route('admin.product-unit.destroy', '') }}/${id}`;
        form.method = 'POST';
        form.innerHTML = `@csrf @method('DELETE')`;
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endpush