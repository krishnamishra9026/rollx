@extends('layouts.admin')
@section('title', 'Edit Purchase Order')
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
                    <h4 class="page-title">Edit Purchase Order</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <!-- end page title -->
        <div class="row">
            <form id="serviceForm" method="POST" action="{{ route('admin.purchase-orders.update', $purchase_order->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <label for="project_reference"
                                    class="col-md-3 col-form-label text-md-start">{{ __('Project Reference') }}</label>

                                <div class="col-md-9">
                                    <input id="project_reference" type="text"
                                        class="form-control @error('project_reference') is-invalid @enderror"
                                        name="project_reference" placeholder="Enter Project Reference"
                                        value="{{ old('project_reference', $purchase_order->project_reference) }}"
                                        autofocus>

                                    @error('project_reference')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="model_number"
                                    class="col-md-3 col-form-label text-md-start">{{ __('Model Number') }}</label>

                                <div class="col-md-9">
                                    <input id="model_number" type="text"
                                        class="form-control @error('model_number') is-invalid @enderror" name="model_number"
                                        placeholder="Enter Model Number"
                                        value="{{ old('model_number', $purchase_order->model_number) }}">

                                    @error('model_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="quantity"
                                    class="col-md-3 col-form-label text-md-start">{{ __('Quantity') }}</label>

                                <div class="col-md-9">
                                    <input id="quantity" type="number"
                                        class="form-control @error('quantity') is-invalid @enderror" name="quantity"
                                        placeholder="Enter Model Number"
                                        value="{{ old('quantity', $purchase_order->quantity) }}">

                                    @error('quantity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="order_date"
                                    class="col-md-3 col-form-label text-md-start">{{ __('Order Date') }}</label>

                                <div class="col-md-9">
                                    <input id="order_date" type="text"
                                        class="form-control @error('order_date') is-invalid @enderror" name="order_date"
                                        placeholder="Enter Order Date"
                                        value="{{ old('order_date', $purchase_order->order_date) }}">

                                    @error('order_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="due"
                                    class="col-md-3 col-form-label text-md-start">{{ __('Due Date') }}</label>

                                <div class="col-md-9">
                                    <select name="due_date" id="due_date" class="form-select">
                                        <option value="">Select Due Date</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}"
                                                {{ old('due_date', $purchase_order->due_date) == $i ? 'selected' : '' }}>
                                                {{ $i }} {{ $i > 1 ? 'Weeks' : 'Week' }}</option>
                                        @endfor
                                    </select>

                                    @error('due_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="remarks"
                                    class="col-md-3 col-form-label text-md-start">{{ __('Order Remarks') }}</label>

                                <div class="col-md-9">
                                    <textarea name="remarks" class="form-control @error('remarks') is-invalid @enderror" id="remarks" rows="3"
                                        placeholder="Enter Order Remarks">{{ old('remarks', $purchase_order->remarks) }}</textarea>
                                    @error('remarks')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label class="col-md-3 col-form-label text-md-start">{{ __('Images') }}</label>
                                <div class="col-md-9">
                                    <input id="images" type="file"
                                        class="form-control @error('images') is-invalid @enderror" name="images[]" multiple
                                        style="display: none">
                                    <label class="border mb-2 me-1" for="images">
                                        <img src="{{ asset('assets/images/image-placeholder.png') }}"></label>
                                    <span class="gallery">
                                        @foreach ($purchase_order->images as $image)
                                            <img src="{{ asset('storage/uploads/purchase-orders/' . $purchase_order->id . '/images' . '/' . $image->name) }}"
                                                width="150px" height="100px" class="me-2 mt-2 mb-2 border">
                                        @endforeach
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label class="col-md-3 col-form-label text-md-start">{{ __('Documents') }}</label>
                                <div class="col-md-9">
                                    <input id="documents" type="file"
                                        class="form-control @error('documents') is-invalid @enderror" name="documents[]"
                                        multiple style="display: none">
                                    <label class="border mb-2" for="documents">
                                        <img src="{{ asset('assets/images/document-placeholder.png') }}"></label>
                                    <span class="document-list d-flex">
                                        @foreach ($purchase_order->documents as $document)
                                            <span class="me-2 mt-2 mb-2 border text-center py-4"
                                                style="width: 150px; height: 100px;"><a
                                                    href="{{ asset('storage/uploads/purchase-orders/' . $purchase_order->id . '/documents' . '/' . $document->name) }}"
                                                    download="">{{ $document->name }}</a></span>
                                        @endforeach
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row mb-2 text-end">
                                <div class="col-md-12">
                                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary me-1"><i
                                            class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                                    <button type="submit" class="btn btn-sm btn-danger" form="serviceForm"><i
                                            class="mdi mdi-database me-1"></i>Update</button>
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
