<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.product-prices.index') }}" id="filterForm">
                    <div class="row">
                        <div class="col-sm-3 mb-2">
                            <label class="col-form-label" for="franchise">Franchises</label>
                            <select class="form-select" data-toggle=select2 id="franchise" name="franchise">
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
                            <select class="form-select" data-toggle=select2 id="product" name="product">
                                <option value="">All</option>
                                @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ request('product') == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-12 mb-2">
                            <a href="{{ route('admin.product-prices.create') }}" class="btn btn-sm btn-dark float-end"><i  class="mdi mdi-plus"></i> Price</a>
                            <a href="{{ route('admin.product-prices.index') }}" class="btn btn-sm btn-primary float-end me-1"><i  class="mdi mdi-refresh"></i> Reset</a>
                            <button type="submit" class="btn btn-sm btn-danger float-end me-1" form="filterForm"><i  class="mdi mdi-filter"></i> Filter</button>
                        </div>
                       
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
