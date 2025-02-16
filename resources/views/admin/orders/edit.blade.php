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
                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary me-1"><i
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

    </div> <!-- container -->

    <div class="row">
        <div class="col-12">
           
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <ul class="nav nav-tabs nav-bordered mb-3">
                                    <li class="nav-item">
                                        <a href="#general-info-tab" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">                                           
                                            <span>General Info</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#addresses-tab" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                            <span>Addresses</span>
                                        </a>
                                    </li>                                    
                                </ul>
                                
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="general-info-tab">
                                        <form id="customerForm" method="POST" action="{{ route('admin.customers.store') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-2">
                                            <label for="name" class="col-md-2 col-form-label text-md-start">{{ __('Name') }}</label>
                
                                            <div class="col-md-10">
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter name" value="{{ old('name') }}" autofocus>
                
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="email" class="col-md-2 col-form-label text-md-start">{{ __('Email Address') }}</label>
                
                                            <div class="col-md-10">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter email address" value="{{ old('email') }}" autocomplete="email">
                
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="contact" class="col-md-2 col-form-label text-md-start">{{ __('Contact Number') }}</label>
                
                                            <div class="col-md-10">
                                                <input id="contact" type="text" class="form-control @error('contact') is-invalid @enderror" name="contact" placeholder="Enter Contact Number" value="{{ old('phone') }}">
                                                <select id="country" class="form-select" name="iso2" style="display: none">
                                                    <option value="">Select Country</option>
                                                </select>
                                                @error('contact')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <label for="statuses" class="col-md-2 col-form-label text-md-start">{{ __('Status') }}</label>
                                            <div class="col-md-10">
                                                <select id="statuses" class="form-select @error('contact') is-invalid @enderror" name="status">
                                                    <option value="">Select Status</option>
                                                    <option value="1" {{ old('status') == '1' ? "selected" : ""  }}>Enable</option>
                                                    <option value="0" {{ old('status') == '0' ? "selected" : ""  }}>Disable</option>
                                                </select>
                                                @error('status')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="avatar" class="col-md-2 col-form-label text-md-start">{{ __('Profile Picture') }}</label>
                                            <div class="col-md-10">
                                                <input id="avatar" type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar">
                                                <img id="preview_img" src="{{ asset('assets/images/users/avatar.png') }}" class="mt-2" width="100" height="100" />
                                            </div>                                                                              
                                        </div>

                                    </div>
                                    <div class="tab-pane" id="addresses-tab">
                                        <p>...</p>
                                    </div>                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
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
@endpush
