<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.warehouse-items.index') }}" id="filterForm">
                    <div class="row">
                        <div class="col-sm-4 mb-1">
                            <label class="col-form-label" for="name">Product name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name name" value="{{ $filter['name'] }}">
                        </div>

                        <div class="col-sm-12 mb-2">
                            <a href="{{ route('admin.warehouse-items.index') }}" class="btn btn-sm btn-primary float-end me-1"><i  class="mdi mdi-refresh"></i> Reset</a>
                            <button type="submit" class="btn btn-sm btn-danger float-end me-1" form="filterForm"><i  class="mdi mdi-filter"></i> Filter</button>
                        </div>
                       
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
