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
            <form id="serviceForm" method="POST" action="{{ route('admin.products.update', $product->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <label class="col-form-label col-sm-2" for="product">Product Id</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name='product_id' value="{{ $product->id }}"
                                        disabled>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label class="col-form-label col-sm-2" for="name">Product Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter Name" value="{{ old('name', $product->name) }}">
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
                                        placeholder="Enter Outlet Name" value="{{ old('outlet_name', $product->outlet_name) }}">
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
                                        placeholder="Enter Product description">{{ old('description', $product->description) }}</textarea>
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
                                    <input type="number" readonly class="form-control" id="quantity" name="quantity"
                                        placeholder="Enter Quantity" value="{{ old('quantity', $product->quantity) }}">
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
                                        placeholder="Enter Quantity" value="{{ old('price', $product->price) }}">
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label for="statusesq"
                                    class="col-md-2 col-form-label text-md-start">{{ __('Sale Unit') }}</label>
                                <div class="col-md-10">
                                    <select id="statusesq" class="form-select @error('selling_type') is-invalid @enderror"
                                        name="selling_type">
                                        <option value="">Select</option>
                                        <option value="plate" {{ old('selling_type', $product->selling_type) == 'plate' ? 'selected' : '' }}>
                                            Plate</option>
                                        <option value="quantity" {{ old('selling_type', $product->selling_type) == 'quantity' ? 'selected' : '' }}>
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
                                        <option value="primary" {{ old('sold_color', $product->sold_color) == 'primary' ? 'selected' : '' }}>Primary</option>
                                        <option value="secondary" {{ old('sold_color', $product->sold_color) == 'secondary' ? 'selected' : '' }}>Secondary</option>
                                        <option value="success" {{ old('sold_color', $product->sold_color) == 'success' ? 'selected' : '' }}>Success</option>
                                        <option value="danger" {{ old('sold_color', $product->sold_color) == 'danger' ? 'selected' : '' }}>Danger</option>
                                        <option value="warning" {{ old('sold_color', $product->sold_color) == 'warning' ? 'selected' : '' }}>Warning</option>
                                        <option value="info" {{ old('sold_color', $product->sold_color) == 'info' ? 'selected' : '' }}>Info</option>
                                        <option value="light" {{ old('sold_color', $product->sold_color) == 'light' ? 'selected' : '' }}>Light</option>
                                        <option value="dark" {{ old('sold_color', $product->sold_color) == 'dark' ? 'selected' : '' }}>Dark</option>
                                        <option value="link" {{ old('sold_color', $product->sold_color) == 'link' ? 'selected' : '' }}>Link</option>
                                    </select>
                                    @error('sold_color')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label for="statuses"
                                    class="col-md-2 col-form-label text-md-start">{{ __('Status') }}</label>
                                <div class="col-md-10">
                                    <select id="statuses" class="form-select @error('status') is-invalid @enderror"
                                        name="status">
                                        <option value="">Select Status</option>
                                        <option value="1" {{ old('status', $product->status) == '1' ? 'selected' : '' }}>
                                            Enable</option>
                                        <option value="0"  {{ old('status', $product->status) == '0' ? 'selected' : '' }} >
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
                                    <span class="uploaded-gallery">
                                        @foreach ($product->images as $image)
                                            <span class="image-container"><img class="image"
                                                    src="{{ asset('storage/uploads/products/' . $product->id . '/images' . '/' . $image->name) }}"
                                                    width="150px" height="100px" class="me-2 mt-2 mb-2 border">
                                                <div class="image-delete-button">
                                                    <a href="{{ asset('storage/uploads/products/' . $product->id . '/images' . '/' . $image->name) }}" download="{{ $image->name }}" class="btn btn-sm btn-dark"><i class="uil-image-download"></i> </a>
                                                    <a href="javascript:void(0);" onclick="confirmDeleteImage({{ $image->id }})" class="btn btn-sm btn-danger"><i class="uil-trash-alt"></i></a>

                                                </div>
                                            </span>
                                        @endforeach
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label class="col-form-label col-sm-2" for="unit">Product Unit</label>
                                <div class="col-sm-10">
                                    <select class="form-select @error('unit_id') is-invalid @enderror" id="unit_id" name="unit_id">
                                        <option value="">Select Unit</option>
                                        @foreach($units as $unit)
                                            <option value="{{ $unit->id }}" {{ (old('unit_id', $product->unit_id) == $unit->id) ? 'selected' : '' }}>
                                                {{ $unit->name }} ({{ $unit->abbreviation }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('unit_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label class="col-md-2 col-form-label text-md-start">Product Availability</label>
                                <div class="col-md-10">
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="warehouse_inventory" 
                                            name="warehouse_inventory" value="1" 
                                            {{ old('warehouse_inventory', $product->warehouse_inventory) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="warehouse_inventory">Available for warehouse inventory</label>
                                    </div>
                                    
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="franchise_sale" 
                                            name="franchise_sale" value="1" 
                                            {{ old('franchise_sale', $product->franchise_sale) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="franchise_sale">Available for sale to Franchise</label>
                                    </div>
                                    
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customer_sale" 
                                            name="customer_sale" value="1" 
                                            {{ old('customer_sale', $product->customer_sale) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="customer_sale">Available for sale to Customer</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label class="col-form-label col-sm-2" for="threshold">Threshold</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control @error('threshold') is-invalid @enderror" 
                                        id="threshold" name="threshold" min="0"
                                        placeholder="Enter minimum stock threshold" 
                                        value="{{ old('threshold', $product->threshold) }}">
                                    <small class="form-text text-muted">
                                        Set minimum stock level for notifications
                                    </small>
                                    @error('threshold')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary me-1"><i
                                    class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                            <button type="submit" class="btn btn-sm btn-danger" form="serviceForm"><i
                                    class="mdi mdi-database me-1"></i>Update</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div> <!-- container -->
    @foreach ($product->images as $image)
    <form id='delete-image-form{{ $image->id }}'
        action='{{ route('admin.products.delete-image', $image->id) }}'
        method='POST'>
        <input type='hidden' name='_token'
            value='{{ csrf_token() }}'>
        <input type='hidden' name='_method' value='DELETE'>
    </form>
    @endforeach
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
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
         function confirmDeleteImage(e) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Delete it!"
            }).then(t => {
                t.isConfirmed && document.getElementById("delete-image-form" + e).submit()
            })
        }
    </script>
    <script>
        function confirmDeleteDocument(e) {
           Swal.fire({
               title: "Are you sure?",
               text: "You won't be able to revert this!",
               icon: "warning",
               showCancelButton: !0,
               confirmButtonColor: "#3085d6",
               cancelButtonColor: "#d33",
               confirmButtonText: "Yes, Delete it!"
           }).then(t => {
               t.isConfirmed && document.getElementById("delete-document-form" + e).submit()
           })
       }
   </script>
@endpush
