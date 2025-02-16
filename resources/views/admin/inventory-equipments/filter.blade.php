<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.inventory-equipment.index') }}" id="filterForm">
                    <div class="row">
                        <div class="col-sm-4 mb-2">
                            <label class="col-form-label" for="name">Model Number</label>
                           <input type="text" class="form-control" id="name" name="name" value="{{ $filter['name'] }}">
                        </div>
                        <div class="col-sm-4 mb-2">
                            <label class="col-form-label" for="serial_number">Serial Number</label>
                           <input type="text" class="form-control" id="serial_number" name="serial_number" value="{{ $filter['serial_number'] }}">
                        </div>
                        <div class="col-sm-4 mb-2" style="margin-top: 45px;">
                            <a href="{{ route('admin.inventory-equipment.create') }}" class="btn btn-sm btn-dark float-end"><i
                                class="mdi mdi-plus"></i> Add
                            Equipment</a>

                            <a href="{{ route('admin.inventory-equipment.index') }}" class="btn btn-sm float-end btn-primary me-1"><i
                                class="mdi mdi-refresh"></i> Reset</a>
                                <button type="submit" class="btn btn-sm btn-danger me-1 float-end" form="filterForm"><i
                                    class="mdi mdi-filter"></i> Filter</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
