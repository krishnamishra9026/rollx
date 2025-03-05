@extends('layouts.admin')
@section('title', 'Create Lead')
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
                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary me-1"><i
                                class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                        <button type="submit" class="btn btn-sm btn-danger" form="customerForm"><i
                                class="mdi mdi-database me-1"></i>Save</button>
                    </div>
                    <h4 class="page-title">Assign Leads to Sale Employees</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <form id="customerForm" method="POST" action="{{ route('admin.leads.assign-leads-save') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                

                                <div class="col-sm-6 mb-2 {{ $errors->has('admin_id') ? 'has-error' : '' }}">
                                    <label class="col-form-label" for="admin_id">Sale Employee</label>
                                    <select class="form-select" data-toggle=select2 id="admin_id" name="admin_id" data-toggle=select2>
                                        <option value="">Select Sale Employee</option>
                                        @foreach($sale_employees as $sale_employee)
                                        <option value="{{ $sale_employee->id }}" {{ request('sale_employee') == $sale_employee->id ? 'selected' : '' }}>
                                            {{ $sale_employee->firstname }} {{ $sale_employee->lastname }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('admin_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <div class="col-sm-6 mb-2 {{ $errors->has('admin_id') ? 'has-error' : '' }}">
                                    <label class="col-form-label" for="admin_id">Leads</label>
                                    <select name="lead_id[]" id="lead_id" class="form-control" multiple  data-toggle=select2 placeholder="Please select Lead">
                                    <option value="">Select Lead</option>
                                    @foreach ($leads as $lead)
                                    <option value="{{ $lead->id }}"
                                        {{ $lead->id == old('lead') ? 'selected' : '' }}> {{ $lead->firstname }} {{ $lead->lastname }} </option>
                                        @endforeach
                                    </select>

                                    @error('lead_id')
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
                            <button type="submit" class="btn btn-sm btn-danger" form="customerForm"><i
                                    class="mdi mdi-database me-1"></i>Save</button>
                        </div>
                        </div>
                       
                    </div>
     

                </form>
            </div>
        </div>
    </div> <!-- container -->


@endsection
@push('scripts')
    <script>
        function loadPreview(input, id) {
            id = id || '#preview_img';
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(id)
                        .attr('src', e.target.result)
                        .width(100)
                        .height(100);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script src="{{ asset('assets/js/plugins/intl-tel-input/js/intlTelInput.min.js') }}"></script>
    <script>
        // get the country data from the plugin
        var countryData = window.intlTelInputGlobals.getCountryData(),

            input = document.querySelector("#phone"),
            dialCode = document.querySelector("#dial-code");
        countryDropdown = document.querySelector("#country");

        for (var i = 0; i < countryData.length; i++) {
            var country = countryData[i];
            var optionNode = document.createElement("option");
            optionNode.value = country.iso2;
            var textNode = document.createTextNode(country.name);
            optionNode.appendChild(textNode);
            countryDropdown.appendChild(optionNode);
        }

        // init plugin
        var iti = window.intlTelInput(input, {
            initialCountry: "{{ old('iso2', 'SG') }}",
            utilsScript: "{{ asset('assets/js/plugins/intl-tel-input/js/utils.js') }}" // just for formatting/placeholders etc
        });

        // set it's initial value
        dialCode.value = '+' + iti.getSelectedCountryData().dialCode;
        countryDropdown.value = iti.getSelectedCountryData().iso2;

        // listen to the telephone input for changes
        input.addEventListener('countrychange', function(e) {
            dialCode.value = '+' + iti.getSelectedCountryData().dialCode;
            countryDropdown.value = iti.getSelectedCountryData().iso2;
        });

        // listen to the address dropdown for changes
        countryDropdown.addEventListener('change', function() {
            iti.setCountry(this.value);
        });
    </script>
      <script>
        // get the country data from the plugin
        var countryData = window.intlTelInputGlobals.getCountryData(),

            alt_input = document.querySelector("#alternate_phone"),
            alt_dialCode = document.querySelector("#alternate-dial-code");

        // init plugin
        var alt_iti = window.intlTelInput(alt_input, {
            initialCountry: "SG",
            utilsScript: "{{ asset('assets/js/plugins/intl-tel-input/js/utils.js') }}" // just for formatting/placeholders etc
        });

        // set it's initial value
        alt_dialCode.value = '+' + iti.getSelectedCountryData().dialCode;

    </script>
      <script>
        // get the country data from the plugin
        var countryData = window.intlTelInputGlobals.getCountryData(),

            helpline_input = document.querySelector("#helpline_phone"),
            helpline_dialCode = document.querySelector("#helpline-dial-code");

        // init plugin
        var helpline_iti = window.intlTelInput(helpline_input, {
            initialCountry: "SG",
            utilsScript: "{{ asset('assets/js/plugins/intl-tel-input/js/utils.js') }}" // just for formatting/placeholders etc
        });

        // set it's initial value
        helpline_dialCode.value = '+' + iti.getSelectedCountryData().dialCode;

    </script>
@endpush
