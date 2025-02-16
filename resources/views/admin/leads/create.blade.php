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
                    <h4 class="page-title">Create Lead</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <form id="customerForm" method="POST" action="{{ route('admin.leads.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 mb-2">
                                    <h4 class="text-dark">Company Details</h4>
                                </div>
                                <div class="col-sm-6 mb-2 {{ $errors->has('company') ? 'has-error' : '' }}">
                                    <label class="col-form-label" for="company">Company Name</label>
                                    <input type="text" class="form-control" id="company" name="company"
                                        placeholder="Enter Company Name" value="{{ old('company') }}">
                                    @error('company')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-2 {{ $errors->has('address') ? 'has-error' : '' }}">
                                    <label class="col-form-label" for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="Enter Address" value="{{ old('address') }}">
                                    @error('address')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-2 {{ $errors->has('city') ? 'has-error' : '' }}">
                                    <label class="col-form-label" for="city">City</label>
                                    <input type="text" class="form-control" id="city" name="city"
                                        placeholder="Enter City" value="{{ old('city') }}">
                                    @error('city')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-2 {{ $errors->has('state') ? 'has-error' : '' }}">
                                    <label class="col-form-label" for="state">State</label>
                                    <input type="text" class="form-control" id="state" name="state"
                                        placeholder="Enter State" value="{{ old('state') }}">
                                    @error('state')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-2">
                                    <label class="col-form-label" for="country">{{ __('Country') }}</label>

                                    <select id="country" class="form-select" name="iso2">
                                        <option value="">Select Country</option>
                                    </select>

                                    @error('country')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-2 {{ $errors->has('zipcode') ? 'has-error' : '' }}">
                                    <label class="col-form-label" for="zipcode">Zipcode</label>
                                    <input type="text" class="form-control" id="zipcode" name="zipcode"
                                        placeholder="Enter Zipcode" value="{{ old('zipcode') }}">
                                    @error('zipcode')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 mb-2 {{ $errors->has('remarks') ? 'has-error' : '' }}">
                                    <label class="col-form-label" for="remarks">Remarks</label>
                                    <textarea class="form-control" id="remarks" name="remarks"
                                        placeholder="Write remarks here">{{ old('remarks') }}</textarea>
                                    @error('remarks')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                       
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 mb-2">
                                    <h4 class="text-dark">Contact Person Details</h4>
                                </div>
                                <div class="col-sm-6 mb-2 {{ $errors->has('firstname') ? 'has-error' : '' }}">
                                    <label class="col-form-label" for="firstname">Firstname</label>
                                    <input type="text" class="form-control" id="firstname" name="firstname"
                                        placeholder="Enter First Name" value="{{ old('firstname') }}">
                                    @error('firstname')
                                        <span id="firstname-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-2 {{ $errors->has('lastname') ? 'has-error' : '' }}">
                                    <label class="col-form-label" for="lastname">Lastname</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname"
                                        placeholder="Enter Last Name" value="{{ old('lastname') }}">
                                    @error('lastname')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-2 {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <label class="col-form-label" for="email">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Enter Email Address" value="{{ old('email') }}">
                                    @error('email')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-2 {{ $errors->has('email_additional') ? 'has-error' : '' }}">
                                    <label class="col-form-label" for="email_additional">Email Address (Additional)</label>
                                    <input type="email" class="form-control" id="email_additional" name="email_additional"
                                        placeholder="Enter Email Address (Additional)" value="{{ old('email_additional') }}">
                                    @error('email_additional')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-sm-6 mb-2 {{ $errors->has('phone') ? 'has-error' : '' }}">
                                    <label class="col-form-label" for="phone">Phone Number</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        placeholder="Enter Phone Number" value="{{ old('phone') }}">
                                    @error('phone')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    <input id="dial-code" name="dialcode" type="hidden"
                                        value="{{ old('dialcode') }}">
                                </div>

                                <div class="col-sm-6 mb-2 {{ $errors->has('alternate_phone') ? 'has-error' : '' }}">
                                    <label class="col-form-label" for="alternate_phone">Company Phone Number</label>
                                    <input type="text" class="form-control" id="alternate_phone" name="alternate_phone"
                                        placeholder="Enter Company Phone Number" value="{{ old('alternate_phone') }}">
                                    @error('alternate_phone')
                                        <span id="alternate_phone-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    <input id="alternate-dial-code" name="alternate_dialcode" type="hidden"
                                        value="{{ old('alternate_dialcode') }}">
                                </div>

                                <div class="col-sm-6 mb-2 {{ $errors->has('helpline_phone') ? 'has-error' : '' }}">
                                    <label class="col-form-label" for="helpline_phone">Helpline Number</label>
                                    <input type="text" class="form-control" id="helpline_phone" name="helpline_phone"
                                        placeholder="Enter Helpline Phone Number" value="{{ old('helpline_phone') }}">
                                    @error('helpline_phone')
                                        <span id="helpline_phone-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    <input id="helpline-dial-code" name="helpline_dialcode" type="hidden"
                                        value="{{ old('helpline_dialcode') }}">
                                </div>
                                <div class="col-sm-6 mb-2 {{ $errors->has('fax') ? 'has-error' : '' }}">
                                    <label class="col-form-label" for="fax">Fax Number</label>
                                    <input type="text" class="form-control" id="fax" name="fax"
                                        placeholder="Enter Fax Number" value="{{ old('fax') }}">
                                    @error('fax')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-2">
                                    <label class="col-form-label" for="gender">{{ __('Gender') }}</label>

                                    <select id="gender" class="form-select" name="gender">
                                        <option value="">Select Gender</option>
                                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female
                                        </option>
                                        <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>

                                    @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-2 {{ $errors->has('password') ? 'has-error' : '' }}">
                                    <label class="col-form-label" for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Enter Password" value="{{ old('password') }}">
                                    @error('password')
                                        <span id="password-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-2 {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                    <label class="col-form-label" for="password_confirmation">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" placeholder="Confirm Password"
                                        value="{{ old('password_confirmation') }}">
                                    @error('password_confirmation')
                                        <span id="password_confirmation-error"
                                            class="error invalid-feedback">{{ $message }}</span>
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
                                    <img id="preview_img" src="{{ asset('assets/images/users/avatar.png') }}" class="mt-2"
                                        width="100" height="100" />
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
