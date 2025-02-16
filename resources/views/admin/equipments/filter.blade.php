<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.equipments.index') }}" id="filterForm">
                    <div class="row">
                        <div class="col-sm-3 mb-2">
                            <label class="col-form-label" for="name">Model Number</label>
                           <input type="text" class="form-control" id="name" name="name" value="{{ $filter['name'] }}">
                        </div>
                        <div class="col-sm-3 mb-2">
                            <label class="col-form-label" for="serial_number">Serial Number</label>
                           <input type="text" class="form-control" id="serial_number" name="serial_number" value="{{ $filter['serial_number'] }}">
                        </div>
                        <div class="col-sm-3 mb-2">
                            <label class="col-form-label" for="name">Customer / Company</label>
                            <select name="customer" id="customer" class="form-select" data-toggle=select2>
                                <option value="">All</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ $customer->id == $filter['customer'] ? 'selected' : '' }}>
                                        {{ $customer->company }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3 mb-2">
                            <label class="col-form-label" for="address">Installation Address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" value="{{ $filter['address'] }}">
                        </div>
                        <div class="col-sm-3 mb-2">
                            <label class="col-form-label" for="date">Installation Date</label>
                            <input type="date" class="form-control" id="date" name="date" placeholder="Enter date" value="{{ $filter['date'] }}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
