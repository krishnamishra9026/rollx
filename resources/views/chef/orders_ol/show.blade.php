@extends('layouts.chef')
@section('title', 'Purchase Order Details')

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark me-1"><i
                                class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                    </div>
                    <h4 class="page-title">Purchase Order Details</h4>
                </div>
            </div>
        </div>
        @include('chef.includes.flash-message')
        <!-- end page title -->
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="min-height: 282px;">
                    <div class="card-header bg-dark text-white">
                        Order Details
                    </div>
                    <div class="card-body">
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 50%"><span class="fw-bold">Project Name </span><br> {{ $order->project_name }}</td>
                                    <td style="width: 50%"><span class="fw-bold">Equipment Name </span><br> {{ $order->equipment_name }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 100%"><span class="fw-bold">Order Description </span><br> {{ $order->description }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 33.33%"><span class="fw-bold">Order Id </span><br> #{{ $order->id }}</td>
                                    <td style="width:33.33%"><span class="fw-bold">Order Date </span><br> {{ \Carbon\Carbon::parse($order->date)->format('M d, Y') }}</td>
                                    <td style="width:33.33%"><span class="fw-bold">Order Status </span><br> @if($purchase_order->status == 'not started')
                                        <span class="badge border badge-warning-lighten">{{ ucfirst($purchase_order->status) }}</span>
                                    @else
                                    <span class="badge border badge-success-lighten">{{ ucfirst($purchase_order->status) }}</span>
                                    @endif</td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 100%"><span class="fw-bold">Quotation Reference </span><br>
                                        {{ $order->quotation_reference ?? "N/A" }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 100%"><span class="fw-bold">Remarks </span><br>
                                        {{ $order->remarks ?? "N/A" }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div>

            <div class="col-md-6">
                <div class="card" style="min-height: 282px;">
                    <div class="card-header bg-dark text-white">
                        Customer Details
                    </div>
                    <div class="card-body">
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 50%"><span class="fw-bold">Customer Name </span><br> {{ $order->customer->name }}</td>
                                    <td style="width: 50%"><span class="fw-bold">Date Added </span><br> {{ \Carbon\Carbon::parse($order->customer->created_at)->format('M d, Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 100%"><span class="fw-bold">Address </span><br> {{ $order->address->address }} {{ $order->address->city }} {{ $order->address->state }} {{ $order->address->country }} {{ $order->address->zipcode }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 50%"><span class="fw-bold">Email Address </span><br> {{ $order->customer->email }}</td>
                                    <td style="width: 50%"><span class="fw-bold">Contact Number </span><br> {{ $order->customer->contact }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </table>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div>

            <div class="col-md-6">
                <div class="card" style="min-height: 282px;">
                    <div class="card-header bg-dark text-white">
                        Supplier Details
                    </div>
                    <div class="card-body">
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 50%"><span class="fw-bold">Supplier Name </span><br> {{ $purchase_order->chef->firstname }} {{ $purchase_order->chef->lastname }}</td>
                                    <td style="width: 50%"><span class="fw-bold">Date Added </span><br> {{ \Carbon\Carbon::parse($purchase_order->chef->created_at)->format('M d, Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 100%"><span class="fw-bold">Address </span><br> {{ $purchase_order->chef->address }} {{ $purchase_order->chef->city }} {{ $purchase_order->chef->state }} {{ $purchase_order->chef->country }} {{ $purchase_order->chef->zipcode }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 50%"><span class="fw-bold">Email Address </span><br> {{ $purchase_order->chef->email }}</td>
                                    <td style="width: 50%"><span class="fw-bold">Contact Number </span><br> {{ $purchase_order->chef->phone }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </table>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div>

            <div class="col-md-12 table-responive">
                <table class="table table-striped" style="font-size: 14px" id="parts-table">
                    <thead>
                        <tr>
                            <th class="bg-dark text-white">Part ID</th>
                            <th class="bg-dark text-white">Part Name</th>
                            <th class="bg-dark text-white">Category</th>
                            <th class="bg-dark text-white">Qty</th>
                            <th class="bg-dark text-white">Model No</th>
                            <th class="bg-dark text-white">Serial No</th>
                            <th class="bg-dark text-white">Installation Date</th>
                            <th class="bg-dark text-white">Warranty Upto</th>
                        </tr>
                    </thead>
                    <tbody id="parts-row">
                        @foreach ($order->parts as $part)
                            <tr>
                                <td>#{{ $part->part_id }}</td>
                                <td>{{ $part->part->part }}</td>
                                <td>{{ $part->part->category->category }}</td>
                                <td>{{ $part->quantity }}</td>
                                <td>{{ $part->part->model_number }}</td>
                                <td>{{ $part->part->serial_number }}</td>
                                <td>{{ \Carbon\Carbon::parse($part->installation_date)->format('M d, Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($part->warranty_upto)->format('M d, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        Images
                    </div>
                    <div class="card-body text-center">
                        <div class="row">
                            @foreach($order->images as  $image)
                            <div class="col-sm-4">
                                <img src="{{ asset('storage/uploads/orders/'.$order->id.'/images'.'/'.$image->name) }}" width="150px" height="100px" class="me-2 mt-2 mb-2 border">
                                <a href="{{ asset('storage/uploads/orders/'.$order->id.'/images'.'/'.$image->name) }}" download="">Download</a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        Documents
                    </div>
                    <div class="card-body text-center">
                        <div class="row">
                            @foreach($order->documents as  $document)
                                <div class="col-sm-4" >
                                    <div class="border mt-2 mb-2 py-4" style="width: 150px; height: 100px;">
                                    <a href="{{ asset('storage/uploads/orders/'.$order->id.'/documents'.'/'.$document->name) }}" download="">{{ $document->name }}</a>
                                    </div>
                                    <a href="{{ asset('storage/uploads/orders/'.$order->id.'/documents'.'/'.$document->name) }}" download="">Download</a>
                                </div>

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('chef.purchase-orders.add-history', $purchase_order->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                        <div class="row mb-2">
                            <label for="statuses" class="col-sm-2 col-form-label text-sm-start">Order Status</label>
                            <div class="col-sm-10">
                                <select id="statuses" class="form-select " name="status">
                                    <option value="PO Generated" {{ $order->status == 'PO Generated' ? "selected" : "" }}>Not Started</option>
                                    <option value="25% Assembled" {{ $order->status == '25% Assembled' ? "selected" : "" }}>25% Assembled</option>
                                    <option value="50% Assembled" {{ $order->status == '50% Assembled' ? "selected" : "" }}>50% Assembled</option>
                                    <option value="100% Assembled" {{ $order->status == '100% Assembled' ? "selected" : "" }}>100% Assembled</option>
                                    <option value="shipped" {{ $order->status == 'shipped' ? "selected" : "" }}>Shipped</option>
                                    <option value="completed" {{ $order->status == 'completed' ? "selected" : "" }}>Completed</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="comment"
                                class="col-md-2 col-form-label text-md-start">{{ __('Comment') }}</label>

                            <div class="col-md-10">
                                <textarea name="comment" class="form-control @error('comment') is-invalid @enderror" id="comment"
                                    rows="3" placeholder="Write Comment here">{{ old('comment') }}</textarea>
                                @error('comment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="row mb-2">
                            <label for="notify" class="col-sm-2 col-form-label text-sm-start">Notify Customer</label>
                            <div class="col-sm-10">
                                <select id="notify" class="form-select" name="notify">
                                    <option value="yes">Yes</option>
                                    <option value="no" selected="">No</option>
                                </select>
                            </div>
                        </div> --}}
                        <div class="row mb-2">
                            <div class="col-sm-12 text-end">
                                <button type="submit" class="btn btn-sm btn-primary">Add History</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12 table-responive">
                            <table class="table table-striped" style="font-size: 14px" id="parts-table">
                                <thead>
                                    <tr>
                                        <th class="bg-dark text-white">Date Added</th>
                                        <th class="bg-dark text-white">Comment</th>
                                        <th class="bg-dark text-white">Status Updated By</th>
                                        <th class="bg-dark text-white">Order Status</th>
                                    </tr>
                                </thead>
                                <tbody id="parts-row">
                                    @foreach ($order->histories as $history)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($history->created_at)->format('M d, Y h:i A') }}</td>
                                            <td>{{ $history->comment }}</td>
                                            @if($history->status_changed_by == 'administrator')
                                        <td><a href="{{ route('admin.admins.show', $history->status_changer_id) }}">{{ \App\Models\Administrator::find($history->status_changer_id)->firstname }} {{ \App\Models\Administrator::find($history->status_changer_id)->lastname }}</a></td>
                                        @else
                                        <td><a href="{{ route('admin.chefs.show', $history->status_changer_id) }}">{{ \App\Models\Supplier::find($history->status_changer_id)->firstname }} {{ \App\Models\Supplier::find($history->status_changer_id)->lastname }}</a></td>
                                        @endif
                                            <td>@if($history->status == 'pending')
                                                <span class="badge border badge-warning-lighten">{{ ucfirst($history->status) }}</span>
                                            @else
                                            <span class="badge border badge-success-lighten">{{ ucfirst($history->status) }}</span>
                                            @endif</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div> <!-- container -->


@endsection
@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmGenerateOrder(e) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Generate PO!"
            }).then(t => {
                t.isConfirmed && document.getElementById("purchase-form" + e).submit()
            })
        }
    </script>
@endpush
