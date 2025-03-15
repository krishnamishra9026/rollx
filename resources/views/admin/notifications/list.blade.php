@extends('layouts.admin')
@section('title', 'Leads')
@section('head')
    <link href="{{ asset('assets/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Notifications</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <div class="row">            
            <div class="col-12">
                <div class="card">  
                    <div class="card-body">
                        @if($notifications->count())
                            @foreach ($notifications as $notification)
                                <div class="d-flex align-items-start p-3 border-bottom notification-item">
                                    <div class="notify-icon bg-primary text-white rounded-circle me-3 d-flex align-items-center justify-content-center">
                                        <i class="mdi mdi-comment-account-outline"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="mb-1">
                                            <strong>{{ $notification->data['message'] }}</strong>
                                        </p>
                                        @if(isset($notification->data['sale_url']))
                                            <p class="mb-1">
                                                View Sales <a href="{{ $notification->data['sale_url'] }}" class="text-primary fw-bold">#{{ $notification->data['sale_id'] }}</a> 
                                                of Order <a href="{{ $notification->data['order_url'] }}" class="text-success fw-bold">#{{ $notification->data['order_id'] }}</a>
                                            </p>
                                        @else

                                            @if(isset($notification->data['order_url']))
                                            <p class="mb-1">
                                                View Order <a href="{{ $notification->data['order_url'] }}" class="text-success fw-bold">#{{ $notification->data['order_id'] }}</a>
                                            </p>
                                            @else
                                            <p class="mb-1">
                                                View <a href="{{ route('admin.wallet-requests.index') }}">Wallet/Points</a>
                                                </p>
                                            @endif                   

                                            
                                        @endif
                                        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                    </div>
                                    <a href="#" class="text-danger">
                                        <i class="mdi mdi-check-circle-outline"></i>
                                    </a>
                                </div>
                            @endforeach

                            <!-- Pagination Links -->
                            <div class="mt-3">
                                {{ $notifications->appends(request()->query())->links('pagination::bootstrap-5') }}
                            </div>

                        @else
                            <p class="text-center text-muted">No notifications available</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection