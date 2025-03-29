@extends('layouts.admin')
@section('title', 'Create Blog')
@section('content')

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ route('admin.blogs.index') }}" class="btn btn-sm btn-primary me-1"><i
                                class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                        <button type="submit" class="btn btn-sm btn-danger" form="serviceForm"><i
                                class="mdi mdi-database me-1"></i>Save</button>
                    </div>
                    <h4 class="page-title">Create Blog</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <!-- end page title -->
        <div class="row">
            <form id="serviceForm" method="POST" action="{{ route('admin.blogs.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="col-12">

                    <div class="card">
                        <div class="card-body">

                            <div class="row mb-2">
                                <label class="col-form-label col-sm-2" for="name">Blog Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Enter Title" value="{{ old('title') }}">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-2">
                                <label class="col-form-label col-sm-2" for="name">Blog Heading</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="heading" name="heading"
                                        placeholder="Enter Heading" value="{{ old('heading') }}">
                                    @error('heading')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-2">
                                <label class="col-md-2 col-form-label text-md-start">{{ __('Header Image') }}</label>
                                <div class="col-md-10">
                                    <input id="header_image" type="file"
                                        class="form-control @error('header_image') is-invalid @enderror" name="image"
                                         style="display: none">
                                    <label class="border mb-2 me-1" for="header_image">
                                        <img src="{{ asset('assets/images/image-placeholder.png') }}"></label>
                                    <span class="gallery">

                                    </span>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label for="content" class="col-md-2 col-form-label text-md-start">Blog Content</label>

                                <div class="col-md-10">
                                    <textarea name="content" class="form-control @error('content') is-invalid @enderror" id="content" rows="3"
                                        placeholder="Enter Blog content">{{ old('content') }}</textarea>
                                    @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            


                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ route('admin.blogs.index') }}" class="btn btn-sm btn-primary me-1"><i
                                    class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                            <button type="submit" class="btn btn-sm btn-danger" form="serviceForm"><i
                                    class="mdi mdi-database me-1"></i>Save</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div> <!-- container -->


@endsection

@push('scripts')

<script src="{{ asset('assets/js/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: 'textarea#content',
            height: 300,
            menubar: false,
            plugins: [
              'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
              'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown','importword', 'exportword', 'exportpdf'
            ],
     
            toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | image | help',
            content_style: 'body { font-family:roboto; font-size:16px }',
            
            // Image Upload Settings
            images_upload_url: '{{ route("upload.tinymce.image") }}', // Define your Laravel route
            automatic_uploads: true,
            file_picker_types: 'image',
            file_picker_callback: function(callback, value, meta) {
                let input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.onchange = function() {
                    let file = this.files[0];
                    let reader = new FileReader();
                    reader.onload = function() {
                        let base64 = reader.result.split(',')[1];
                        callback('data:image/png;base64,' + base64, { title: file.name });
                    };
                    reader.readAsDataURL(file);
                };
                input.click();
            }
        });
    </script>


    <script>
        $(function() {
            // Multiple images preview in browser
            var imagesPreview = function(input, placeToInsertImagePreview) {

                if (input.files) {
                    var filesAmount = input.files.length;

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            $($.parseHTML('<img>')).attr('src', event.target.result).attr('width', '150px')
                                .attr('height', '100px').attr('class', 'me-2 mt-2 mb-2 border').appendTo(
                                    placeToInsertImagePreview);
                        }

                        reader.readAsDataURL(input.files[i]);
                    }
                }

            };

            $('#header_image').on('change', function() {
                $('.gallery').html('')
                imagesPreview(this, 'span.gallery');
            });
        });
    </script>


@endpush
