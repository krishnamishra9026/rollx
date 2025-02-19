@extends('layouts.admin')
@section('title', 'Create Product Price')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ route('admin.product-prices.index') }}" class="btn btn-sm btn-primary me-1"><i
                                class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                        <button type="submit" class="btn btn-sm btn-danger" form="serviceForm"><i
                                class="mdi mdi-database me-1"></i>Save</button>
                    </div>
                    <h4 class="page-title">Create Product Price</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <!-- end page title -->
        <div class="row">
            <form id="serviceForm" method="POST" action="{{ route('admin.product-prices.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="col-12">

                    <div class="card">
                        <div class="card-body">


                            <div class="row mb-2">
                                <label class="col-form-label col-sm-2" for="product">Products</label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="product" name="product_id">
                                        <option value="">Select Product</option>
                                        @foreach($products as $product)
                                        <option value="{{ $product->id }}" {{ request('product_id') == $product->id ? 'selected' : '' }}>
                                            {{ $product->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="row mb-2">
                                <label class="col-form-label col-sm-2" for="franchise">Franchises</label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="franchise" name="franchise_id">
                                        <option value="">Select Franchise</option>
                                        @foreach($franchises as $franchise)
                                        <option value="{{ $franchise->id }}" {{ request('franchise_id') == $franchise->id ? 'selected' : '' }}>
                                            {{ $franchise->firstname }} {{ $franchise->lastname }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>  
                            </div>




                            <div class="row mb-2">
                                <label class="col-form-label col-sm-2" for="price">Price</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="price" name="price"
                                        placeholder="Enter Quantity" value="{{ old('price', 0) }}">
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            

                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ route('admin.product-prices.index') }}" class="btn btn-sm btn-primary me-1"><i
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
