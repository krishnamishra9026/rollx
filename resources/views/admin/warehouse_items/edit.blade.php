@extends('layouts.admin')
@section('title', 'Edit Product')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary me-1"><i
                                class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                        <button type="submit" class="btn btn-sm btn-danger" form="serviceForm"><i
                                class="mdi mdi-database me-1"></i>Update</button>
                    </div>
                    <h4 class="page-title">Edit Product</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <!-- end page title -->
        <div class="row">
            <form id="serviceForm" method="POST" action="{{ route('admin.warehouse-items.update', $warehouseItem->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                 <div class="col-12">

                    <div class="card">
                        <div class="card-body">
        
                            <div class="row mb-2">
                                <label class="col-form-label col-sm-2" for="name">Item Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter Name" value="{{ old('name', $warehouseItem->name) }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label for="unit"
                                    class="col-md-2 col-form-label text-md-start">{{ __('Unit') }} </label>
                                <div class="col-md-10">
                                    <select id="unit" class="form-select @error('unit') is-invalid @enderror"
                                        name="unit">
                                        <option value="">Select Unit</option>

                                        <option value="Kg" {{ old('unit', $warehouseItem->unit) == 'Kg' ? 'selected' : '' }}>Kg</option>
                                        <option value="Packet" {{ old('unit', $warehouseItem->unit) == 'Packet' ? 'selected' : '' }}>Packet</option>
                                        <option value="Litre" {{ old('unit', $warehouseItem->unit) == 'Litre' ? 'selected' : '' }}>Litre</option>
                                        <option value="Piece" {{ old('unit', $warehouseItem->unit) == 'Piece' ? 'selected' : '' }}>Piece</option>
                                        <option value="Box" {{ old('unit', $warehouseItem->unit) == 'Box' ? 'selected' : '' }}>Box</option>
                                    </select>
                                    @error('unit')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>



                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ route('admin.warehouse-items.index') }}" class="btn btn-sm btn-primary me-1"><i
                                    class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                            <button type="submit" class="btn btn-sm btn-danger" form="serviceForm"><i
                                    class="mdi mdi-database me-1"></i>Save</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div> <!-- container -->

@endsection
