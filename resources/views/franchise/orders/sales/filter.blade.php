<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('franchise.order.sales.index') }}" id="filterForm">
                    <div class="row">

                        <div class="col-sm-4 mb-2">
                            <label class="col-form-label" for="order_date">Order Date</label>
                            <input type="date" class="form-control" id="date" name="order_date" placeholder="Enter Start date" value="{{ $filter['date'] }}">
                        </div>

                        <div class="col-sm-8 mb-2">
                            <label class="col-form-label" for="statuses">Status</label>
                            <select class="form-select" id="statuses" name="status">
                                <option value="">All</option>
                                <option value="Sold" {{ $filter['status'] == 'Sold'  ? 'selected' : '' }}>Sold</option>
                                <option value="Wastage" {{ $filter['status'] == 'Wastage'  ? 'selected' : '' }}>Wastage</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
