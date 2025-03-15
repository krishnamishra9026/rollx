@if(auth()->guard('administrator')->user()->unreadNotifications && count(auth()->guard('administrator')->user()->unreadNotifications))
    @foreach (auth()->guard('administrator')->user()->unreadNotifications as $key => $notification)
        @if($key > 4) 
            @php break; @endphp
        @endif
        <div class="dropdown-item notify-item">
            <div class="notify-icon bg-primary">
                <i class="mdi mdi-comment-account-outline"></i>
            </div>
            <p class="notify-details">
                <strong>{{ $notification->data['message'] }}</strong>
                <br/>
                @if(isset($notification->data['sale_url']))
                    View Sales<a href="{{ $notification->data['sale_url'] }}"> #{{ $notification->data['sale_id'] }}</a> of Order
                    <a href="{{ $notification->data['order_url'] }}"> #{{ $notification->data['order_id'] }}</a>
                @else

                @if(isset($notification->data['order_url']))
                        View Order <a href="{{ $notification->data['order_url'] }}"> #{{ $notification->data['order_id'] }}</a>
                    @else
                        View <a href="{{ route('admin.wallet-requests.index') }}">Wallet/Points</a>
                    @endif                   
                    
                @endif
                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
            </p>
        </div>
    @endforeach
@else
    <div style="padding-left:20px;padding-bottom:10px">No notifications available</div>
@endif
