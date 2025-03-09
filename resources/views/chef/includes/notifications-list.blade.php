@if(auth()->guard('chef')->user()->unreadNotifications && count(auth()->guard('chef')->user()->unreadNotifications))
    @foreach (auth()->guard('chef')->user()->unreadNotifications as $key => $notification)
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
                <a href="{{ $notification->data['order_url'] }}">View Order #{{ $notification->data['order_id'] }}</a>
                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
            </p>
        </div>
    @endforeach
@else
    <div style="padding-left:20px;padding-bottom:10px">No notifications available</div>
@endif
