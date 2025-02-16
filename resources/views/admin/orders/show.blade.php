@extends('layouts.admin')
@section('title', 'Order Details')

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
                    <h4 class="page-title">Order Details</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <!-- end page title -->
        <div class="row">
            <div class="col-md-6">
                <div class="card" style="min-height: 282px;">
                    <div class="card-header bg-dark text-white">
                        Order Details
                    </div>
                    <div class="card-body">
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 50%"><span class="fw-bold">Product Name </span><br>
                                        {{ $order->product_name }}</td>                                </tr>
                            </tbody>
                        </table>
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    
                                    <td style="width:33.33%" class="text-end"><span class="fw-bold">Order Status </span><br>
                                        @if ($order->status == 'pending')
                                            <span
                                                class="badge border badge-warning-lighten">{{ ucfirst($order->status) }}</span>
                                        @else
                                            <span
                                                class="badge border badge-success-lighten">{{ ucfirst($order->status) }}</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 100%"><span class="fw-bold">Order Description </span><br>
                                        {{ $order->description }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 33.33%"><span class="fw-bold">Order Id </span><br> #{{ $order->id }}
                                    </td>
                                    <td style="width:33.33%" class="text-end"><span class="fw-bold">Order Date </span><br>
                                        {{ \Carbon\Carbon::parse($order->date)->format('M d, Y') }}</td>
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
                                    <td style="width: 50%"><span class="fw-bold">Customer/ Company Name </span><br>
                                        {{ $order->franchise->company }}</td>
                                    <td style="width: 50%"><span class="fw-bold">Date Added </span><br>
                                        {{ \Carbon\Carbon::parse($order->franchise->created_at)->format('M d, Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 50%"><span class="fw-bold">Email Address </span><br>
                                        {{ $order->franchise->email }}</td>
                                    <td style="width: 50%"><span class="fw-bold">Contact Number </span><br>
                                        {{ $order->franchise->contact }}</td>
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
                            <th class="bg-dark text-white">Product ID</th>
                            <th class="bg-dark text-white">Product Name</th>
                            <th class="bg-dark text-white">Qty</th>
                            <th class="bg-dark text-white">Model No</th>
                            <th class="bg-dark text-white">Serial No</th>
                        </tr>
                    </thead>
                    <tbody id="parts-row">
                            <tr>
                                <td>#{{ $order->product_id }}</td>
                                <td>{{ $order->product->name }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->product->model_number }}</td>
                                <td>{{ $order->product->serial_number }}</td>
                            </tr>
                    </tbody>
                </table>
            </div>




                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.orders.add-history', $order->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row mb-2">
                                    <label for="statuses" class="col-sm-2 col-form-label text-sm-start">Order Status</label>
                                    <div class="col-sm-10">
                                        <select id="statuses" class="form-select " name="status">
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                            <option value="processed" {{ $order->status == 'processed' ? 'selected' : '' }}>Processed</option>
                                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                            <option value="refunded" {{ $order->status == 'refunded' ? 'selected' : '' }}>Refunded</option>
                                            <option value="failed" {{ $order->status == 'failed' ? 'selected' : '' }}>Failed</option>
                                            <option value="returned" {{ $order->status == 'returned' ? 'selected' : '' }}>Returned</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="comment"
                                        class="col-md-2 col-form-label text-md-start">{{ __('Comment') }}</label>

                                    <div class="col-md-10">
                                        <textarea name="comment" class="form-control @error('comment') is-invalid @enderror" id="comment" rows="3"
                                            placeholder="Write Comment here">{{ old('comment') }}</textarea>
                                        @error('comment')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-2" style="display: none;">
                                    <label for="notify" class="col-sm-2 col-form-label text-sm-start">Notify
                                        Customer</label>
                                    <div class="col-sm-10">
                                        <select id="notify" class="form-select" name="notify">
                                            <option value="yes">Yes</option>
                                            <option value="no" selected="">No</option>
                                        </select>
                                    </div>
                                </div>
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
                                            <td><a href="{{ route('admin.suppliers.show', $history->status_changer_id) }}">{{ \App\Models\Franchises::find($history->status_changer_id)->firstname }} {{ \App\Models\Franchises::find($history->status_changer_id)->lastname }}</a></td>
                                            @endif
                                            <td>
                                                @if ($history->status == 'pending')
                                                    <span
                                                        class="badge border badge-warning-lighten">{{ ucfirst($history->status) }}</span>
                                                @else
                                                    <span
                                                        class="badge border badge-success-lighten">{{ ucfirst($history->status) }}</span>
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
