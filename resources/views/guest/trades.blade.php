@extends('layouts.app')
@section('title', 'Trades List for '.ucfirst($group).' | Find My Tradesman')
@section('content')
    <div class="trades-page">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1>Trades List for <span>{{ucfirst($group)}}</span></h1>
                </div>
                @forelse ($trades as $trade)
                <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3 col-12">
                    <a href="{{route("tradesman.index",["trade" => $trade->id])}}" class="trades-box">{{$trade->trade}}</a>
                </div>
                @empty
                <div class="card">
                    <div class="card-body">
                        <p class="text-center py-5">
                            No Trades found.
                        </p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>

    </div>
@endsection
@push('scripts')
    <script></script>
@endpush
