@extends('layouts.admin')
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
        @include('admin.includes.flash-message')
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
                                    <td style="width: 50%"><span class="fw-bold">Project Reference </span><br> {{ $purchase_order->project_reference }}</td>
                                    <td style="width: 50%" class="text-end"><span class="fw-bold">Model Number </span><br> {{ $purchase_order->model_number }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 50%"><span class="fw-bold">Order Date </span><br> {{ \Carbon\Carbon::parse($purchase_order->order_date)->format('M d, Y') }}</td>
                                    <td style="width: 50%" class="text-end"><span class="fw-bold">Due Date </span><br> {{ $purchase_order->due_date }} {{ $purchase_order->due_date > 1 ? "Weeks" : "Week" }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 100%"><span class="fw-bold">Order Remarks </span><br>
                                        {{ $purchase_order->remarks ?? "N/A" }}</td>
                                </tr>
                            </tbody>
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
                                    <td style="width: 50%"><span class="fw-bold">Supplier Name </span><br> {{ $purchase_order->supplier->firstname }} {{ $purchase_order->supplier->lastname }}</td>
                                    <td style="width: 50%"><span class="fw-bold">Date Added </span><br> {{ \Carbon\Carbon::parse($purchase_order->supplier->created_at)->format('M d, Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 100%"><span class="fw-bold">Address </span><br> {{ $purchase_order->supplier->address }} {{ $purchase_order->supplier->city }} {{ $purchase_order->supplier->state }} {{ $purchase_order->supplier->country }} {{ $purchase_order->supplier->zipcode }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 50%"><span class="fw-bold">Email Address </span><br> {{ $purchase_order->supplier->email }}</td>
                                    <td style="width: 50%"><span class="fw-bold">Contact Number </span><br> {{ $purchase_order->supplier->phone }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </table>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        Images
                    </div>
                    <div class="card-body text-center">
                        <div class="row">
                            @forelse($purchase_order->images as  $image)
                            <div class="col-sm-4">
                                <img src="{{ asset('storage/uploads/purchase-orders/'.$purchase_order->id.'/images'.'/'.$image->name) }}" width="150px" height="100px" class="me-2 mt-2 mb-2 border">
                                <a href="{{ asset('storage/uploads/purchase-orders/'.$purchase_order->id.'/images'.'/'.$image->name) }}" download="">Download</a>
                            </div>
                            @empty
                                <p class="text-center py-5">No Image found.</p>
                            @endforelse
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
                            @forelse($purchase_order->documents as  $document)
                                <div class="col-sm-4" >
                                    <div class="border mt-2 mb-2 py-4" style="width: 150px; height: 100px;">
                                    <a href="{{ asset('storage/uploads/purchase-orders/'.$purchase_order->id.'/documents'.'/'.$document->name) }}" download="">{{ $document->name }}</a>
                                    </div>
                                    <a href="{{ asset('storage/uploads/purchase-orders/'.$purchase_order->id.'/documents'.'/'.$document->name) }}" download="">Download</a>
                                </div>

                            @empty
                                <p class="text-center py-5">No Document found.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.purchase-orders.add-history', $purchase_order->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                        <div class="row mb-2">
                            <label for="statuses" class="col-sm-2 col-form-label text-sm-start">Order Status</label>
                            <div class="col-sm-10">
                                <select id="statuses" class="form-select " name="status">
                                    <option value="PO Generated" {{ $purchase_order->status == 'PO Generated'  ? 'selected' : '' }}>PO Generated</option>
                                <option value="In Progress" {{ $purchase_order->status == 'In Progress'  ? 'selected' : '' }}>In Progress</option>
                                <option value="Completed" {{ $purchase_order->status == 'Completed'  ? 'selected' : '' }}>Completed</option>
                                <option value="Delivered" {{ $purchase_order->status == 'Delivered'  ? 'selected' : '' }}>Delivered</option>
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
                                    @foreach ($purchase_order->histories as $history)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($history->created_at)->format('M d, Y h:i A') }}</td>
                                            <td>{{ $history->comment }}</td>
                                            @if($history->status_changed_by == 'administrator')
                                        <td><a href="{{ route('admin.admins.show', $history->status_changer_id) }}">{{ \App\Models\Administrator::find($history->status_changer_id)->firstname }} {{ \App\Models\Administrator::find($history->status_changer_id)->lastname }}</a></td>
                                        @else
                                        <td><a href="{{ route('admin.suppliers.show', $history->status_changer_id) }}">{{ \App\Models\Supplier::find($history->status_changer_id)->firstname }} {{ \App\Models\Supplier::find($history->status_changer_id)->lastname }}</a></td>
                                        @endif
                                            <td>
                                                @if($purchase_order->status == 'PO Generated')
                                                <h4>
                                                    <span class="badge border badge-danger-lighten">PO Generated</span>
                                                </h4>
                                            @elseif($purchase_order->status == 'In Progress')
                                                <h4>
                                                    <span class="badge border badge-warning-lighten">In Progress</span>
                                                </h4>
                                            @elseif($purchase_order->status == 'Completed')
                                                <h4>
                                                    <span class="badge border badge-primary-lighten">Completed</span>
                                                </h4>
                                            @else
                                            <h4>
                                                <span class="badge border badge-success-lighten">Delivered</span>
                                            </h4>
                                            @endif
                                            </td>
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
