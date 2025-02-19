@extends('layouts.chef')
@section('title', 'Create Purchase Order')
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
                                class="mdi mdi-database me-1"></i>Save</button>
                    </div>
                    <h4 class="page-title">Create Sale Order</h4>
                </div>
            </div>
        </div>
        @include('chef.includes.flash-message')
        <!-- end page title -->
        <div class="row">
            <form id="serviceForm" method="POST" action="{{ route('chef.order.sales.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <input type="hidden" name="product_id" value="{{ $order->product->id }}">
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <label for="product_name"
                                    class="col-md-3 col-form-label text-md-start">{{ __('Product Name') }}</label>

                                <div class="col-md-9">
                                    <input id="product_name" type="text"
                                        class="form-control @error('product_name') is-invalid @enderror" name="product_name"
                                        placeholder="Enter Product Name"
                                        value="{{ old('product_name', $order->product->name) }}" readonly>

                                    @error('product_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
               
                            <div class="row mb-2">
                                <label for="quantity" class="col-md-3 col-form-label text-md-start">{{ __('Quantity') }}</label>
                                <label for="quantity" class="col-md-4 col-form-label text-md-start">Avilable Order {{ __('Quantity') }} : {{ $order->stock }} from total Quantitty {{ $order->quantity }}</label>
                                <label for="quantity" class="col-md-4 col-form-label text-md-start">Product Price : {{ $order->product->price }}</label>
                                <div class="col-md-3">Sold Quantity</div>
                                <div class="col-md-9">
                                    <input id="quantity" type="number"
                                        class="form-control @error('quantity') is-invalid @enderror" name="quantity"
                                        placeholder="Enter Model Number" min="1" max="{{ $order->stock }}" 
                                        value="{{ old('quantity', 1) }}">

                                    @error('quantity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label for="statuses" class="col-md-3 col-form-label text-md-start">{{ __('Status') }}</label>
                                <div class="col-md-9">
                                    <select id="statuses" class="form-select @error('contact') is-invalid @enderror"
                                        name="status">
                                        <option value="">Select Status</option>
                                        <option value="Sold" {{ old('status') == 'Sold' ? 'selected' : '' }}>Sold</option>
                                        <option value="Wastage" {{ old('status') == 'Wastage' ? 'selected' : '' }}>Wastage</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <div class="row mb-2 text-end">
                                <div class="col-md-12">
                                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary me-1"><i
                                            class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                                    <button type="submit" class="btn btn-sm btn-danger" form="serviceForm"><i
                                            class="mdi mdi-database me-1"></i>Save</button>
                                </div>
                            </div>
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
            $('#order_date').datepicker({
                startDate: new Date(),
                format: "yyyy-mm-dd",
                autoclose: true
            });
        });
    </script>
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
                                .css('height', '100px').attr('class', 'me-2 mt-2 mb-2 border text-center py-4').text(input.files[i].name).appendTo(
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
