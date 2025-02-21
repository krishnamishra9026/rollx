<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('franchise.products.index') }}" id="filterForm">
                    <div class="row align-items-center">
                        <!-- Input field -->
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Product name" value="{{ $filter['name'] }}">
                        </div>

                        <!-- Buttons -->
                        <div class="col-md-5 d-flex gap-2">
                            <a href="{{ route('franchise.products.index') }}" class="btn btn-sm btn-primary">
                                <i class="mdi mdi-refresh"></i> Reset
                            </a>
                            <button type="submit" class="btn btn-sm btn-danger" form="filterForm">
                                <i class="mdi mdi-filter"></i> Filter
                            </button>
                            <button type="submit" class="btn btn-sm btn-success" form="CreateOrders">
                                Create Orders
                            </button>
                        </div>

                        <!-- Points display -->
                        <div class="col-md-3 text-end">
                            Points: <span class="points">{{ auth()->user()->balance }}</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

