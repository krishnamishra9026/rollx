@extends('layouts.app')
@section('title', 'Contact Us')
@section('content')

    <div class="contact-page">
        <div class="container">
            <h1 class="text-center">Our Blogs</h1>
        </div>
    </div>

    <div class="container mt-4">       
        
        <div class="row">
            @foreach($blogs as $blog)
            <div class="col-md-3 mb-4" style="min-height: 350px;">
                <div class="card">
                    <h4 class="card-title text-center mt-2">{{ $blog->heading }}</h4>
                    @if(isset($blog->header_image) && !empty($blog->header_image))
                    <img src="{{ asset('storage/uploads/blogs/'.$blog->header_image) }}" class="card-img-top" alt="{{ $blog->title }}">
                    @else
                    <div style="width:100%; height:145px; background:#ddd; display:flex; align-items:center; justify-content:center; font-size:14px;">
                        No Image Available
                    </div>

                    @endif
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $blog->title }}</h5>
                        <p class="card-text">{{ Str::limit($blog->excerpt, 50) }}</p>
                        <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

@endsection
@push('scripts')
    <script src="{{ asset('assets/js/vendor/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/js/ui/component.fileupload.js') }}"></script>
@endpush
