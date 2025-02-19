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
            <form id="serviceForm" method="POST" action="{{ route('admin.warehouse-inventory.update', $warehouseInventory->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col-12">

                    <div class="card">
                        <div class="card-body">

                            <div class="row mb-2">
                                <label class="col-form-label col-sm-2" for="quantity">Quantity</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="quantity" name="quantity"
                                        placeholder="Enter Quantity" value="{{ old('quantity', $warehouseInventory->quantity) }}">
                                    @error('quantity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-2">
                                <label class="col-form-label col-sm-2" for="cost">Cost</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="cost" name="cost"
                                        placeholder="Enter Quantity" value="{{ old('cost', $warehouseInventory->cost) }}">
                                    @error('cost')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-2">
                                <label for="unit"
                                    class="col-md-2 col-form-label text-md-start">{{ __('Unit') }}</label>
                                <div class="col-md-10">
                                    <select id="unit" class="form-select @error('unit') is-invalid @enderror"
                                        name="unit">
                                        <option value="">Select Unit</option>

                                        <option value="Kg" {{ old('unit', $warehouseInventory->unit) == 'Kg' ? 'selected' : '' }}>Kg</option>
                                        <option value="Packet" {{ old('unit', $warehouseInventory->unit) == 'Packet' ? 'selected' : '' }}>Packet</option>
                                        <option value="Litre" {{ old('unit', $warehouseInventory->unit) == 'Litre' ? 'selected' : '' }}>Litre</option>
                                        <option value="Piece" {{ old('unit', $warehouseInventory->unit) == 'Piece' ? 'selected' : '' }}>Piece</option>
                                        <option value="Box" {{ old('unit', $warehouseInventory->unit) == 'Box' ? 'selected' : '' }}>Box</option>
                                    </select>
                                    @error('unit')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-2">
                                <label class="col-form-label col-sm-2" for="date_inward">Date Inward</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="date_inward" name="date_inward" max="{{ date('Y-m-d') }}"
                                        placeholder="Enter Name" value="{{ old('date_inward', $warehouseInventory->date_inward) }}">
                                    @error('date_inward')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="row mb-2">
                                <label class="col-form-label col-sm-2" for="date_outward">Date Outward</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="date_outward" name="date_outward" min="{{ date('Y-m-d') }}"
                                        placeholder="Enter Name" value="{{ old('date_outward', $warehouseInventory->date_outward) }}">
                                    @error('date_outward')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>



                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ route('admin.warehouse-inventory.index') }}" class="btn btn-sm btn-primary me-1"><i
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
