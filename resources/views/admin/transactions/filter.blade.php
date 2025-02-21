<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.transactions.index') }}" id="filterForm">

                    <div class="row">
                        <div class="col-sm-3 mb-2">
                            <label class="col-form-label" for="franchise">Franchises</label>
                            <select class="form-select" id="name" name="name">
                                <option value="">All</option>
                                @foreach($franchises as $franchise)
                                 <option value="{{ $franchise->firstname.' '.$franchise->lastname }}" 
                                        {{ request('name') == $franchise->firstname.' '.$franchise->lastname ? 'selected' : '' }}>
                                        {{ $franchise->firstname }} {{ $franchise->lastname }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-sm-12 mb-2">
                            <a href="{{ route('admin.transactions.index') }}" class="btn btn-sm btn-primary float-end me-1"><i  class="mdi mdi-refresh"></i> Reset</a>
                            <button type="submit" class="btn btn-sm btn-danger float-end me-1" form="filterForm"><i  class="mdi mdi-filter"></i> Filter</button>
                        </div>
                       
                    </div>

                
                </form>
            </div>
        </div>
    </div>
</div>
