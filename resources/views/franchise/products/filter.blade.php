<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('franchise.products.index') }}" id="filterForm">
                    <div class="row">
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Product name" value="{{ $filter['name'] }}">
                        </div>
                        <div class="col-sm-8 mt-2 text-end">
                            Points : <span class="points">{{ auth()->user()->balance }}</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
