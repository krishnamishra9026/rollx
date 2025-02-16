@extends('layouts.admin')
@section('title', 'Edit Job')
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
                        <button type="submit" class="btn btn-sm btn-danger" form="jobForm"><i
                                class="mdi mdi-database me-1"></i>Update</button>
                    </div>
                    <h4 class="page-title">Edit Job</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <!-- end page title -->
        <div class="row">
            <form id="jobForm" method="POST" action="{{ route('admin.jobs.update', $job->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col-12">

                    <div class="card">
                        <div class="card-body">

                            <div class="row mb-2">
                                <label for="description"
                                    class="col-md-3 col-form-label text-md-start">{{ __('Job Description') }}</label>

                                <div class="col-md-9">
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description"
                                        rows="3" placeholder="Enter Job Description">{{ old('description', $job->description) }}</textarea>
                                    @error('description')
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
                                        data-toggle="select2" onchange="getCustomerAddresses();">
                                        <option value="">Choose Customer / Company</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}"
                                                {{ $customer->id == old('customer', $job->user_id) ? 'selected' : '' }}>
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
                                    <select name="address" id="address" class="form-select" onchange="getEquipmentByAddress();">
                                        <option value="">Choose Address</option>
                                        @foreach ($job->customer->addresses as $address)
                                        <option value="{{ $address->id }}"
                                            {{ $address->id == old('address', $job->user_address_id) ? 'selected' : '' }}>
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
                                <label for="equipment"
                                    class="col-md-3 col-form-label text-md-start">{{ __('Equipment') }}</label>

                                <div class="col-md-9">
                                    <select name="equipment" id="equipment" class="form-select" onchange="getSerialNumber();">
                                        <option value="">Choose Equipment</option>
                                        @foreach ($equipments as $equipment)
                                        <option value="{{ $equipment->id }}" data-serial-no="{{ $equipment->serial_number }}"
                                            {{ $equipment->id == old('equipment', $job->equipment_id) ? 'selected' : '' }}>
                                            {{ $equipment->equipment_name }}</option>
                                    @endforeach
                                    </select>

                                    @error('equipment')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label for="serial_number"
                                    class="col-md-3 col-form-label text-md-start">{{ __('Serial No.') }}</label>

                                <div class="col-md-9">
                                    <input type="text" name="serial_number" id="serial_number" class="form-control @error('serial_number') is-invalid @enderror" placeholder="Enter Serial No." value="{{ old('serial_number', $job->equipment->serial_number) }}">

                                    @error('serial_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label for="service_type"
                                    class="col-md-3 col-form-label text-md-start">{{ __('Service Type') }}</label>

                                <div class="col-md-9">
                                    <select name="service_type" id="service_type" class="form-select"
                                        data-toggle="select2">
                                        <option value="">Choose Service Type</option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}"
                                                {{ $service->id == old('service_type', $job->job_type_id) ? 'selected' : '' }}>
                                                {{ $service->type }}</option>
                                        @endforeach
                                    </select>

                                    @error('service_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label for="technician"
                                    class="col-md-3 col-form-label text-md-start">{{ __('Technician') }}</label>

                                <div class="col-md-9">
                                    <select name="technician" id="technician" class="form-select"
                                        data-toggle="select2">
                                        <option value="">Choose Technician</option>
                                        @foreach ($technicians as $technician)
                                            <option value="{{ $technician->id }}"
                                                {{ $technician->id == old('technician', $job->technician_id) ? 'selected' : '' }}>
                                                {{ $technician->firstname }} {{ $technician->lastname }}</option>
                                        @endforeach
                                    </select>

                                    @error('technician')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label for="start_date"
                                    class="col-md-3 col-form-label text-md-start">{{ __('Start Date & Time') }}</label>

                                <div class="col-md-6">
                                    <input type="text" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror" placeholder="Enter Start Date" value="{{ old('start_date', $job->start_date) }}">

                                    @error('start_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <input id="timepicker" type="time" name="start_time"
                                            placeholder="Choose Start Time"
                                            class="form-control  @error('start_time') is-invalid @enderror" value="{{ old('start_time', $job->start_time) }}">

                                    @error('start_time')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="end_date"
                                        class="col-md-3 col-form-label text-md-start">{{ __('End Date & Time') }}</label>

                                <div class="col-md-6">
                                    <input type="text" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror" placeholder="Enter End Date" value="{{ old('end_date', $job->end_date) }}">

                                    @error('end_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3"  id="timepicker-input-group2">
                                    <input id="timepicker" type="time" name="end_time"
                                            placeholder="Choose End Time"
                                            class="form-control  @error('end_time') is-invalid @enderror" value="{{ old('end_time', $job->end_time) }}">
                                    @error('end_time')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label for="refrence"
                                    class="col-md-3 col-form-label text-md-start">{{ __('Remark') }}</label>

                                <div class="col-md-9">
                                    <textarea name="remark" class="form-control @error('remark') is-invalid @enderror" id="remark"
                                        rows="3" placeholder="Enter Job remark">{{ old('remark', $job->remark) }}</textarea>
                                    @error('remark')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label for="free_of_cost"
                                    class="col-md-3 col-form-label text-md-start">{{ __('Free of Cost') }}</label>

                                <div class="col-md-9">
                                    <input type="checkbox" name="free_of_cost" id="free_of_cost" value="yes" @if($job->free_of_cost == true) checked @endif>
                                    <label for="free_of_cost">Yes</label>
                                    @error('free_of_cost')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label for="add_on_calendar"
                                    class="col-md-3 col-form-label text-md-start">{{ __('Calendar') }}</label>

                                <div class="col-md-9">
                                    <input type="checkbox" name="add_on_calendar" id="add_on_calendar" value="yes" @if($job->add_on_calendar == true) checked @endif>
                                    <label for="add_on_calendar">Add job on Calendar</label>
                                    @error('add_on_calendar')
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
                                            @foreach($job->images as  $image)
                                            <span class="image-container">
                                                <img class="image" src="{{ asset('storage/uploads/jobs/'.$job->id.'/images'.'/'.$image->name) }}" width="150px" height="100px" class="me-2 mt-2 mb-2 border">
                                                <div class="image-delete-button">
                                                    <a href="{{ asset('storage/uploads/jobs/'.$job->id.'/images'.'/'.$image->name) }}" download="{{ $image->name }}" class="btn btn-sm btn-dark mb-2"><i class="uil-image-download"></i> </a>
                                                    <a href="javascript:void(0);" onclick="confirmDeleteImage({{ $image->id }})" class="btn btn-sm btn-danger"><i class="uil-trash-alt"></i></a>
                                                </div>
                                            </span>
                                                @endforeach
                                        </span>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary me-1"><i
                                    class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                            <button type="submit" class="btn btn-sm btn-danger" form="jobForm"><i
                                    class="mdi mdi-database me-1"></i>Update</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div> <!-- container -->

    @foreach ($job->images as $image)
    <form id='delete-image-form{{ $image->id }}'
        action='{{ route('admin.jobs.delete-image', $image->id) }}'
        method='POST'>
        <input type='hidden' name='_token'
            value='{{ csrf_token() }}'>
        <input type='hidden' name='_method' value='DELETE'>
    </form>
    @endforeach


@endsection
@push('scripts')
<script>
    $(function(){
            $('#start_date').datepicker({
                startDate: new Date(),
                format: "yyyy-mm-dd",
                autoclose: true
            });
            $('#end_date').datepicker({
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
        <script>

            function getEquipmentByAddress(){
                var address_id = $('#address').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                var formData = {
                    address_id: address_id,
                };

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.address.get-equipments') }}",
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        $('#equipment').html(data.equipments);
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            }
        </script>
<script>
    function getSerialNumber(){

        var equipment_serial_no  = $('#equipment').find(':selected').data('serial-no');
        $('#serial_number').val(equipment_serial_no);
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
@endpush
