@extends('layouts.admin')
@section('title', 'Create Assignment')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-primary">
                        <i class="mdi mdi-arrow-left me-1"></i>Back
                    </a>
                </div>
                <h4 class="page-title">Assign Product - {{ $product->name }}</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.products.assign') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label">Available Quantity</label>
                            <div class="col-md-9">
                                <p class="form-control-static">{{ $product->available_quantity }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label">Assignment Type</label>
                            <div class="col-md-9">
                                <select class="form-select @error('assignment_type') is-invalid @enderror" 
                                    name="assignment_type" required>
                                    <option value="">Select Type</option>
                                    <option value="kitchen">Kitchen</option>
                                    <option value="cart">Cart</option>
                                    <option value="new_opening">New Opening</option>
                                    @if($product->franchise_sale)
                                        <option value="franchise">Franchise</option>
                                    @endif
                                </select>
                                @error('assignment_type')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label">Quantity</label>
                            <div class="col-md-9">
                                <input type="number" class="form-control @error('quantity') is-invalid @enderror" 
                                    name="quantity" min="1" max="{{ $product->available_quantity }}" required>
                                @error('quantity')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label">Comment</label>
                            <div class="col-md-9">
                                <textarea class="form-control @error('comment') is-invalid @enderror" 
                                    name="comment" rows="3"></textarea>
                                @error('comment')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-9 offset-md-3">
                                <button type="submit" class="btn btn-primary">Save Assignment</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if($existingAssignments->count() > 0)
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Existing Assignments</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-centered table-striped">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Quantity</th>
                                    <th>Assigned At</th>
                                    <th>Comment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($existingAssignments as $assignment)
                                <tr>
                                    <td>{{ ucfirst($assignment->assignment_type) }}</td>
                                    <td>{{ $assignment->quantity }}</td>
                                    <td>{{ $assignment->assigned_at->format('d M Y H:i') }}</td>
                                    <td>{{ $assignment->comment }}</td>
                                    <td>
                                        <a href="{{ route('admin.products.assignments.edit', $assignment->id) }}" 
                                            class="btn btn-sm btn-info">Edit</a>
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
    @endif
</div>
@endsection