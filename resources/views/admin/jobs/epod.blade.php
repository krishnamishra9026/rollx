@extends('layouts.admin')
@section('title', 'Job EPOD')
@section('content')
    <div class="container-fluid">

         <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary me-1"><i
                                class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                                <a href="{{ route('admin.download.epod', $job->id) }}" class="btn btn-sm btn-dark"
                                    data-toggle="tooltip" title="Download Images"> <i class="mdi mdi-download me-1"></i>Download </a>

                    </div>
                    <h4 class="page-title">EPOD for Job # {{ $job->id }}</h4>

                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <ul class="list-group">
                                    @foreach($job->proof as $proof)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span>
                                                <img src="{{ asset('storage/uploads/jobs/'.$job->id.'/proof'.'/'.$proof->photo) }}" width="300px" height="300px" style="border:1px solid #777"/>
                                            <br>
                                            <small>Technician : {{ $job->technician->firstname }} {{ $job->technician->lastname }}</small>
                                            <br>
                                            <small>{{ \Carbon\Carbon::parse($proof->created_at)->format('D, M d, Y h:i A') }}</small>
                                            </span>
                                            <a href="{{ asset('storage/uploads/jobs/'.$job->id.'/proof'.'/'.$proof->photo) }}" class="btn btn-sm btn-primary" download=""><i class="fa fa-download"></i></a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-sm-12">
                                @isset($job->signature)
                                <div>
                                    <p>Customer Signature</p>
                                    <a href="{{ $job->signature->signature}}" download="{{ $job->customer->name }} Signature">
                                    <img src="{{ $job->signature->signature}}" width="300px" height="300px" style="border:1px solid #777" class="downloadable"/>
                                    </a>
                                    <br>
                                    <small>Click on the Image to download!</small>
                                    <br>
                                    <small>{{ $job->customer->name }}</small>
                                    <br>
                                    <small>{{ \Carbon\Carbon::parse( $job->signature->created_at)->format('D, M d, Y h:i A') }}</small>
                                </div>
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
