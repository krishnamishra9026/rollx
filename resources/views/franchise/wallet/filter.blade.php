<div class="row">
    <div class="col-12">
        <div class="card">

             @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif


            <div class="card-body">
                <form action="{{ route('franchise.wallet.store') }}" method="POST" id="filterForm">
                    @csrf
                    <div class="row">
                        <div class="col-sm-4 mb-2">
                        <h2>Wallet for {{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</h2>
                        <h3>Wallet Balance {{ auth()->user()->balance }}</h3>

                        @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
