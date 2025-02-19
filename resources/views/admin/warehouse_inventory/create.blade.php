@extends('layouts.admin')
@section('title', 'Create Warehouse Item Inventory')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ route('admin.warehouse-inventory.index') }}" class="btn btn-sm btn-primary me-1"><i
                                class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                        <button type="submit" class="btn btn-sm btn-danger" form="serviceForm"><i
                                class="mdi mdi-database me-1"></i>Save</button>
                    </div>
                    <h4 class="page-title">Create Warehouse Item Inventory</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <!-- end page title -->
        <div class="row">
            <form id="serviceForm" method="POST" action="{{ route('admin.warehouse-inventory.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="col-12">

                    <div class="card">
                        <div class="card-body">

                            <input type="hidden" name="warehouse_item_id" value="{{ old('warehouse_item_id', $item_id) }}">

                            <div class="row mb-2">
                                <label class="col-form-label col-sm-2" for="quantity">Quantity</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="quantity" name="quantity"
                                        placeholder="Enter Quantity" value="{{ old('quantity', 1) }}">
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
                                        placeholder="Enter Quantity" value="{{ old('cost', 1) }}">
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

                                        <option value="Kg" {{ old('unit') == 'Kg' ? 'selected' : '' }}>Kg</option>
                                        <option value="Packet" {{ old('unit') == 'Packet' ? 'selected' : '' }}>Packet</option>
                                        <option value="Litre" {{ old('unit') == 'Litre' ? 'selected' : '' }}>Litre</option>
                                        <option value="Piece" {{ old('unit') == 'Piece' ? 'selected' : '' }}>Piece</option>
                                        <option value="Box" {{ old('unit') == 'Box' ? 'selected' : '' }}>Box</option>
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
                                    <input type="date" class="form-control" id="date_inward" name="date_inward"
                                        placeholder="Enter Name" value="{{ old('date_inward') }}" max="{{ date('Y-m-d') }}">
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
                                    <input type="date" class="form-control" id="date_outward" name="date_outward"
                                        placeholder="Enter Name" min="{{ date('Y-m-d') }}" value="{{ old('date_outward') }}">
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

@push('scripts')
    <script>
        $(function() {
            // Multiple images preview in browser
            var imagesPreview = function(input, placeToInsertImagePreview) {

                if (input.files) {
                    var filesAmount = input.files.length;

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            $($.parseHTML('<img>')).attr('src', event.target.result).attr('width', '150px')
                                .attr('height', '100px').attr('class', 'me-2 mt-2 mb-2 border').appendTo(
                                    placeToInsertImagePreview);
                        }

                        reader.readAsDataURL(input.files[i]);
                    }
                }

            };

            $('#images').on('change', function() {
                $('.gallery').html('')
                imagesPreview(this, 'span.gallery');
            });
        });
    </script>

    <script>
        $(function() {
            // Multiple images preview in browser
            var documentsPreview = function(input, placeToInsertImagePreview) {

                if (input.files) {
                    var filesAmount = input.files.length;

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        $($.parseHTML('<span>')).css('width', '150px')
                            .css('height', '100px').attr('class', 'me-2 mt-2 mb-2 border text-center py-4')
                            .text(input.files[i].name).appendTo(
                                placeToInsertImagePreview);

                    }

                }

            };

            $('#documents').on('change', function() {
                $('.document-list').html('')
                documentsPreview(this, 'span.document-list');
            });
        });
    </script>
@endpush
