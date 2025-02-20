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
                            <label class="col-form-label" for="franchise">Franchises</label>
                            <select class="form-select" id="franchise" name="franchise">
                                <option value="">All</option>
                                @foreach($franchises as $franchise)
                                <option value="{{ $franchise->id }}" {{ request('franchise') == $franchise->id ? 'selected' : '' }}>
                                    {{ $franchise->firstname }} {{ $franchise->lastname }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-3 mb-2">
                            <label class="col-form-label" for="product">Products</label>
                            <select class="form-select" id="product" name="product">
                                <option value="">All</option>
                                @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ request('product') == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                                @endforeach
                            </select>
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

                        <div class="col-sm-12">
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-primary float-end me-1"><i
                                class="mdi mdi-refresh"></i> Reset</a>
                        <button type="submit" class="btn btn-sm btn-danger float-end me-1" form="filterForm"><i
                                class="mdi mdi-filter"></i> Filter</button>
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger float-end me-1" style="display: none"
                            id="delete-all">
                            <i class="mdi mdi-delete"></i> {{ __('Delete') }}</a>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
