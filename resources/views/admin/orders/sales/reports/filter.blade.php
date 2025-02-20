<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.sale.reports.index') }}" id="filterForm">
                    <div class="row">

                        <div class="col-sm-4 mb-2">
                            <label class="col-form-label" for="order_date">Order Date</label>
                            <input type="date" class="form-control" id="date" name="order_date" placeholder="Enter Start date" value="{{ $filter['date'] }}">
                        </div>

                        

                        <div class="col-sm-4 mb-2">
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

                       

                        <div class="col-sm-4 mb-2">
                            <label class="col-form-label" for="statuses">Status</label>
                            <select class="form-select" id="statuses" name="status">
                                <option value="">All</option>
                                <option value="Sold" {{ $filter['status'] == 'Sold'  ? 'selected' : '' }}>Sold</option>
                                <option value="Wastage" {{ $filter['status'] == 'Wastage'  ? 'selected' : '' }}>Wastage</option>
                            </select>
                        </div>

                        <div class="col-sm-12 mb-1 mt-1 text-end">

                            <div class="page-title-box">

                                <a href="{{ route('admin.sale.reports.index') }}" class="btn btn-sm btn-primary float-end me-1"><i class="mdi mdi-refresh"></i> Reset</a>

                                <button type="submit" class="btn btn-sm btn-danger float-end me-1" form="filterForm"><i class="mdi mdi-filter"></i> Filter</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
