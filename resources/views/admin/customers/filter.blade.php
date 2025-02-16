<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.customers.index') }}" id="filterForm">
                    <div class="row">
                        <div class="col-sm-3 mb-2">
                            <label class="col-form-label" for="company">Customer / Company</label>
                            <input type="text" class="form-control form-control-sm" id="company" name="company" placeholder="Enter customer / company" value="{{ $filter['company'] }}">
                        </div>
                        <div class="col-sm-3 mb-2">
                            <label class="col-form-label" for="name">Contact Person</label>
                            <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Enter contact person" value="{{ $filter['name'] }}">
                        </div>
                        <div class="col-sm-3 mb-2">
                            <label class="col-form-label" for="address">Address</label>
                            <input type="text" class="form-control form-control-sm" id="address" name="address" placeholder="Enter address" value="{{ $filter['address'] }}">
                        </div>
                        <div class="col-sm-3 mb-2">
                            <label class="col-form-label" for="contact">Contact</label>
                            <input type="text" class="form-control form-control-sm" id="contact" name="contact" placeholder="Enter contact number" value="{{ $filter['contact'] }}">
                        </div>
                        <div class="col-sm-3 mb-2">
                            <label class="col-form-label" for="email">Email</label>
                            <input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="Enter email address" value="{{ $filter['email'] }}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
