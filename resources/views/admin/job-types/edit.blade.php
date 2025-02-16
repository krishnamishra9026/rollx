@extends('layouts.admin')
@section('title', 'Edit Job Type')
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
                        <a href="{{ route('admin.job-types.index') }}" class="btn btn-sm btn-dark me-1"><i
                                class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                        <button type="submit" class="btn btn-sm btn-success" form="serviceForm"><i
                                class="mdi mdi-database me-1"></i>Update</button>
                    </div>
                    <h4 class="page-title">Edit Job Type</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <!-- end page title -->

    </div> <!-- container -->

    <div class="row">
        <div class="col-12">
            <form id="serviceForm" method="POST" action="{{ route('admin.job-types.update', $service->id) }}"
                enctype="multipart/form-data">
                @csrf  
                @method('PUT')              
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 mb-2">
                                <h4 class="text-dark">Job Type Details</h4>
                            </div>
                            <div class="col-sm-12 mb-2 {{ $errors->has('service') ? 'has-error' : '' }}">
                                <label class="col-form-label" for="type">Job Type</label>
                                <input type="text" class="form-control" id="type" name="type"
                                    placeholder="Enter Job Type" value="{{ old('type', $service->type) }}">
                                @error('type')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-12 mb-2 {{ $errors->has('description') ? 'has-error' : '' }}">
                                <label class="col-form-label" for="description">Job Type Description</label>
                                <textarea class="form-control" id="description" name="description"
                                    placeholder="Enter Description" rows="3">{{ old('description', $service->description) }}</textarea>
                                @error('description')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>                           
                           
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ route('admin.job-types.index') }}" class="btn btn-sm btn-dark me-1"><i
                                class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                        <button type="submit" class="btn btn-sm btn-success" form="serviceForm"><i
                                class="mdi mdi-database me-1"></i>Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection