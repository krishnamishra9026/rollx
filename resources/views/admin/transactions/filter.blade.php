<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.transactions.index') }}" id="filterForm">
                     <div class="row">
                        <div class="col-sm-12 mb-1 d-flex align-items-center">
                            <label class="col-form-label me-2" for="franchise">Franchises:</label>
                            <select class="form-select me-2 w-auto" id="name" name="name">
                                <option value="">All</option>
                                @foreach($franchises as $franchise)
                                    <option value="{{ $franchise->firstname.' '.$franchise->lastname }}" 
                                        {{ request('name') == $franchise->firstname.' '.$franchise->lastname ? 'selected' : '' }}>
                                        {{ $franchise->firstname }} {{ $franchise->lastname }}
                                    </option>
                                @endforeach
                            </select>
                            
                            <button type="submit" class="btn btn-sm btn-danger me-1" form="filterForm">
                                <i class="mdi mdi-filter"></i> Filter
                            </button>
                            <a href="{{ route('admin.transactions.index') }}" class="btn btn-sm btn-primary">
                                <i class="mdi mdi-refresh"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
