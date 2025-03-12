@extends('layouts.admin')
@section('title', 'Create Product')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-primary me-1"><i
                                class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                        <button type="submit" class="btn btn-sm btn-danger" form="serviceForm"><i
                                class="mdi mdi-database me-1"></i>Save</button>
                    </div>
                    <h4 class="page-title">Create Product</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <!-- end page title -->
        <div class="row">
            <form id="serviceForm" method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="col-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <label class="col-form-label col-sm-2" for="product">Product Id</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name='product_id' value="{{ $nextId }}"
                                        disabled>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label class="col-form-label col-sm-2" for="name">Product Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter Name" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label class="col-form-label col-sm-2" for="outlet_name">Outlet Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="outlet_name" name="outlet_name"
                                        placeholder="Enter Outlet Name" value="{{ old('outlet_name') }}">
                                    @error('outlet_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label for="description" class="col-md-2 col-form-label text-md-start">Product Description</label>

                                <div class="col-md-10">
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="3"
                                        placeholder="Enter Product description">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            

                            <div class="row mb-2">
                                <label class="col-form-label col-sm-2" for="quantity">Quantity</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="quantity" name="quantity"
                                        placeholder="Enter Quantity" value="{{ old('quantity', 0) }}">
                                    @error('quantity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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

                            <div class="row mb-2">
                                <label for="statusesq"
                                    class="col-md-2 col-form-label text-md-start">{{ __('Selling Type') }}</label>
                                <div class="col-md-10">
                                    <select id="statusesq" class="form-select @error('selling_type') is-invalid @enderror"
                                        name="selling_type">
                                        <option value="">Select</option>
                                        <option value="plate">
                                            Plate</option>
                                        <option value="quantity" selected>
                                            Quantity</option>
                                    </select>
                                    @error('selling_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-2">
                                <label for="sold_color"
                                    class="col-md-2 col-form-label text-md-start">{{ __('Sold Color') }}</label>
                                <div class="col-md-10">
                                    <select id="statuses" class="form-select @error('contact') is-invalid @enderror"
                                        name="sold_color">
                                        <option value="">Select Sold Color</option>
                                        <option value="primary" {{ old('sold_color') == 'primary' ? 'selected' : '' }}>Primary</option>
                                        <option value="secondary" {{ old('sold_color') == 'secondary' ? 'selected' : '' }}>Secondary</option>
                                        <option value="success" {{ old('sold_color') == 'success' ? 'selected' : '' }}>Success</option>
                                        <option value="danger" {{ old('sold_color') == 'danger' ? 'selected' : '' }}>Danger</option>
                                        <option value="warning" {{ old('sold_color') == 'warning' ? 'selected' : '' }}>Warning</option>
                                        <option value="info" {{ old('sold_color') == 'info' ? 'selected' : '' }}>Info</option>
                                        <option value="light" {{ old('sold_color') == 'light' ? 'selected' : '' }}>Light</option>
                                        <option value="dark" {{ old('sold_color') == 'dark' ? 'selected' : '' }}>Dark</option>
                                        <option value="link" {{ old('sold_color') == 'link' ? 'selected' : '' }}>Link</option>
                                    </select>
                                    @error('sold_color')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-2" style="display: none;">
                                <label for="statuses"
                                    class="col-md-2 col-form-label text-md-start">{{ __('Status') }}</label>
                                <div class="col-md-10">
                                    <select id="statuses" class="form-select @error('contact') is-invalid @enderror"
                                        name="status">
                                        <option value="">Select Status</option>
                                        <option value="1" selected>
                                            Enable</option>
                                        <option value="0" >
                                            Disable</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label class="col-md-2 col-form-label text-md-start">{{ __('Images') }}</label>
                                <div class="col-md-10">
                                    <input id="images" type="file"
                                        class="form-control @error('images') is-invalid @enderror" name="images[]"
                                        multiple style="display: none">
                                    <label class="border mb-2 me-1" for="images">
                                        <img src="{{ asset('assets/images/image-placeholder.png') }}"></label>
                                    <span class="gallery">

                                    </span>
                                </div>
                            </div>


                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-primary me-1"><i
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
