<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.products.index') }}" id="filterForm">
                    <div class="row">
                        <div class="col-sm-4 mb-1">
                            <label class="col-form-label" for="name">Product name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name name" value="{{ $filter['name'] }}">
                        </div>
                        <div class="col-sm-4 mb-1">
                            <label class="col-form-label" for="model_number">Model Number</label>
                            <input type="text" class="form-control" id="model_number" name="model_number" placeholder="Enter model number" value="{{ $filter['model_number'] }}">
                        </div>
                        <div class="col-sm-4 mb-1">
                            <label class="col-form-label" for="serial_number">Serial Number</label>
                            <input type="text" class="form-control" id="serial_number" name="serial_number" placeholder="Enter serial number" value="{{ $filter['serial_number'] }}">
                        </div>
                       
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
