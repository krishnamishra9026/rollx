@extends('layouts.admin')
@section('title', 'Add Customer / Company')
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
                        <a href="{{ route('admin.customers.index') }}" class="btn btn-sm btn-primary me-1"><i
                                class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                        <button type="submit" class="btn btn-sm btn-danger" form="customerForm"><i
                                class="mdi mdi-database me-1"></i>Save</button>
                    </div>
                    <h4 class="page-title">Add Customer / Company</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <form id="customerForm" method="POST" action="{{ route('admin.customers.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <h4 class="card-title mb-0">General Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mb-2">
                                <label for="company"
                                    class="col-md-2 col-form-label text-md-start">{{ __('Company') }}</label>

                                <div class="col-md-10">
                                    <input id="company" type="text"
                                        class="form-control @error('company') is-invalid @enderror" name="company"
                                        placeholder="Enter company name" value="{{ old('company') }}" autofocus required>

                                    @error('company')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="name"
                                    class="col-md-2 col-form-label text-md-start">{{ __('Contact Person') }}</label>

                                <div class="col-md-10">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        placeholder="Enter contact person name" value="{{ old('name') }}" required>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="email"
                                    class="col-md-2 col-form-label text-md-start">{{ __('Email Address') }}</label>

                                <div class="col-md-5">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        placeholder="Enter email address" value="{{ old('email') }}"
                                        autocomplete="email" required>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-5">
                                    <input id="alternate_email" type="email"
                                        class="form-control @error('alternate_email') is-invalid @enderror" name="alternate_email"
                                        placeholder="Enter alternate email address" value="{{ old('alternate_email') }}"
                                        autocomplete="alternate_email">

                                    @error('alternate_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="contact"
                                    class="col-md-2 col-form-label text-md-start">{{ __('Contact Number') }}</label>

                                <div class="col-md-5">
                                    <input id="contact" type="text"
                                        class="form-control @error('contact') is-invalid @enderror"
                                        name="contact" placeholder="Enter contact number"
                                        value="{{ old('phone') }}" required>
                                        <input id="dial-code" name="dialcode" type="hidden"
                                        value="{{ old('dialcode') }}">
                                        <select id="country" class="form-select" name="iso2"
                                            style="display: none">
                                            <option value="">Select Country</option>
                                        </select>
                                    @error('contact')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-5">
                                    <input id="alternate_contact" type="text"
                                        class="form-control @error('alternate_contact') is-invalid @enderror"
                                        name="alternate_contact" placeholder="Enter alternate contact number"
                                        value="{{ old('alternate_phone') }}">
                                        <input id="alternate-dial-code" name="alternate_dialcode" type="hidden"
                                        value="{{ old('alternate_dialcode') }}">
                                        <select id="alternate_country" class="form-select" name="alternate_iso2"
                                            style="display: none">
                                            <option value="">Select Country</option>
                                        </select>
                                    @error('alternate_contact')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="statuses"
                                    class="col-md-2 col-form-label text-md-start">{{ __('Status') }}</label>
                                <div class="col-md-10">
                                    <select id="statuses"
                                        class="form-select @error('contact') is-invalid @enderror"
                                        name="status" required>
                                        <option value="">Select Status</option>
                                        <option value="1" {{ old('status') == '1' ? 'selected' : 'selected' }}>
                                            Enable</option>
                                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>
                                            Disable</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="remark"
                                    class="col-md-2 col-form-label text-md-start">{{ __('Remark') }}</label>

                                <div class="col-md-10">
                                    <textarea id="remark" class="form-control @error('remark') is-invalid @enderror" name="remark"
                                        placeholder="Write Remark here">{{ old('remark') }}</textarea>

                                    @error('remark')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <h4 class="card-title mb-0 float-start">Addresses</h4>
                            <button type="button"  onclick="addMore();" class="btn btn-sm btn-success float-end">Add More Address</button>
                        </div>
                        <div class="card-body" id="add_more_address">
                            <div id="add_more_0" class="mt-2 p-4 bg-light">
                                <div class="row mb-2">
                                    <label for="address" class="col-md-2 col-form-label text-md-start">Address</label>
                                    <div class="col-md-10">
                                        <input id="address" type="text" class="form-control" name="addmore[0][address]" placeholder="Enter address" value="{{ old('addmore.0.address') }}" required>
                                        <input id="latitude" type="hidden" class="form-control" name="addmore[0][latitude]" value="{{ old('addmore.0.latitude') }}">
                                        <input id="longitude" type="hidden" class="form-control" name="addmore[0][longitude]" value="{{ old('addmore.0.longitude') }}">
                                        @error('addmore.0.address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <label for="unit_number" class="col-md-2 col-form-label text-md-start">Unit Number</label>
                                    <div class="col-md-10">
                                        <input id="unit_number" type="text" class="form-control" name="addmore[0][unit_number]" placeholder="Unit Number" value="{{ old('addmore.0.unit_number') }}">
                                        @error('addmore.0.unit_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <label for="zipcode" class="col-md-2 col-form-label text-md-start">Postal Code</label>
                                    <div class="col-md-10">
                                        <input id="zipcode" type="number" class="form-control" name="addmore[0][zipcode]" placeholder="Enter Postal Code" value="{{ old('addmore.0.zipcode') }}" required>
                                        @error('addmore.0.zipcode')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-2" >
                                    <label for="is_primary_address" class="col-md-2 col-form-label text-md-start">Primary Address</label>
                                    <div class="col-md-9">
                                        <div class="input-group" >
                                            <select id="is_primary_address_0" class="addrP form-select is_primary_address @error('addmore.0.is_primary_address') is-invalid @enderror" name="addmore[0][is_primary_address]" required>
                                                <option value="">Choose One</option>
                                                <option value="1" {{ old('addmore.0.is_primary_address') == '1' ? 'selected' : '' }}>Yes</option>
                                                <option value="0" {{ old('addmore.0.is_primary_address') == '0' ? 'selected' : '' }}>No</option>
                                            </select>
                                            @error('addmore.0.is_primary_address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-1">
                                        <div class="remove-address">
                                            <button type="button" class="btn btn-danger" onclick="removeAddress(0)">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <h4 class="card-title mb-0">Profile Picture</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mb-2">
                                <label for="avatar"
                                    class="col-md-2 col-form-label text-md-start">{{ __('Profile Picture') }}</label>
                                <div class="col-md-10">
                                    <input id="avatar" type="file"
                                        class="form-control @error('avatar') is-invalid @enderror"
                                        name="avatar" onchange="loadPreview(this);">
                                    <img id="preview_img" src="{{ asset('assets/images/users/avatar.png') }}"
                                        class="mt-2" width="100" height="100" />
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row mb-2 text-end">
                                <div class="col-md-12">

                                    <a href="{{  route('admin.customers.index')  }}" class="btn btn-sm btn-primary me-1"><i
                                            class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        form="customerForm"><i class="mdi mdi-database me-1"></i>Save</button>
                                </div>
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

            input = document.querySelector("#contact"),
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

        alt_input = document.querySelector("#alternate_contact"),
        alt_dialCode = document.querySelector("#alternate-dial-code");
        alt_countryDropdown = document.querySelector("#alternate_country");

    for (var i = 0; i < countryData.length; i++) {
        var country = countryData[i];
        var optionNode = document.createElement("option");
        optionNode.value = country.iso2;
        var textNode = document.createTextNode(country.name);
        optionNode.appendChild(textNode);
        alt_countryDropdown.appendChild(optionNode);
    }

    // init plugin
    var alt_iti = window.intlTelInput(alt_input, {
        initialCountry: "{{ old('iso2', 'SG') }}",
        utilsScript: "{{ asset('assets/js/plugins/intl-tel-input/js/utils.js') }}" // just for formatting/placeholders etc
    });

    // set it's initial value
    alt_dialCode.value = '+' + alt_iti.getSelectedCountryData().dialCode;
    alt_countryDropdown.value = alt_iti.getSelectedCountryData().iso2;

    // listen to the telephone input for changes
    input.addEventListener('countrychange', function(e) {
        alt_dialCode.value = '+' + alt_iti.getSelectedCountryData().dialCode;
        alt_countryDropdown.value = alt_iti.getSelectedCountryData().iso2;
    });

    // listen to the address dropdown for changes
    alt_countryDropdown.addEventListener('change', function() {
        alt_iti.setCountry(this.value);
    });
</script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{config('app.google_api_key')}}&libraries=places&callback=Function.prototype"></script>
<script>
let address   = document.getElementById('address')
let autocomplete   = new google.maps.places.Autocomplete(address);

autocomplete.addListener("place_changed", () => {
    const place    = autocomplete.getPlace();
       if (place.address_components) {

        for (let i = 0; i < place.address_components.length; i++) {
            const addressType = place.address_components[i].types[0];
            if (addressType === "postal_code") {
                var postalCode = place.address_components[i].long_name;

                $('#zipcode').val(postalCode);
            }
        }
    }
    $('#latitude').val(place.geometry.location.lat())
    $('#longitude').val(place.geometry.location.lng())
});

    var i = 1;

    function addMore() {
        var html = `
            <div id="add_more_${i}" class="mt-2 p-4 bg-light">
                <div class="row mb-2">
                    <label for="address" class="col-md-2 col-form-label text-md-start">Address</label>
                    <div class="col-md-10">
                        <input id="address_${i}" type="text" onclick="moreLocation(${i});" class="form-control" name="addmore[${i}][address]" placeholder="Enter address" value="" required>
                        <!-- Add hidden fields and error handling as needed -->

                         <input id="latitude_${i}" type="hidden" class="form-control" name="addmore[${i}][latitude]" value="">
                        <input id="longitude_${i}" type="hidden" class="form-control" name="addmore[${i}][longitude]" value="">
                    </div>
                </div>

                <div class="row mb-2">
                    <label for="unit_number" class="col-md-2 col-form-label text-md-start">Unit Number</label>
                    <div class="col-md-10">
                        <input id="unit_number" type="text" class="form-control" name="addmore[${i}][unit_number]" placeholder="Unit Number" value="">
                        <!-- Add error handling if needed -->
                    </div>
                </div>

                <div class="row mb-2">
                    <label for="zipcode" class="col-md-2 col-form-label text-md-start">Postal Code</label>
                    <div class="col-md-10">
                        <input id="zipcode_${i}" type="number" class="form-control" name="addmore[${i}][zipcode]" placeholder="Enter Postal Code" value="" required>
                        <!-- Add error handling if needed -->
                    </div>
                </div>

                <div class="row mb-2">
                    <label for="is_primary_address" class="col-md-2 col-form-label text-md-start ">Primary Address</label>
                    <div class="col-md-9">
                        <select id="is_primary_address_${i}" class="form-select addrP"   name="addmore[${i}][is_primary_address]" required>
                            <option value="">Choose One</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <div class="remove-address">
                            <button type="button" class="btn btn-danger" onclick="removeAddress(${i})">Remove</button>
                        </div>
                    </div>
                </div>
            </div>`;

        $("#add_more_address").append(html);
        ++i;
    }

    function removeAddress(index) {
        $(`#add_more_${index}`).remove();
    }


  function moreLocation(id)
  {
       let address   = document.getElementById('address_'+id)
        let autocomplete   = new google.maps.places.Autocomplete(address);

        autocomplete.addListener("place_changed", () => {
            const place    = autocomplete.getPlace();
            if (place.address_components) {

                for (let i = 0; i < place.address_components.length; i++) {
                    const addressType = place.address_components[i].types[0];
                    if (addressType === "postal_code") {
                        var postalCode = place.address_components[i].long_name;

                        $('#zipcode_'+id).val(postalCode);
                    }
                }
            }
            $('#latitude_'+id).val(place.geometry.location.lat())
            $('#longitude_'+id).val(place.geometry.location.lng())
        });
  }

 jQuery(document).ready(function($){
    $('body').delegate('.addrP','change',function(e){
        if( $(this).val() == '1' ){
            $('.addrP').val('0');
            $(this).val('1');
        }
        if( $(this).val() == '0'){
            $(this).val('0');
        }
    })
 });
</script>
@endpush
