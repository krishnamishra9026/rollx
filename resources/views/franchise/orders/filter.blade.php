<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('franchise.orders.index') }}" id="filterForm">
                    <div class="row">
                        <div class="col-sm-3 mb-2">
                            <label class="col-form-label" for="order_date">Order Date</label>
                            <input type="date" class="form-control" id="order_date" name="order_date" placeholder="Enter Start date" value="{{ $filter['order_date'] }}">
                        </div>

                        <div class="col-sm-3 mb-2">
                            <label class="col-form-label" for="created_at">Date Created</label>
                            <input type="date" class="form-control" id="created_at" name="created_at" placeholder="Enter date" value="{{ $filter['created_at'] }}">
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
                                <option value="PO Generated" {{ $filter['status'] == 'PO Generated'  ? 'selected' : '' }}>PO Generated</option>
                                <option value="In Progress" {{ $filter['status'] == 'In Progress'  ? 'selected' : '' }}>In Progress</option>
                                <option value="Completed" {{ $filter['status'] == 'Completed'  ? 'selected' : '' }}>Completed</option>
                                <option value="Delivered" {{ $filter['status'] == 'Delivered'  ? 'selected' : '' }}>Delivered</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
