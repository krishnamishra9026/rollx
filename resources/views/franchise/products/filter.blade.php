<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('franchise.products.index') }}" id="filterForm">
                    <div class="row">
                        <div class="col-sm-8">

                        <div class="col-sm-6">

                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Product name" value="{{ $filter['name'] }}">

                        </div>


                        <div class="col-sm-6">

                        <a href="{{ route('franchise.products.index') }}" class="btn btn-sm btn-primary me-1"><i
                            class="mdi mdi-refresh"></i> Reset</a>
                            
                        <button type="submit" class="btn btn-sm btn-danger me-1" form="filterForm"><i
                                class="mdi mdi-filter"></i> Filter</button>



                        <button type="submit" class="btn btn-sm btn-success me-1" form="CreateOrders">Create Orders</button>
                        </div>
                    </div>

                        <div class="col-sm-4 mt-2 text-end">
                            Points : <span class="points">{{ auth()->user()->balance }}</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
