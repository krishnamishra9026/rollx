@extends('layouts.admin')
@section('title', 'Edit Order')
@section('head')
    <link href="{{ asset('assets/js/plugins/intl-tel-input/css/intlTelInput.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">

                          @if(session()->has('route'))
                               <a href="{{  session()->get('route') }}" class="btn btn-sm btn-primary me-1"><i
                                    class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                          @else
                             <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-primary me-1"><i
                                class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                        @endif
                        <button type="submit" class="btn btn-sm btn-danger" form="orderForm"><i
                                class="mdi mdi-database me-1"></i>Save</button>
                    </div>
                    <h4 class="page-title">Edit Equipment Order</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <form id="orderForm" method="POST" action="{{ route('admin.orders.update', $order->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <ul class="nav nav-tabs nav-bordered mb-3">
                                        <li class="nav-item">
                                            <a href="{{ route('admin.orders.edit', $order->id) }}"
                                                class="nav-link active">
                                                <span>Order Info</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('admin.orders.equipment-info', $order->id) }}"
                                            class="nav-link">
                                                <span>Equipment Info</span>
                                            </a>
                                        </li>

                                       <li class="nav-item">
                                            <a href="{{ route('admin.orders.createPart', $order->id) }}"
                                            class="nav-link">
                                                <span>Add Part</span>
                                            </a>
                                      </li>
                                    </ul>

                                    <div class="tab-content">
                                        <div class="tab-pane show active" id="order-info-tab">
                                            <div class="row mb-2">
                                                <label for="equipment_assemble_type"
                                                    class="col-md-3 col-form-label text-md-start">{{ __('Equipment Assemble Type') }}</label>
                                                <div class="col-md-9">
                                                    <select id="equipment_assemble_type"
                                                        class="form-select @error('equipment_assemble_type') is-invalid @enderror"
                                                        name="equipment_assemble_type">
                                                        <option value="inventory"
                                                            {{ old('equipment_assemble_type', $order->equipment_assemble_type) == 'inventory' ? 'selected' : '' }}>
                                                            Fully assembled equipment</option>
                                                        <option value="supplier"
                                                            {{ old('equipment_assemble_type', $order->equipment_assemble_type) == 'supplier' ? 'selected' : '' }}>
                                                            Customize part</option>
                                                    </select>
                                                    @error('equipment_assemble_type')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <label for="project_name"
                                                    class="col-md-3 col-form-label text-md-start">{{ __('Project Name') }}</label>

                                                <div class="col-md-9">
                                                    <input id="project_name" type="text"
                                                        class="form-control @error('project_name') is-invalid @enderror"
                                                        name="project_name" placeholder="Enter Project name"
                                                        value="{{ old('project_name', $order->project_name) }}" autofocus>

                                                    @error('project_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <label for="customer"
                                                    class="col-md-3 col-form-label text-md-start">{{ __('Customer / Company') }}</label>

                                                <div class="col-md-9">
                                                    <select name="customer" id="customer" class="form-select"
                                                        data-toggle=select2 onchange="getCustomerAddresses()">
                                                        <option value="">Choose Customer / Company</option>
                                                        @foreach ($customers as $customer)
                                                            <option value="{{ $customer->id }}"
                                                                {{ $customer->id == old('customer', $order->user_id) ? 'selected' : '' }}>
                                                                {{ $customer->company }}</option>
                                                        @endforeach
                                                    </select>

                                                    @error('customer')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <label for="address"
                                                    class="col-md-3 col-form-label text-md-start">{{ __('Address') }}</label>

                                                <div class="col-md-9">
                                                    <select name="address" id="address" class="form-select">
                                                        <option value="">Choose Address</option>
                                                        @foreach ($addresses as $address)
                                                            <option value="{{ $address->id }}"
                                                                {{ $address->id == old('address', $order->user_address_id) ? 'selected' : '' }}>
                                                                {{ $address->address }} {{ $address->city }} {{ $address->state }} {{ $address->country }} {{ $address->zipcode }}</option>
                                                        @endforeach
                                                    </select>

                                                    @error('address')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <label for="date"
                                                    class="col-md-3 col-form-label text-md-start">{{ __('Order Date') }}</label>

                                                <div class="col-md-9">
                                                    <input id="date" type="text"
                                                        class="form-control @error('date') is-invalid @enderror" name="date"
                                                        placeholder="Enter Order Date" value="{{ old('date', \Carbon\Carbon::parse($order->date)->format("d-m-Y")) }}">
                                                    @error('date')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <label for="order_delivery_upto"
                                                    class="col-md-3 col-form-label text-md-start">{{ __('Order Delivery upto') }}</label>

                                                    <div class="col-md-9">
                                                        <select name="order_delivery_upto" id="order_delivery_upto" class="form-select">
                                                            <option value="">Choose Delivery Upto</option>
                                                            <option value="1" {{ old('order_delivery_upto', $order->order_delivery_upto) == "1" ? "selected" : "" }}>1 Week</option>
                                                            <option value="2" {{ old('order_delivery_upto', $order->order_delivery_upto) == "2" ? "selected" : "" }}>2 Weeks</option>
                                                            <option value="3" {{ old('order_delivery_upto', $order->order_delivery_upto) == "3" ? "selected" : "" }}>3 Weeks</option>
                                                            <option value="4" {{ old('order_delivery_upto', $order->order_delivery_upto) == "4" ? "selected" : "" }}>4 Weeks</option>
                                                            <option value="5" {{ old('order_delivery_upto', $order->order_delivery_upto) == "5" ? "selected" : "" }}>5 Weeks</option>
                                                            <option value="6" {{ old('order_delivery_upto', $order->order_delivery_upto) == "6" ? "selected" : "" }}>6 Weeks</option>
                                                            <option value="7" {{ old('order_delivery_upto', $order->order_delivery_upto) == "7" ? "selected" : "" }}>7 Weeks</option>
                                                            <option value="8" {{ old('order_delivery_upto', $order->order_delivery_upto) == "8" ? "selected" : "" }}>8 Weeks</option>
                                                            <option value="10" {{ old('order_delivery_upto', $order->order_delivery_upto) == "10" ? "selected" : "" }}>10 Weeks</option>
                                                            <option value="12" {{ old('order_delivery_upto', $order->order_delivery_upto) == "12" ? "selected" : "" }}>12 Weeks</option>
                                                            <option value="14" {{ old('order_delivery_upto', $order->order_delivery_upto) == "14" ? "selected" : "" }}>14 Weeks</option>
                                                            <option value="16" {{ old('order_delivery_upto', $order->order_delivery_upto) == "16" ? "selected" : "" }}>16 Weeks</option>
                                                            <option value="20" {{ old('order_delivery_upto', $order->order_delivery_upto) == "20" ? "selected" : "" }}>20 Weeks</option>

                                                        </select>

                                                        @error('order_delivery_upto')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                            </div>
                                             <div class="row mb-2">
                                                <label for="quotation_refrence"
                                                    class="col-md-3 col-form-label text-md-start">{{ __('Quotation Reference') }}</label>

                                                <div class="col-md-9">
                                                    <input  type="text"
                                                        class="form-control @error('quotation_reference') is-invalid @enderror" name="quotation_reference"
                                                        placeholder="Enter Quotation Reference" value="{{ old('quotation_reference',$order->quotation_reference) }}">
                                                    @error('quotation_reference')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <label for="description"
                                                    class="col-md-3 col-form-label text-md-start">{{ __('Description') }}</label>

                                                <div class="col-md-9">
                                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description"
                                                        rows="3" placeholder="Enter Order Decription">{{ old('description', $order->description) }}</textarea>
                                                    @error('description')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <label
                                                    class="col-md-3 col-form-label text-md-start">{{ __('Images') }}</label>
                                                <div class="col-md-9">
                                                    <input id="images" type="file"
                                                        class="form-control @error('images') is-invalid @enderror"
                                                        name="images[]" multiple style="display: none">
                                                    <label class="border mb-2 me-1" for="images">
                                                        <img src="{{ asset('assets/images/image-placeholder.png') }}"></label>
                                                    <span class="gallery">

                                                    </span>
                                                    <span class="uploaded-gallery">
                                                        @foreach($order->images as  $image)
                                                        <span class="image-container">
                                                            <img class="image" src="{{ asset('storage/uploads/orders/'.$order->id.'/images'.'/'.$image->name) }}" width="150px" height="100px" class="me-2 mt-2 mb-2 border">
                                                            <div class="image-delete-button">
                                                                <a href="{{ asset('storage/uploads/orders/'.$order->id.'/images'.'/'.$image->name) }}" download="{{ $image->name }}" class="btn btn-sm btn-dark"><i class="uil-image-download"></i> </a>
                                                                <a href="javascript:void(0);" onclick="confirmDeleteImage({{ $image->id }})" class="btn btn-sm btn-danger"><i class="uil-trash-alt"></i></a>
                                                            </div>
                                                        </span>
                                                            @endforeach
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <label
                                                    class="col-md-3 col-form-label text-md-start">{{ __('Documents') }}</label>
                                                <div class="col-md-9">
                                                    <input id="documents" type="file"
                                                        class="form-control @error('documents') is-invalid @enderror"
                                                        name="documents[]" multiple style="display: none">
                                                    <label class="border mb-2" for="documents">
                                                        <img
                                                            src="{{ asset('assets/images/document-placeholder.png') }}"></label>
                                                    <span class="document-list d-flex">

                                                    </span>
                                                    <span class="uploaded-document-list d-flex">
                                                        @foreach($order->documents as  $document)
                                                            <span class="document-container me-2 mt-2 mb-2 border text-center py-4" style="width: 150px; height: 100px;">
                                                                <span class="document">{{ $document->name }}</span>
                                                                <div class="document-delete-button">
                                                                    <a href="{{ asset('storage/uploads/orders/'.$order->id.'/documents'.'/'.$document->name) }}" download="{{ $document->name }}" class="btn btn-sm btn-dark"><i class="uil-file-download-alt"></i> </a>
                                                                    <a href="javascript:void(0);" onclick="confirmDeleteDocument({{ $document->id }})" class="btn btn-sm btn-danger"><i class="uil-trash-alt"></i></a>

                                                                </div>
                                                            </span>
                                                        @endforeach
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row mb-2 text-end">
                                <div class="col-md-12">
                                @if(session()->has('route'))

                                  <a href="{{  session()->get('route') }}" class="btn btn-sm btn-primary me-1"><i
                                    class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                                @else
                                    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-primary me-1"><i
                                        class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                                @endif
                                    <button type="submit" class="btn btn-sm btn-danger" form="orderForm"><i
                                            class="mdi mdi-database me-1"></i>Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- container -->
    @foreach ($order->images as $image)
    <form id='delete-image-form{{ $image->id }}'
        action='{{ route('admin.orders.delete-image', $image->id) }}'
        method='POST'>
        <input type='hidden' name='_token'
            value='{{ csrf_token() }}'>
        <input type='hidden' name='_method' value='DELETE'>
    </form>
    @endforeach
    @foreach ($order->documents as $document)
    <form id='delete-document-form{{ $document->id }}'
        action='{{ route('admin.orders.delete-document', $document->id) }}'
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
            $('#date').datepicker({
                startDate: new Date(),
                format: "dd-mm-yyyy",
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
<script>
    function getCustomerAddresses(){
        var customer_id = $('#customer').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        var formData = {
            customer_id: customer_id,
        };

        $.ajax({
            type: "POST",
            url: "{{ route('admin.customers.get-addresses') }}",
            data: formData,
            dataType: 'json',
            success: function (data) {
                $('#address').html(data.addresses);
            },
            error: function (data) {
                console.log(data);
            }
        });
    }
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
