@extends('layouts.admin')
@section('title', 'Edit Equipment')
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
                    <h4 class="page-title">Edit Equipment</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <!-- end page title -->

    </div> <!-- container -->

    <div class="row">
        <form id="serviceForm" method="POST" action="{{ route('admin.equipments.update', $equipment->id) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <label for="serial_number"
                                class="col-md-3 col-form-label text-md-start">{{ __('Serial Number') }}</label>

                            <div class="col-md-9">
                                <input id="serial_number" type="text"
                                    class="form-control @error('serial_number') is-invalid @enderror" name="serial_number"
                                    placeholder="Enter Serial Number"
                                    value="{{ old('serial_number', $equipment->serial_number) }}" autofocus>

                                @error('serial_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="equipment_name"
                                class="col-md-3 col-form-label text-md-start">{{ __('Model Number') }}</label>

                            <div class="col-md-9">
                                <input id="equipment_name" type="text"
                                    class="form-control @error('equipment_name') is-invalid @enderror" name="equipment_name"
                                    placeholder="Enter Equipment name"
                                    value="{{ old('equipment_name', $equipment->equipment_name) }}" autofocus>

                                @error('equipment_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-2">
                            <label for="equipment_assemble_type"
                                class="col-md-3 col-form-label text-md-start">{{ __('Equipment Assemble Type') }}</label>
                            <div class="col-md-9">
                                <select id="equipment_assemble_type"
                                    class="form-select @error('equipment_assemble_type') is-invalid @enderror"
                                    name="equipment_assemble_type">
                                    <option value="">Choose Equipment Assemble Type</option>
                                    <option value="inventory"
                                        {{ old('equipment_assemble_type', $equipment->equipment_assemble_type) == 'inventory' ? 'selected' : '' }}>
                                        Assemble using parts from own inventory</option>
                                    <option value="supplier"
                                        {{ old('equipment_assemble_type', $equipment->equipment_assemble_type) == 'supplier' ? 'selected' : '' }}>
                                        Assemble by ordering from supplier</option>
                                </select>
                                @error('equipment_assemble_type')
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
                                <select name="customer" id="customer" class="form-select" data-toggle=select2
                                    onchange="getCustomerAddresses()">
                                    <option value="">Choose Customer / Company</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}"
                                            {{ $customer->id == old('customer', $equipment->user_id) ? 'selected' : '' }}>
                                            {{ $customer->name }}</option>
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
                            <label for="address" class="col-md-3 col-form-label text-md-start">{{ __('Address') }}</label>

                            <div class="col-md-9">
                                <select name="address" id="address" class="form-select">
                                    <option value="">Choose Address</option>
                                    @foreach ($addresses as $address)
                                        <option value="{{ $address->id }}"
                                            {{ $address->id == old('address', $equipment->user_address_id) ? 'selected' : '' }}>
                                            {{ $address->address }} {{ $address->city }} {{ $address->state }}
                                            {{ $address->country }} {{ $address->zipcode }}</option>
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
                            <label for="installation_date"
                                class="col-md-3 col-form-label text-md-start">{{ __('Installation Date') }}</label>

                            <div class="col-md-9">
                                <input id="installation_date" type="text"
                                    class="form-control @error('installation_date') is-invalid @enderror"
                                    name="installation_date" placeholder="Choose Installation Date"
                                    value="{{ old('installation_date', $equipment->installation_date) }}">
                                @error('installation_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                        <label for="warranty_range"
                            class="col-md-3 col-form-label text-md-start">{{ __('Warranty Range') }}</label>

                        <div class="col-md-6">
                            <select class="form-select" name="warranty_upto" id="warranty_range" onchange="showCustomDate(this.value);">
                                <option value="" selected>Choose Warranty Range</option>
                                <option value="1" {{ old('warranty_upto', $equipment->warranty_upto) == "1" ? "selected" : "" }}>1 Week</option>
                                <option value="2" {{ old('warranty_upto', $equipment->warranty_upto) == "2" ? "selected" : "" }}>2 Weeks</option>
                                <option value="3" {{ old('warranty_upto', $equipment->warranty_upto) == "3" ? "selected" : "" }}>3 Weeks</option>
                                <option value="6" {{ old('warranty_upto', $equipment->warranty_upto) == "6" ? "selected" : "" }}>6 Weeks</option>
                                <option value="12" {{ old('warranty_upto', $equipment->warranty_upto) == "12" ? "selected" : "" }}>12 Weeks</option>
                                <option value="18" {{ old('warranty_upto', $equipment->warranty_upto) == "18" ? "selected" : "" }}>18 Weeks</option>
                                <option value="24" {{ old('warranty_upto', $equipment->warranty_upto) == "24" ? "selected" : "" }}>24 Weeks</option>
                                <option value="38" {{ old('warranty_upto', $equipment->warranty_upto) == "38" ? "selected" : "" }}>38 Weeks</option>
                                <option value="custom" {{ old('warranty_upto', $equipment->warranty_upto) == "custom" ? "selected" : "" }}>Custom</option>
                            </select>
                            @error('warranty_upto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-3" id="warranty_date" style="display:none;">
                            <input  type="text"
                                class="form-control @error('warranty_date') is-invalid @enderror"
                                name="warranty_date" id="warranty_dates" placeholder="Choose warranty Date"
                                value="{{ old('warranty_date',$equipment->warranty_date) }}">
                        </div>
                    </div>

                                       
                        <div class="row mb-2">
                            <label for="service_contract"
                                class="col-md-3 col-form-label text-md-start">{{ __('Service Contract') }}</label>
                            <div class="col-md-9">
                                <select id="service_contract"
                                    class="form-select @error('service_contract') is-invalid @enderror"
                                    name="service_contract" onchange="serviceContractfunc()">
                                    <option value="">Choose Service Contract</option>
                                    <option value="1"
                                        {{ old('service_contract', $equipment->service_contract) == '1' ? 'selected' : '' }}>
                                        Yes</option>
                                    <option value="0"
                                        {{ old('service_contract', $equipment->service_contract) == '0' ? 'selected' : '' }}>
                                        No</option>
                                </select>
                                @error('service_contract')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2" id="service_contract_row">
                            <label for="service_start_date"
                                class="col-md-3 col-form-label text-md-start">{{ __('Service Start Date') }}</label>
                            <div class="col-md-4">
                                <input id="service_start_date" type="text"
                                    class="form-control @error('service_start_date') is-invalid @enderror"
                                    name="service_start_date" placeholder="Choose Service Start Date"
                                    value="{{ old('service_start_date', $equipment->service_start_date) }}">
                                @error('service_start_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <select name="service_interval" id="service_interval" class="form-select">
                                    <option value="">Choose Delivery Upto</option>
                                    <option value="1"
                                        {{ old('service_interval', $equipment->service_interval) == '1' ? 'selected' : '' }}>
                                        1 Month</option>
                                    <option value="3"
                                        {{ old('service_interval', $equipment->service_interval) == '3' ? 'selected' : '' }}>
                                        3 Months</option>
                                    <option value="6"
                                        {{ old('service_interval', $equipment->service_interval) == '6' ? 'selected' : '' }}>
                                        6 Months</option>
                                    <option value="9"
                                        {{ old('service_interval', $equipment->service_interval) == '9' ? 'selected' : '' }}>
                                        9 Months</option>
                                    <option value="12"
                                        {{ old('service_interval', $equipment->service_interval) == '12' ? 'selected' : '' }}>
                                        12 Months</option>
                                </select>

                                @error('service_interval')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="statuses"
                                class="col-md-3 col-form-label text-md-start">{{ __('Status') }}</label>
                            <div class="col-md-9">
                                <select id="statuses" class="form-select @error('contact') is-invalid @enderror"
                                    name="status">
                                    <option value="">Select Status</option>
                                    <option value="1"
                                        {{ old('status', $equipment->status) == '1' ? 'selected' : '' }}>
                                        Enable</option>
                                    <option value="0"
                                        {{ old('status', $equipment->status) == '0' ? 'selected' : '' }}>
                                        Disable</option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ url()->previous() }} " class="btn btn-sm btn-primary me-1"><i
                                class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                        <button type="submit" class="btn btn-sm btn-danger" form="serviceForm"><i
                                class="mdi mdi-database me-1"></i>Update</button>
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection
@push('scripts')
    <script>
        function serviceContractfunc() {
            var service_contract = $('#service_contract').val();
            switch (service_contract) {
                case '1':
                    $('#service_contract_row').show();
                    break;
                case '0':
                    $('#service_contract_row').hide();
                    break;
                default:
                    $('#service_contract_row').hide();
                    break;
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            serviceContractfunc();
        });
    </script>
    <script>
        function getCustomerAddresses() {
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
                success: function(data) {
                    $('#address').html(data.addresses);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }
    </script>
    <script>
        $(function() {
            $('#installation_date').datepicker({
                startDate: new Date(),
                format: "yyyy-mm-dd",
                autoclose: true
            });
        });
    </script>

    <script>
        $(function() {
            $('#warranty_dates').datepicker({
                startDate: new Date(),
                format: "yyyy-mm-dd",
                autoclose: true
            });
        });
    </script>
    <script>
        $(function() {
            $('#service_start_date').datepicker({
                startDate: new Date(),
                format: "yyyy-mm-dd",
                autoclose: true
            });
        });
    </script>

     <script>
    $(document).ready(function(){
         var custom= $("#warranty_range").val();
          showCustomDate(custom);
    })
    
    function showCustomDate(custom){

        if(custom == 'custom') {
            
            var element = document.getElementById('warranty_date');
            element.style.display = ''; 
              
        }else{
            $('#warranty_date').hide();
        }
    }
    </script>
@endpush
