@extends('layouts.app')
@section('title', 'Contact Us')
@section('content')

    <div class="contact-page">
        <div class="container">
            <h1>Inquiry</h1>
        </div>
    </div>

    <div class="container">
        <div class="row mt-2">

            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong><i class="dripicons-checkmark me-2"></i> </strong>{{ $message }}
            </div>
            @endif
    
            <div class="container">
                <h2>Submit Your Inquiry</h2>
                <form action="{{ route('inquiry.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea name="message" id="message" class="form-control" rows="4" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit Inquiry</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/vendor/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/js/ui/component.fileupload.js') }}"></script>
@endpush
