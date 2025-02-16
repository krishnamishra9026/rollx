<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.jobs.index') }}" id="filterForm">
                    <div class="row">
                        <div class="col-sm-3 mb-2">
                            <label class="col-form-label" for="customer">Customer / Company</label>
                            <select name="customer" id="customer" class="form-select" data-toggle=select2>
                                <option value="">All</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ $customer->id == $filter['customer'] ? 'selected' : '' }}>
                                        {{ $customer->company }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3 mb-2">
                            <label class="col-form-label" for="equipment">Equipment</label>
                            <select name="equipment" id="equipment" class="form-select" data-toggle=select2>
                                <option value="">All</option>
                                @foreach ($equipments as $equipment)
                                    <option value="{{ $equipment->id }}" {{ $equipment->id == $filter['equipment'] ? 'selected' : '' }}>
                                        {{ $equipment->equipment_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3 mb-2">
                            <label class="col-form-label" for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" value="{{ $filter['address'] }}">
                        </div>
                        <div class="col-sm-3 mb-2">
                            <label class="col-form-label" for="technician">Technician</label>
                            <select name="technician" id="technician" class="form-select" data-toggle=select2>
                                <option value="">All</option>
                                @foreach ($technicians as $technician)
                                    <option value="{{ $technician->id }}" {{ $technician->id == $filter['technician'] ? 'selected' : '' }}>
                                        {{ $technician->firstname }} {{ $technician->lastname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3 mb-2">
                            <label class="col-form-label" for="service_type">Service Type</label>
                            <select name="service_type" id="service_type" class="form-select" data-toggle=select2>
                                <option value="">All</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}" {{ $service->id == $filter['service_type'] ? 'selected' : '' }}>
                                        {{ $service->type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3 mb-2">
                            <label class="col-form-label" for="start_date">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" placeholder="Choose Start date" value="{{ $filter['start_date'] }}">
                        </div>
                        <div class="col-sm-3 mb-2">
                            <label class="col-form-label" for="end_date">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="date" placeholder="Enter End date" value="{{ $filter['end_date'] }}">
                        </div>

                        <div class="col-sm-3 mb-2">
                            <label class="col-form-label" for="statuses">Status</label>
                            <select class="form-select" id="statuses" name="status">
                                <option value="">All</option>
                                <option value="pending" {{ $filter['status'] == 'pending'  ? 'selected' : '' }}>Pending Jobs</option>
                                <option value="completed" {{ $filter['status'] == 'completed' ? 'selected' : '' }}>Completed Jobs</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
