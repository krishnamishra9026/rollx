@extends('layouts.admin')
@section('title', 'Create Category')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-primary me-1"><i
                                class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                        <button type="submit" class="btn btn-sm btn-danger" form="serviceForm"><i
                                class="mdi mdi-database me-1"></i>Save</button>
                    </div>
                    <h4 class="page-title">Create Category</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <!-- end page title -->

    </div> <!-- container -->

    <div class="row">
        <form id="serviceForm" method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="col-12">

                <div class="card">
                    <div class="card-body">

                        <div class="row mb-2">
                            <label for="type"
                                class="col-md-2 col-form-label text-md-start">{{ __('Category Type') }}</label>
                            <div class="col-md-10">
                                <select id="type" class="form-select @error('type') is-invalid @enderror"
                                    name="type" onchange="parentCategoryToggle()">
                                    <option value="">Choose Category Type</option>
                                    <option value="main-category" {{ old('type') == 'main-category' ? 'selected' : '' }}>
                                        Main Category</option>
                                    <option value="category" {{ old('type') == 'category' ? 'selected' : '' }}>
                                        Category</option>
                                    <option value="sub-category" {{ old('type') == 'sub-category' ? 'selected' : '' }}>
                                        Sub Category</option>
                                </select>
                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-2" id="parent_category_row">
                            <label class="col-form-label col-sm-2" for="service_id">Parent Category</label>
                            <div class="col-sm-10">
                                <select name="category_id" id="category_id" class="form-select form-select-sm">
                                    <option value="">Choose Parent Category</option>
                                    @foreach ($categories as $row)
                                        <option value="{{ $row->id }}"
                                            {{ old('category_id') == $row->id ? 'selected' : '' }}>{{ $row->category }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <label class="col-form-label col-sm-2" for="category">Category Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="category" name="category"
                                    placeholder="Enter Name" value="{{ old('category') }}">
                                @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>                        

                        <div class="row mb-2">
                            <label for="statuses" class="col-md-2 col-form-label text-md-start">{{ __('Status') }}</label>
                            <div class="col-md-10">
                                <select id="statuses" class="form-select @error('contact') is-invalid @enderror"
                                    name="status">
                                    <option value="">Select Status</option>
                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>
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

                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-primary me-1"><i
                                class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                        <button type="submit" class="btn btn-sm btn-danger" form="serviceForm"><i
                                class="mdi mdi-database me-1"></i>Save</button>
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection
@push('scripts')
    <script>
        function parentCategoryToggle() {
            var type = $('#type').val();
            switch (type) {
                case 'main-category':
                    $('#parent_category_row').hide();
                    break;
                case 'category':
                    $("#category_id").select2({
                        ajax : {
                            type: "POST",
                            url: "{{ route('admin.categories.get-subcategories') }}",                           
                            dataType: 'json',
                            data: {
                                type: 'category',
                                _token : '{{ csrf_token() }}'
                            },
                            processResults: function(response) {
                                return {
                                    results: response
                                };
                            },
                            cache: true
                        }
                    });
                    $('#parent_category_row').show();
                    break;
                case 'sub-category':
                $("#category_id").select2({
                        ajax : {
                            type: "POST",
                            url: "{{ route('admin.categories.get-subcategories') }}",                           
                            dataType: 'json',
                            data: {
                                type: 'sub-category',
                                _token : '{{ csrf_token() }}'
                            },
                            processResults: function(response) {
                                return {
                                    results: response
                                };
                            },
                            cache: true
                        }
                    });
                    $('#parent_category_row').show();
                    break;
                default:
                    $('#parent_category_row').hide();
                    break;
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            parentCategoryToggle();
        });
    </script>
    <script>
        $('#category_id').select2({

        });
    </script>
@endpush
