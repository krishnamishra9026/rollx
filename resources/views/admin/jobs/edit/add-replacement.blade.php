<div class="modal fade" id="add-replacement-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Part Details</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped" style="font-size: 14px" id="parts-table">
                            <thead>
                                <tr>
                                    <th class="bg-dark text-white">Part ID</th>                                                               
                                    <th class="bg-dark text-white">Category</th>
                                    <th class="bg-dark text-white">Part Name</th>
                                    <th class="bg-dark text-white">Qty</th>        
                                </tr>
                            </thead>
                            <tbody id="parts-row">
                                <tr>
                                    <td id="part_id"></td>
                                    <td id="category"></td>
                                    <td id="part"></td>                                                                    
                                    <td id="quantity"></td>                                                                                                  
                                </tr>
                            </tbody>
                        </table>
                    </div>                   
                </div>  

                <form action="{{ route('admin.jobs.save-parts-replacement', $job->id) }}" method="POST"  enctype="multipart/form-data" id="replacementForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="part_id" id="specific_part_id">
                    <div class="row mb-2">
                         <label class="col-md-3 col-form-label text-md-start">{{ __('Part Name') }}</label>
                      {{-- 
                        <div class="col-md-9">
                            <input type="text"
                                class="form-control"
                            id="part_name" readonly>                        
                        </div>  --}}
                        <div class="col-md-9">
                        <select class="form-select" name="part_name" id="part_name">
                               
                        </select>
                    </div>
                    </div>  
                    <div class="row mb-2">
                        <label class="col-md-3 col-form-label text-md-start">{{ __('New Quantity') }}</label>

                        <div class="col-md-9">
                            <input type="number"
                                class="form-control"
                                name="quantity" id="new_quantity" placeholder="Choose New Quantity"
                                value="{{ old('quantity') }}" value="" required>                        
                        </div>
                    </div>            
                    {{-- <div class="row mb-2">
                        <label class="col-md-3 col-form-label text-md-start">{{ __('New Installation Date') }}</label>

                        <div class="col-md-9">
                            <input type="text"
                                class="form-control"
                                name="installation_date" id="new_installation_date" placeholder="Choose New Installation Date"
                                value="{{ old('installation_date') }}" required>                        
                        </div>
                    </div> --}}
                    {{-- <div class="row mb-2">
                        <label class="col-md-3 col-form-label text-md-start">{{ __('New Warranty Upto') }}</label>

                        <div class="col-md-9">
                            <input type="text"
                                class="form-control"
                                name="warranty_upto" id="new_warranty_upto" placeholder="Choose New Warranty Upto"
                                value="{{ old('warranty_upto') }}" required>                       
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-sm btn-danger" form="replacementForm"><i
                                class="mdi mdi-database me-1"></i>Replace Part</button>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>