<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('franchise.products.index') }}" id="filterForm">
                     <div class="row">

                        <div class="col-sm-4 mb-1">
                            <label class="col-form-label" for="name">Product Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name" value="{{ $filter['name'] }}">
                        </div>
                        <div class="col-sm-4 mb-1">
                            <label class="col-form-label" for="model_number">Model Number</label>
                            <input type="text" class="form-control" id="model_number" name="model_number" placeholder="Enter model number" value="{{ $filter['model_number'] }}">
                        </div>
                        <div class="col-sm-4 mb-1">
                            <label class="col-form-label" for="serial_number">Serial Number</label>
                            <input type="text" class="form-control" id="serial_number" name="serial_number" placeholder="Enter serial number" value="{{ $filter['serial_number'] }}">
                        </div>
                        <div class="col-sm-12 mt-2">
                            <div class="d-flex flex-wrap justify-content-end gap-1">

                                
                     
                                <a href="{{ route('franchise.products.index') }}" class="btn btn-sm btn-primary">
                                    <i class="mdi mdi-refresh"></i> Reset
                                </a>
                                <button type="submit" class="btn btn-sm btn-danger" form="filterForm">
                                    <i class="mdi mdi-filter"></i> Filter
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
