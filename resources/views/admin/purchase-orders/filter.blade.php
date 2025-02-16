<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.purchase-orders.index') }}" id="filterForm">
                    <div class="row">
                        <div class="col-sm-4 mb-2">
                            <label class="col-form-label" for="model_number">Model No</label>
                            <input type="text" class="form-control" id="model_number" name="model_number" placeholder="Enter Model No" value="{{ $filter['model_number'] }}">
                        </div>
                        <div class="col-sm-4 mb-2">
                            <label class="col-form-label" for="order_date">Order Date</label>
                            <input type="date" class="form-control" id="order_date" name="order_date" placeholder="Enter Start date" value="{{ $filter['order_date'] }}">
                        </div>
                        <div class="col-sm-4 mb-2">
                            <label class="col-form-label" for="due_date">Due Date</label>
                          <select name="due_date" id="due_date" class="form-select">
                            <option value="">All</option>
                            @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ $filter['due_date'] == $i ? 'selected' : '' }}>{{ $i }} {{ $i > 1 ? "Weeks" : "Week" }}</option>
                            @endfor
                          </select>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <label class="col-form-label" for="created_at">Date Created</label>
                            <input type="date" class="form-control" id="created_at" name="created_at" placeholder="Enter date" value="{{ $filter['created_at'] }}">
                        </div>

                        <div class="col-sm-8 mb-2">
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
