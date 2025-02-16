@extends('layouts.app')
@section('title', 'Post a job')
@section('content')

    <section>
        <div class="container">
            <div class="auth-fluid no-bg loginform">
                <div class="auth-fluid-form-box BGShadow">
                    <div class="align-items-center">
                        <div class="card-body">
                            <h3 class="my-4 text-center">@lang('customer.email_verificationEmail.tell_us')</h3>
                            <form method="POST" action="{{ route('campaign.step-two.save') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-sm-6 mb-1">
                                        <label class="col-form-label text-dark">@lang('customer.post-job.job_title') <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="title"
                                            @if (request()->get('title')) value="{{ old('title', request()->get('title')) }}" @else value="{{ old('title', isset($job->title) ? $job->title : '') }}" @endif
                                            placeholder="@lang('customer.reset.post-job.job_title')">
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-6 mb-1">
                                        <label class="col-form-label text-dark">@lang('customer.post-job.select_trade') <span
                                                class="text-danger">*</span></label>
                                        <select name="trade" id="trade" class="form-control select2" data-toggle="select2">
                                            <option value="">@lang('customer.tradesman.please_select')</option>
                                            @foreach ($trades as $trade)
                                                <option value="{{ $trade->id }}"
                                                    @if (request()->get('trade')) {{ old('trade', request()->get('trade')) == $trade->id ? 'selected' : '' }} @else {{ old('trade', isset($job->trade_id) ? $job->trade_id : '') == $trade->id ? 'selected' : '' }} @endif>
                                                    {{ $trade->trade }}</option>
                                            @endforeach
                                        </select>
                                        @error('trade')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-12 mb-1">
                                        <label class="col-form-label text-dark">@lang('customer.post-job.where_needs') <span
                                                class="text-danger">*</span></label>
                                        <input id="latitude" type="hidden" class="form-control" name="latitude"
                                            value="{{ old('latitude', isset($job->latitude) ? $job->latitude : '') }}">
                                        <input id="longitude" type="hidden" class="form-control" name="longitude"
                                            value="{{ old('longitude', isset($job->latitude) ? $job->latitude : '') }}">
                                        <input id="location" type="text"
                                            class="form-control @error('location') is-invalid @enderror" name="location"
                                            value="{{ old('location', isset($job->location) ? $job->location : '') }}"
                                            autocomplete="off" placeholder="Job location">

                                        @error('location')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-12 mb-1">
                                        <label class="col-form-label text-dark">@lang('customer.email_verificationEmail.tell_about_job')<span class="text-danger">*</span></label>
                                        <textarea name="description" id="description" rows="3" class="form-control"
                                            placeholder="@lang('customer.email_verificationEmail.job_more_quickly')"> {{ old('description', isset($job->description) ? $job->description : null) }}</textarea>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-12 mb-1">
                                        <label class="col-form-label text-dark">@lang('customer.post-job.est_budget')<span
                                                class="text-danger">*</span></label>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <input type="number" class="form-control" placeholder="Eg. $10"
                                                    name="budget_starts_from"
                                                    value="{{ old('budget_starts_from', isset($job->budget_starts_from) ? $job->budget_starts_from : '') }}">
                                                @error('budget_starts_from')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-2">
                                                <p style="text-align:center;position:relative;top:5px">to</p>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="number" class="form-control" placeholder="Eg. $300"
                                                    name="budget_upto"
                                                    value="{{ old('budget_upto', isset($job->budget_upto) ? $job->budget_upto : '') }}">
                                                @error('budget_upto')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-sm-6">
                                        <div class="form-group mb-1">
                                            <label class="col-form-label text-dark">@lang('customer.post-job.est_start_date')</label>
                                            <input type="date" class="form-control form-lg" name="start_date"
                                                value="{{ old('start_date', isset($job->start_date) ? $job->start_date : '') }}">
                                            @error('start_date')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6 mb-3">
                                        <label class="col-form-label text-dark">@lang('customer.email_verificationEmail.max_file_size')</label>
                                        <input type="file" class="form-control form-lg" name="attachments[]"
                                            multiple>
                                    </div>
                                    <div class="form-group col-sm-12 mb-3">
                                        @isset($job->attachments)
                                            <div class="row">
                                                @forelse($job->attachments as $key => $attachment)
                                                    <div class="col-xl-12">
                                                        <div class="card mb-1 shadow-none border">
                                                            <div class="p-2">
                                                                <div class="row align-items-center">
                                                                    <div class="col-auto">
                                                                        <div class="avatar-sm">
                                                                            <span
                                                                                class="avatar-title bg-primary-lighten text-primary rounded">
                                                                                {{ $attachment['extension'] }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col ps-0">
                                                                        <a href="javascript:void(0);"
                                                                            class="text-muted fw-bold">{{ $attachment['name'] }}</a>
                                                                        <p class="mb-0">
                                                                            {{ round($attachment['size'] / 1024) }} KB</p>
                                                                    </div>
                                                                    <div class="col-auto">
                                                                        <!-- Button -->
                                                                        <a href="{{ asset("storage/uploads/jobs/temp/{$attachment['name']}") }}"
                                                                            download="{{ $attachment['name'] }}"
                                                                            class="btn btn-link btn-lg text-muted">
                                                                            <i class="dripicons-download"></i>
                                                                        </a>
                                                                        <a href="javascript:void(0)"
                                                                            onclick="confirmDelete({{ $key }})"
                                                                            class="btn btn-link btn-lg text-muted">
                                                                            <i class="dripicons-cross"></i>
                                                                        </a>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> <!-- end col -->
                                                @empty
                                                @endforelse

                                            </div>
                                        @endisset
                                        @if ($message = Session::get('file-delete'))
                                            <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show"
                                                role="alert">
                                                <button type="button" class="btn btn-sm btn-close"
                                                    data-bs-dismiss="alert" aria-label="Close"></button>
                                                <strong><i class="dripicons-document me-2"></i>
                                                </strong>{{ $message }}
                                            </div>
                                        @endif
                                    </div> --}}
                                </div>

                                <div class="form-group mb-1 text-center">
                                    <button type="submit" class="btn btn-primary">@lang('customer.post-job.continue_btn')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @isset($job->attachments)
        @foreach ($job->attachments as $key => $attachment)
            <form id='delete-form{{ $key }}' action='{{ route('post-job.delete-attachment', $key) }}'
                method='POST'>
                <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                <input type='hidden' name='_method' value='DELETE'>
            </form>
        @endforeach
    @endisset
@endsection
@push('scripts')
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_api_key') }}&libraries=places&callback=Function.prototype">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(e) {
            Swal.fire({
                title: "@lang('customer.home.dlt_msg_title')",
                text: "@lang('customer.home.dlt_msg_text')",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "@lang('customer.home.dlt_msg_text_btn')"
            }).then(t => {
                t.isConfirmed && document.getElementById("delete-form" + e).submit()
            })
        }
    </script>
    <script>
        let address = document.getElementById('location')
        let autocomplete = new google.maps.places.Autocomplete(address);
        autocomplete.addListener("place_changed", () => {
            const place = autocomplete.getPlace();
            $('#latitude').val(place.geometry.location.lat())
            $('#longitude').val(place.geometry.location.lng())
        });
    </script>
@endpush
