<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('chef.order.sales.index') }}" id="filterForm">
                    <div class="row">

                        <div class="col-sm-3 mb-2">
                            <label class="col-form-label" for="order_date">Order Date</label>
                            <input type="date" class="form-control" id="date" name="order_date" placeholder="Enter Start date" value="{{ $filter['date'] }}">
                        </div>

                        <div class="col-sm-3 mb-2">
                            <label class="col-form-label" for="order">Orders</label>
                            <select class="form-select" data-toggle=select2 id="order" name="order">
                                <option value="">All</option>
                                @foreach($orders as $order)
                                <option value="{{ $order->id }}" {{ request('order') == $order->id ? 'selected' : '' }}>
                                    Order #{{ $order->id }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-3 mb-2">
                            <label class="col-form-label" for="product">Products</label>
                            <select class="form-select" data-toggle=select2 id="product" name="product">
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
                            <select class="form-select" data-toggle=select2 id="statuses" name="status">
                                <option value="">All</option>
                                <option value="Sold" {{ $filter['status'] == 'Sold'  ? 'selected' : '' }}>Sold</option>
                                <option value="Wastage" {{ $filter['status'] == 'Wastage'  ? 'selected' : '' }}>Wastage</option>
                            </select>
                        </div>

                        <div class="col-sm-12 mb-2">
                            @isset($order_id)
                            <a href="{{ route('chef.order.sales.create', ['order_id' => $order->id]) }}" class="btn btn-sm btn-dark float-end"><i class="mdi mdi-plus"></i> Sale</a>
                            @else

                            <a href="{{ route('chef.order.sales.create') }}" class="btn btn-sm btn-dark float-end"><i
                                class="mdi mdi-plus"></i> Sale</a>

                            @endisset

                            <a href="{{ route('chef.order.sales.index') }}" class="btn btn-sm btn-primary float-end me-1"><i class="mdi mdi-refresh"></i> Reset</a>
                            
                            <button type="submit" class="btn btn-sm btn-danger float-end me-1" form="filterForm"><i class="mdi mdi-filter"></i> Filter</button>

                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
