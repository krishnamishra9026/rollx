@extends('layouts.admin')
@section('title', 'Edit Assignment')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <a href="{{ route('admin.products.assignments.history', $assignment->product_id) }}" 
                        class="btn btn-sm btn-primary">
                        <i class="mdi mdi-arrow-left me-1"></i>Back
                    </a>
                </div>
                <h4 class="page-title">Edit Assignment - {{ $assignment->product->name }}</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.products.assignments.update', $assignment->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label">Assignment Type</label>
                            <div class="col-md-9">
                                <p class="form-control-static">{{ ucfirst($assignment->assignment_type) }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label">Quantity</label>
                            <div class="col-md-9">
                                <input type="number" class="form-control @error('quantity') is-invalid @enderror" 
                                    name="quantity" value="{{ old('quantity', $assignment->quantity) }}" required>
                                @error('quantity')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label">Comment</label>
                            <div class="col-md-9">
                                <textarea class="form-control @error('comment') is-invalid @enderror" 
                                    name="comment" rows="3">{{ old('comment', $assignment->comment) }}</textarea>
                                @error('comment')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-9 offset-md-3">
                                <button type="submit" class="btn btn-primary">Update Assignment</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection