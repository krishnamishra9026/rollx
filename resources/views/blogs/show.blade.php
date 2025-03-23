@extends('layouts.app')
@section('title', 'Contact Us')
@section('content')

    <div class="contact-page">
        <div class="container">
            <h1 class="text-center">{{$blog->heading}}</h1>
        </div>
    </div>

    <div class="container mt-4">
        <div class="text-center">
            <h2>{{ $blog->title }}</h2>
            <img src="{{ asset('storage/'.$blog->image) }}" class="img-fluid my-4" alt="{{ $blog->title }}">
        </div>

        <p>{!! $blog->content !!}</p>

        <a href="{{ route('blogs.index') }}" class="btn btn-secondary mt-4">Back to Blogs</a>
    </div>

    </div>

@endsection
@push('scripts')
    <script src="{{ asset('assets/js/vendor/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/js/ui/component.fileupload.js') }}"></script>
@endpush
