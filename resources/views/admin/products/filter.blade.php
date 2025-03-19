<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.products.index') }}" id="filterForm">
                     <div class="row">

                        <div class="col-sm-4 mb-2">
                            <label class="col-form-label" for="product">Products</label>
                            <select class="form-select" data-toggle=select2 id="product" name="product">
                                <option value="">All</option>
                                @foreach($product_data as $product)
                                <option value="{{ $product->id }}" {{ request('product') == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-4 mb-1">
                            <label class="col-form-label" for="outlet_name">Outlet Name</label>
                            <input type="text" class="form-control" id="outlet_name" name="outlet_name" placeholder="Enter Outlet Name" value="{{ $filter['outlet_name'] }}">
                        </div>

                        <div class="col-sm-12 mt-2">
                            <div class="d-flex flex-wrap justify-content-end gap-1">
                                <button type="submit" class="btn btn-sm btn-danger" form="filterForm">
                                    <i class="mdi mdi-filter"></i> Filter
                                </button>
                                 <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-primary">
                                    <i class="mdi mdi-refresh"></i> Reset
                                </a>

                                <a href="{{ route('admin.product.quantity') }}" class="btn btn-sm btn-secondary float-end"><i  class="mdi mdi-plus"></i> Quantity</a>

                                <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-dark">
                                    <i class="mdi mdi-plus"></i> Product
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
