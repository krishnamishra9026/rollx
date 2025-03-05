@extends('layouts.admin')
@section('title', 'Edit Franchise')
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
                        <button type="submit" class="btn btn-sm btn-danger" form="franchiseForm"><i
                                class="mdi mdi-database me-1"></i>Update</button>
                    </div>
                    <h4 class="page-title">Edit Franchise</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <form id="franchiseForm" method="POST" action="{{ route('admin.franchises.update', $franchise->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-body">
                            <div class="row">

                                <div class="col-sm-6 mb-2 {{ $errors->has('firstname') ? 'has-error' : '' }}">
                                    <label class="col-form-label" for="firstname">Firstname</label>
                                    <input type="text" class="form-control" id="firstname" name="firstname"
                                        placeholder="Enter First Name" value="{{ old('firstname', $franchise->firstname) }}">
                                    @error('firstname')
                                        <span id="firstname-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-2 {{ $errors->has('lastname') ? 'has-error' : '' }}">
                                    <label class="col-form-label" for="lastname">Lastname</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname"
                                        placeholder="Enter Last Name" value="{{ old('lastname', $franchise->lastname) }}">
                                    @error('lastname')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-2 {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <label class="col-form-label" for="email">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Enter Email Address" value="{{ old('email', $franchise->email) }}">
                                    @error('email')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                

                                <div class="col-sm-6 mb-2 {{ $errors->has('phone') ? 'has-error' : '' }}">
                                    <label class="col-form-label" for="phone">Phone Number</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        placeholder="Enter Phone Number" value="{{ old('phone', $franchise->phone) }}">
                                    @error('phone')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    <input id="dial-code" name="dialcode" type="hidden"
                                        value="{{ isset($admin) ? $admin->dialcode : '' }}">
                                </div>
                                
                                <div class="col-sm-6 mb-2 {{ $errors->has('city') ? 'has-error' : '' }}">
                                    <label class="col-form-label" for="city">City</label>
                                    <input type="text" class="form-control" id="city" name="city"
                                        placeholder="Enter City" value="{{ old('city', $franchise->city) }}">
                                    @error('city')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-2 {{ $errors->has('state') ? 'has-error' : '' }}">
                                    <label class="col-form-label" for="state">State</label>
                                    <input type="text" class="form-control" id="state" name="state"
                                        placeholder="Enter State" value="{{ old('state', $franchise->state) }}">
                                    @error('state')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <label class="col-form-label" for="avatar">Profile Picture</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="avatar" name="avatar"
                                            onchange="loadPreview(this);">
                                    </div>
                                    @if ($errors->has('avatar'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('avatar') }}</strong>
                                        </span>
                                    @endif
                                    <img id="preview_img" src="{{ $franchise->avatar }}" class="mt-2"
                                        width="100" height="100" />
                                </div>
                                
                            </div>
                        </div>
                        
                    
        
                        <div class="card-footer text-end">
                            <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary me-1"><i
                                    class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                            <button type="submit" class="btn btn-sm btn-danger" form="franchiseForm"><i
                                    class="mdi mdi-database me-1"></i>Update</button>
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
            initialCountry: "{{ old('iso2', $franchise->iso2) }}",
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
