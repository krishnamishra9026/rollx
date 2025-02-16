<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('chef.purchase-orders.index') }}" id="filterForm">
                    <div class="row">
                        <div class="col-sm-4 mb-2">
                            <label class="col-form-label" for="date">Date</label>
                            <input type="date" class="form-control" id="date" name="date" placeholder="Enter date" value="{{ $filter['date'] }}">
                        </div>
                        <div class="col-sm-4 mb-2">
                            <label class="col-form-label" for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" value="{{ $filter['address'] }}">
                        </div>
                        <div class="col-sm-4 mb-2">
                            <label class="col-form-label" for="statuses">Status</label>
                            <select class="form-select" id="statuses" name="status">
                                <option value="">All</option>
                                <option value="PO Generated" {{ $filter['status'] == 'PO Generated'  ? 'selected' : '' }}>Not Started</option>
                                <option value="25% Assembled" {{ $filter['status'] == '25% Assembled'  ? 'selected' : '' }}>25% Assembled</option>
                                <option value="50% Assembled" {{ $filter['status'] == '50% Assembled'  ? 'selected' : '' }}>50% Assembled</option>
                                <option value="100% Assembled" {{ $filter['status'] == '100% Assembled'  ? 'selected' : '' }}>100% Assembled</option>
                                <option value="shipped" {{ $filter['status'] == 'shipped'  ? 'selected' : '' }}>Shipped</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
