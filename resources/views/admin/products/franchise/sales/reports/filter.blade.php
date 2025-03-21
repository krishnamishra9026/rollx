<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.product.franchise.sales.reports.index') }}" id="filterForm">
                    <div class="row">

                        <div class="col-sm-2 mb-2">
                            <label class="col-form-label" for="product">Date</label>
                            <input type="date" name="date" value="{{ request('date') }}" class="form-control">
                        </div>

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
                            <label class="col-form-label" for="product">Product</label>
                            <select class="form-select" data-toggle=select2 id="product" name="product">
                                <option value="">All</option>
                                @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ request('product') == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-2 mb-2">
                            <label class="col-form-label" for="product">From Date</label>
                            <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
                        </div>

                        <div class="col-sm-2 mb-2">
                            <label class="col-form-label" for="product">To Date</label>
                            <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
                        </div>

                        <div class="col-sm-12 mb-1 mt-1 text-end">

                            <div class="page-title-box">

                                <a href="{{ route('admin.product.franchise.sales.reports.index') }}" class="btn btn-sm btn-primary float-end me-1"><i class="mdi mdi-refresh"></i> Reset</a>

                                <button type="submit" class="btn btn-sm btn-danger float-end me-1" form="filterForm"><i class="mdi mdi-filter"></i> Filter</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
