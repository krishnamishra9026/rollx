<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('franchise.wallet.index') }}" id="filterForm">

                    <div class="row">

                        <div class="col-sm-3 mb-2">
                            <label class="col-form-label" for="franchise">Transaction Type</label>
                            <select class="form-select" id="type" name="type">
                                <option value="">All</option>
                                <option value="deposit" {{ request('type') == 'deposit' ? 'selected' : '' }}>Deposit</option>
                                <option value="withdraw" {{ request('type') == 'withdraw' ? 'selected' : '' }}>Withdraw</option>
                            </select>
                        </div>


                        <div class="col-sm-12 mb-2">
                            <a href="{{ route('franchise.wallet.index') }}" class="btn btn-sm btn-primary float-end me-1"><i  class="mdi mdi-refresh"></i> Reset</a>
                            <button type="submit" class="btn btn-sm btn-danger float-end me-1" form="filterForm"><i  class="mdi mdi-filter"></i> Filter</button>
                        </div>
                       
                    </div>

                
                </form>
            </div>
        </div>
    </div>
</div>