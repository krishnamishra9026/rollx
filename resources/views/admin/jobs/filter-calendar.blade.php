<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.job-calendar.index') }}" id="filterForm">
                    <div class="row">                       
                        <div class="col-sm-10 mb-2">
                            <label class="col-form-label" for="customer">Customer / Company</label>
                            <select name="customer" id="customer" class="form-select" data-toggle=select2>
                                <option value="">All</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ $customer->id == $filter['customer'] ? 'selected' : '' }}>
                                        {{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>  
                        <div class="col-sm-2 mb-2 text-end">
                            <button type="submit" form="filterForm" class="btn btn-danger"
                                style="margin-top:36px;">Filter</button>
                            <a href="{{ route('admin.job-calendar.index') }}" class="btn btn-primary ms-1"
                                style="margin-top:36px;">Reset</a>
                        </div>                   
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
