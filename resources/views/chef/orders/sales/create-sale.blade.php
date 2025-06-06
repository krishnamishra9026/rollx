@extends('layouts.chef')
@section('title', 'Create Purchase Order')
@section('content')
    <!-- Start Content-->
    <style type="text/css">
        
        input[type="checkbox"]:checked + label {
            width: 60px; 
        }

        input[type="checkbox"]:not(:checked) + label {
            width: 80px; 
        }

    </style>
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
                                <label for="order_id" class="col-md-3 col-form-label text-md-start">{{ __('Order') }}</label>
                                <div class="col-md-9">
                                    <select name="order_id" id="order_id" class="form-select" data-toggle=select2>
                                        <option value="">Select Order</option>
                                        @foreach ($orders as $order)
                                            <option value="{{ $order->id }}"> Order #{{ $order->id }}</option>
                                        @endforeach
                                    </select>

                                    @error('order_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
               
                            <div class="row mb-2">
                                
                                <div class="col-md-3">Sold Quantity</div>
                                <div class="col-md-9">
                                    <input id="quantity" type="number"
                                        class="form-control @error('quantity') is-invalid @enderror" name="quantity"
                                        placeholder="Enter Model Number" min="1"
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

                                    <input type="hidden" name="status" value="Wastage">

                                    <input type="checkbox" id="switch" checked data-switch="success" value="Sold" name="status" class="status" />
                                    <label for="switch" data-on-label="Sold"  data-off-label="Wastage"></label>
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
