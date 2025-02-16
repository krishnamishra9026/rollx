@extends('layouts.app')
@section('title', 'Contact Us')
@section('content')
    <div class="contact-page">
        <div class="container">
            <h1>@lang('customer.email_verificationEmail.contact_us')</h1>
        </div>
    </div>

    <div class="container">
        <h2 class="contact_title">@lang('customer.email_verificationEmail.touch_with_us')</h2>
        <div class="social-box">

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible bg-yellow text-dark border-0 fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong><i class="dripicons-checkmark me-2"></i> </strong>{{ $message }}
                </div>
            @endif

            <div class="row">
                <div class="col-sm-6">
                    <div class="social-icon-box">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <i class="uil-phone-alt"></i>
                            </div>
                            <div class="col">
                                <div>
                                    <h4>@lang('customer.email_verificationEmail.call_us')</h4>
                                    <a href="tel:+34958151271">{{ Helper::getSetting()->contact_number ?? '+34 958 151 271' }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icon-box">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <i class="uil-envelope"></i>
                            </div>
                            <div class="col">
                                <div>
                                    <h4>@lang('customer.email_verificationEmail.email_us')</h4>
                                    <a href="mailto:info@findmytradesman.es">{{ Helper::getSetting()->contact_email ?? 'info@findmytradesman.es' }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="contact-box">
                    <form action="{{ route('contact.save') }}" method="POST" class="" id="myAwesomeDropzone" data-plugin="dropzone" data-previews-container="#file-previews"
                            data-upload-preview-template="#uploadPreviewTemplate" enctype="multipart/form-data">
                            @csrf

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-1">
                                    <label for="" class="col-form-label text-dark">@lang('customer.email_verificationEmail.you_are')</label>
                                    <select name="user_type" class="form-select form-lg">
                                        <option value="">@lang('customer.tradesman.please_select')</option>
                                        <option value="Customer">@lang('customer.email_verificationEmail.homeowner')</option>
                                        <option value="Trader">@lang('customer.email_verificationEmail.tradespeople')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-1">
                                    <label for="" class="col-form-label text-dark">@lang('customer.email_verificationEmail.name')</label>
                                    <input placeholder="@lang('customer.email_verificationEmail.enter_name')" name="name" type="text"
                                        class="form-control form-lg">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-1">
                                    <label for="" class="col-form-label text-dark">@lang('customer.email_verificationEmail.email')</label>
                                    <input placeholder="@lang('customer.email_verificationEmail.enter_email')" name="email" type="email"
                                        class="form-control form-lg">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-1">
                                    <label for="" class="col-form-label text-dark">@lang('customer.register_page.customer_phone_number')</label>
                                    <input placeholder="@lang('customer.email_verificationEmail.enter_phone_number')" name="mobile" type="number"
                                        class="form-control form-lg">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-1">
                                    <label for="" class="col-form-label text-dark">@lang('customer.email_verificationEmail.your_enquiry')</label>
                                    <textarea placeholder="@lang('customer.email_verificationEmail.enter_enquiry')" cols="6" name="message" rows="6" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-1">
                                        <input name="files[]" type="file" placeholder="@lang('customer.email_verificationEmail.dropfiles_upload')" multiple />

                           
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mt-2 form-group text-center">
                                    <button type="submit" class="btn btn-lg btn-primary">@lang('customer.ongoing.btn_submit')</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/vendor/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/js/ui/component.fileupload.js') }}"></script>
@endpush
