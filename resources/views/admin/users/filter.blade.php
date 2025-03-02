<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.users.index') }}">
                    <div class="row">
                        <div class="col-sm-3 mb-2">
                            <label for="name">Name</label>
                            <input type="text" class="form-control form-control-sm" id="name" name="name"
                                value="{{ $filter['name'] }}">
                        </div>
                        <div class="col-sm-3 mb-2">
                            <label for="email">Email</label>
                            <input type="email" class="form-control form-control-sm" id="email" name="email"
                                value="{{ $filter['email'] }}">
                        </div>
                        <div class="col-sm-3 mb-2">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control form-control-sm" id="phone" name="phone"
                                value="{{ $filter['phone'] }}">
                        </div>
                        <div class="col-sm-3 mb-2">
                            <label for="name">Status</label>
                            <select name="status" id="statuses" class="form-select form-control-sm">
                                <option value=""></option>
                                <option value="Yes" {{ $filter['status'] == 'Yes' ? 'selected' : '' }}>Enabled
                                </option>
                                <option value="No" {{ $filter['status'] == 'No' ? 'selected' : '' }}>Disabled
                                </option>
                            </select>
                        </div>
                        <div class="col-sm-12 text-end">
                            @can('Create User')
                                <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-dark"><i class="mdi mdi-plus"></i> User</a>
                            @endcan

                            <button type="submit" class="btn btn-sm btn-danger"><i class="mdi mdi-filter"></i> Filter</button>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-primary"><i class="mdi mdi-refresh"></i>  Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
