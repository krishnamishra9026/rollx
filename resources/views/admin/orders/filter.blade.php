<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.orders.index') }}" id="filterForm">
                    <div class="row">
                        <div class="col-sm-3 mb-2">
                            <label class="col-form-label" for="date">Date</label>
                            <input type="date" class="form-control" id="date" name="date" placeholder="Enter date" value="{{ $filter['date'] }}">
                        </div>

                        <div class="col-sm-3 mb-2">
                            <label class="col-form-label" for="statuses">Status</label>
                            <select class="form-select" id="statuses" name="status">
                                <option value="">All</option>
                                <option value="pending" {{ $filter['status'] == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $filter['status'] == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="processed" {{ $filter['status'] == 'processed' ? 'selected' : '' }}>Processed</option>
                                <option value="cancelled" {{ $filter['status'] == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                <option value="completed" {{ $filter['status'] == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="shipped" {{ $filter['status'] == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="delivered" {{ $filter['status'] == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="refunded" {{ $filter['status'] == 'refunded' ? 'selected' : '' }}>Refunded</option>
                                <option value="failed" {{ $filter['status'] == 'failed' ? 'selected' : '' }}>Failed</option>
                                <option value="returned" {{ $filter['status'] == 'returned' ? 'selected' : '' }}>Returned</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
