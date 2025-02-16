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
                               <a href="{{ route('admin.purchase-orders.edit', $order->id) }}" class="btn btn-sm btn-primary me-1"><i
                                    class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                          @else
                              <a href="{{ route('admin.purchase-orders.edit', $order->id) }}" class="btn btn-sm btn-primary me-1"><i
                                class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                        @endif
                        <button type="submit" class="btn btn-sm btn-danger" form="orderForm"><i
                                class="mdi mdi-database me-1"></i>Save</button>
                    </div>
                    <h4 class="page-title">Edit Purchase Order</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <ul class="nav nav-tabs nav-bordered mb-3">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.purchase-orders.edit', $order->id) }}" class="nav-link">
                                            <span>Order Info</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.purchase-orders.equipment-info', $order->id) }}"
                                            class="nav-link active">
                                            <span>Equipment Info</span>
                                        </a>
                                    </li>
                                     <li class="nav-item">
                                                <a href="{{ route('admin.purchase-orders.createPart', $order->id) }}"
                                                class="nav-link">
                                                    <span>Add Part</span>
                                                </a>
                                    </li>
                                </ul>
    
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="order-info-tab">
                                        <form id="orderForm" method="POST"
                                            action="{{ route('admin.purchase-orders.save-equipment-info', $order->id) }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            {{-- <div class="row mb-2">
                                                <label for="serial_number"
                                                    class="col-md-3 col-form-label text-md-start">{{ __('Serial Number') }}</label>
    
                                                <div class="col-md-9">
                                                    <input id="serial_number" type="text"
                                                        class="form-control @error('serial_number') is-invalid @enderror"
                                                        name="serial_number" placeholder="Enter Serial Number"
                                                        value="{{ old('serial_number', $order->serial_number) }}" autofocus>
    
                                                    @error('serial_number')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div> --}}
                                            <div class="row mb-2">
                                                <label for="equipment_name"
                                                    class="col-md-3 col-form-label text-md-start">{{ __('Equipment Model') }}</label>
    
                                                <div class="col-md-9">
                                                    <input id="equipment_name" type="text"
                                                        class="form-control @error('equipment_name') is-invalid @enderror"
                                                        name="equipment_name" placeholder="Enter Equipment Model"
                                                        value="{{ old('equipment_name', $order->equipment_name) }}" autofocus>
    
                                                    @error('equipment_name')
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
                                                        value="{{ old('installation_date', $order->installation_date) }}">
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
                                                        {{-- <option value="1" {{ old('warranty_upto', $order->warranty_upto) == "1" ? "selected" : "" }}>1 Week</option>
                                                        <option value="2" {{ old('warranty_upto', $order->warranty_upto) == "2" ? "selected" : "" }}>2 Weeks</option>
                                                        <option value="3" {{ old('warranty_upto', $order->warranty_upto) == "3" ? "selected" : "" }}>3 Weeks</option>
                                                        <option value="6" {{ old('warranty_upto', $order->warranty_upto) == "6" ? "selected" : "" }}>6 Weeks</option> --}}
                                                        <option value="12" {{ old('warranty_upto', $order->warranty_upto) == "12" ? "selected" : "" }}>12 Months</option>
                                                        <option value="18" {{ old('warranty_upto', $order->warranty_upto) == "18" ? "selected" : "" }}>18 Months</option>
                                                        <option value="24" {{ old('warranty_upto', $order->warranty_upto) == "24" ? "selected" : "" }}>24 Months</option>
                                                        <option value="36" {{ old('warranty_upto', $order->warranty_upto) == "36" ? "selected" : "" }}>36 Months</option>
                                                        <option value="custom" {{ old('warranty_upto', $order->warranty_upto) == "custom" ? "selected" : "" }}>Custom</option>
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
                                                        value="{{ old('warranty_date',$order->warranty_date) }}">
                                                </div>
                                            </div>
    
                                            <div class="row mb-2">
                                                <label for="service_contract" class="col-md-3 col-form-label text-md-start">{{ __('Service Contract') }}</label>
                                                <div class="col-md-9">
                                                    <select id="service_contract" class="form-select @error('service_contract') is-invalid @enderror"
                                                        name="service_contract" onchange="serviceContractfunc()">
                                                        <option value="">Choose Service Contract</option>
                                                        <option value="1" {{ old('service_contract', $order->service_contract) == '1' ? 'selected' : '' }}>
                                                            Yes</option>
                                                        <option value="0" {{ old('service_contract', $order->service_contract) == '0' ? 'selected' : '' }}>
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
                                                <label for="service_start_date" class="col-md-3 col-form-label text-md-start">{{ __('Service Start Date') }}</label>
                                                <div class="col-md-4">
                                                    <input id="service_start_date" type="text"
                                                        class="form-control @error('service_start_date') is-invalid @enderror"
                                                        name="service_start_date" placeholder="Choose Service Start Date"
                                                        value="{{ old('service_start_date', $order->service_start_date) }}">
                                                    @error('service_start_date')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-5">
                                                    <select name="service_interval" id="service_interval" class="form-select">
                                                        <option value="">Choose Delivery Upto</option>
                                                        <option value="1" {{ old('service_interval', $order->service_interval) == "1" ? "selected" : "" }}>1 Month</option>
                                                        <option value="3" {{ old('service_interval', $order->service_interval) == "3" ? "selected" : "" }}>3 Months</option>
                                                        <option value="6" {{ old('service_interval', $order->service_interval) == "6" ? "selected" : "" }}>6 Months</option>
                                                        <option value="9" {{ old('service_interval', $order->service_interval) == "9" ? "selected" : "" }}>9 Months</option>
                                                        <option value="12" {{ old('service_interval', $order->service_interval) == "12" ? "selected" : "" }}>12 Months</option>
                                                    </select>
    
                                                    @error('service_interval')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- <div class="row mb-2">
                                                <label for="quotation_refrence"
                                                    class="col-md-3 col-form-label text-md-start">{{ __('Quotation Reference') }}</label>
    
                                                <div class="col-md-9">
                                                    <input  type="text"
                                                        class="form-control @error('quotation_reference') is-invalid @enderror" name="quotation_reference"
                                                        placeholder="Enter Quotation Reference" value="{{ old('quotation_reference', $order->quotation_reference) }}">
                                                    @error('quotation_reference')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div> --}}
                                            <div class="row mb-2">
                                                <label for="remarks"
                                                    class="col-md-3 col-form-label text-md-start">{{ __('Remarks') }}</label>
    
                                                <div class="col-md-9">
                                                    <input  type="text"
                                                        class="form-control @error('remarks') is-invalid @enderror" name="remarks"
                                                        placeholder="Enter Remarks" value="{{ old('remarks', $order->remarks) }}">
                                                    @error('remarks')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </form>
                                        <div class="row mb-2">
                                            <div class="col-md-12 text-end">
                                                <button type="submit" class="btn btn-sm btn-danger" form="orderForm"><i
                                                        class="mdi mdi-database"></i>Save</button>
                                            </div>
                                        </div>
                                        
                                        {{-- @include('admin.orders.edit.parts') --}}
                                        {{-- @include('admin.orders.edit.add-parts') --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="card-footer">
                        <div class="row mb-2 text-end">
                            <div class="col-md-12">
    
                                @if(session()->has('route'))
                                   <a href="{{  session()->get('route') }}" class="btn btn-sm btn-primary me-1"><i
                                        class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                              @else
                                <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-sm btn-primary me-1"><i
                                        class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                            @endif
                                        <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-danger me-1"><i
                                            class="mdi mdi-check me-1"></i>Finish</a>
                    </div> --}}
                </div>
    
            </div>
        </div>
    </div> <!-- container -->

    
@endsection
@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(function() {
            $('#installation_date').datepicker({
                startDate: new Date(),
                format: "yyyy-mm-dd",
                autoclose: true
            });

            $('#warranty_dates').datepicker({
                startDate: new Date(),
                format: "yyyy-mm-dd",
                autoclose: true
            });
             $('#part_warranty_dates').datepicker({
                startDate: new Date(),
                format: "yyyy-mm-dd",
                autoclose: true
            });


            $('#part_installation_date').datepicker({
                startDate: new Date(),
                format: "yyyy-mm-dd",
                autoclose: true
            });

            {{-- $('#part_warranty_upto').datepicker({
                startDate: new Date(),
                format: "yyyy-mm-dd",
                autoclose: true
            }); --}}


            $('#service_start_date').datepicker({
                startDate: new Date(),
                format: "yyyy-mm-dd",
                autoclose: true
            });
        });

        function confirmDelete(e) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Delete it!"
            }).then(t => {
                t.isConfirmed && document.getElementById("delete-form" + e).submit()
            })
        }
    </script>
    <script>
        function getParts() {
            var category_id = $('#category').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            var formData = {
                category_id: category_id,
            };

            $.ajax({
                type: "POST",
                url: "{{ route('admin.categories.get-parts') }}",
                data: formData,
                dataType: 'json',
                success: function(data) {
                    $('#part').html(data.parts);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }
    </script>
    <script>
        function addPart() {
            let orderId                 = {{ $order->id }};
            let category                = $("#category").val();
            let part                    = $("#part").val();
            let quantity                = $("#quantity").val();
            {{-- let partInstallationDate    = $("#part_installation_date").val();
            let partWarrantyUpto        = $("#part_warranty_upto").val();
            let warranty_date           = $("#part_warranty_dates").val(); --}}
              {{-- part_installation_date: partInstallationDate,
            part_warranty_upto: partWarrantyUpto,
            warranty_date:warranty_date, --}}
           
            if (category.length == "") {
                $("#category_error").show();
                return false;
            } else {
                $("#category_error").hide();
            }

            if (part.length == "") {
                $("#part_error").show();
                return false;
            } else {
                $("#part_error").hide();
            }

            if (quantity.length == "") {
                $("#quantity_error").show();
                return false;
            } else {
                $("#quantity_error").hide();
            }

            {{-- if (partInstallationDate.length == "") {
                $("#part_installation_date_error").show();
                return false;
            } else {
                $("#part_installation_date_error").hide();
            } --}}

            {{-- if (partWarrantyUpto.length == "") {
                $("#part_warranty_upto_error").show();
                return false;
            } else {
                $("#part_warranty_upto_error").hide();
            } --}}

            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        var formData = {
            order_id: orderId,
            category: category,
            part_id: part,
            quantity: quantity,
          
        };

        $.ajax({
            type: "POST",
            url: "{{ route('admin.orders.add-part') }}",
            data: formData,
            dataType: 'json',
            success: function (data) {
                $('#parts-row').html(data.html);
                $("#category").val('');
                $("#part").val('');
                $("#quantity").val('');
                $("#part_installation_date").val('');
                $("#part_warranty_upto").val('');
            },
            error: function (data) {
                console.log(data);
            }
        });
        }
    </script>
    <script>
        function serviceContractfunc(){
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
        $(document).ready(function () {
            serviceContractfunc();
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

     <script>
    {{-- $(document).ready(function(){
         var custom= $("#part_warranty_upto").val();
          partShowCustomDate(custom);
    })
    
    function partShowCustomDate(custom){

        if(custom == 'custom') {
            
            var element = document.getElementById('part_warranty_date');
            element.style.display = ''; 
              
        }else{
            $('#part_warranty_date').hide();
        }
    } --}}
    </script>
@endpush
