<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.leads.index') }}">
                    <input type="hidden" name="status" value="{{ request()->get('status') }}"/>
                    <div class="row">
                        <div class="col-sm-4 mb-2">
                            <label for="name">Name</label>
                            <input type="text" class="form-control form-control-sm" id="name" name="name" value="{{ $filter['name'] }}">
                        </div>
                        <div class="col-sm-4 mb-2">
                            <label for="email">Email</label>
                            <input type="email" class="form-control form-control-sm" id="email" name="email" value="{{ $filter['email'] }}">
                        </div>
                        <div class="col-sm-4 mb-2">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control form-control-sm" id="phone" name="phone" value="{{ $filter['phone'] }}">
                        </div>                                                
                        <div class="col-sm-12 d-flex flex-wrap justify-content-end gap-1">
                            
                            <button type="submit" class="btn btn-sm btn-danger"> <i class="mdi mdi-filter"></i> Filter</button>
                            <a href="{{ route('admin.leads.index', ['status' => request()->get('status')]) }}" class="btn btn-sm btn-primary"> <i class="mdi mdi-refresh"></i> Reset</a>
                            <a href="{{ route('admin.leads.assign-leads') }}" class="btn btn-sm btn-dark"><i class="mdi mdi-account-arrow-right"></i> Leads</a>
                            @can('View Leads')
                                <a href="{{ route('admin.leads.create') }}" class="btn btn-sm btn-secondary"><i class="mdi mdi-plus"></i> Lead</a>
                            @endcan
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
