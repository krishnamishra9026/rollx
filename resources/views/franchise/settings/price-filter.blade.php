<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('franchise.settings.products-price') }}" id="filterForm">

                    <div class="row">
                        <div class="col-sm-3 mb-2">
                            <label class="col-form-label" for="product">Products</label>
                            <select class="form-select" data-toggle=select2 id="product" name="product">
                                <option value="">All</option>
                                @foreach($product_list as $product)
                                    <option value="{{ $product->id }}" 
                                        {{ request('product') == $product->id ? 'selected' : '' }}>
                                        {{ $product->name }} 
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-sm-12 mb-2">
                            <a href="{{ route('franchise.settings.products-price') }}" class="btn btn-sm btn-primary float-end me-1"><i  class="mdi mdi-refresh"></i> Reset</a>
                            <button type="submit" class="btn btn-sm btn-danger float-end me-1" form="filterForm"><i  class="mdi mdi-filter"></i> Filter</button>
                        </div>
                       
                    </div>

                
                </form>
            </div>
        </div>
    </div>
</div>
