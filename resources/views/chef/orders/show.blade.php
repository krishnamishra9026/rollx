@extends('layouts.chef')
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
        @include('chef.includes.flash-message')
        <!-- end page title -->
                <div class="row">
            <div class="col-md-6">
                <div class="card" style="min-height: 263px;">
                    <div class="card-header bg-dark text-white">
                        Order Details
                    </div>
                    <div class="card-body">

                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 33.33%">
                                        <span class="fw-bold">Order Id </span>
                                        <br> #{{ $order->id }}
                                    </td>
                                    <td style="width:33.33%" class="text-end">
                                        <span class="fw-bold">Order Date </span><br>
                                        {{ \Carbon\Carbon::parse($order->date)->format('M d, Y') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width:33.30%"><span class="fw-bold">Quantity </span><br>
                                        {{ $order->quantity }}
                                    </td>                             
                                    <td style="width:33.30%" class="text-center"><span class="fw-bold">Sub Total </span><br>
                                        {{ $order->sub_total }}
                                    </td>                            
                                    <td style="width:33.33%" class="text-end">
                                        <span class="fw-bold">Total </span><br>
                                        {{ $order->total }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>

                                    <td style="width:30%"><span class="fw-bold">Status </span><br>
                                        @if ($order->status == 'pending')
                                            <span
                                                class="badge border badge-warning-lighten">{{ ucfirst($order->status) }}</span>
                                        @else
                                            <span
                                                class="badge border badge-success-lighten">{{ ucfirst($order->status) }}</span>
                                        @endif
                                    </td>

                                    <td style="width:70%" class="text-end">
                                        <span class="fw-bold">Date Time </span><br>
                                        {{ \Carbon\Carbon::parse($order->date)->format('d-m-Y H:i A') }}
                                    </td>
                                    
                                </tr>
                            </tbody>
                        </table>
    
                        
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div>

            <div class="col-md-6">
                <div class="card" style="min-height: 263px;">
                    <div class="card-header bg-dark text-white">
                        Franchise Details
                    </div>
                    <div class="card-body">
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width:33.30%"><span class="fw-bold">Name </span><br>
                                        {{ $order->franchise->firstname }} {{ $order->franchise->lastname }}</td>
                                    <td style="width: 50%" class="text-end"><span class="fw-bold">Date Added </span><br>
                                        {{ \Carbon\Carbon::parse($order->franchise->created_at)->format('M d, Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td ><span class="fw-bold">Email Address </span><br>
                                        {{ $order->franchise->email }}</td>
                                </tr>
                            </tbody>
                        </table>


                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                            
                                    <td ><span class="fw-bold">Contact Number </span><br>
                                        {{ $order->franchise->number ?? "" }}</td>
                                </tr>
                            </tbody>
                        </table>


                        </table>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div>

            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped" style="font-size: 14px" id="parts-table">
                        <thead>
                            <tr>
                                <th class="bg-dark text-white text-nowrap">Product ID</th>
                                <th class="bg-dark text-white text-nowrap">Product Name</th>
                                <th class="bg-dark text-white text-nowrap">Qty Avilable</th>
                                <th class="bg-dark text-white text-nowrap">Qty Order</th>
                                <th class="bg-dark text-white text-nowrap">Product My Price</th>
                                <th class="bg-dark text-white text-nowrap">Order Price</th>
                            </tr>
                        </thead>
                        <tbody id="parts-row">
                            <tr>
                                <td>#{{ $order->product->id }}</td>
                                <td>{{ $order->product->name }}</td>
                                <td>{{ $order->product->quantity }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->product->getPriceByFranchise(auth()->user()->id) }}</td>
                                <td>{{ $order->sub_total }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Table Wrapper for Responsiveness -->
                        <div class="table-responsive">
                            <table class="table table-striped" style="font-size: 14px" id="parts-table">
                                <thead>
                                    <tr>
                                        <th class="bg-dark text-white text-nowrap">Date Added</th>
                                        <th class="bg-dark text-white text-nowrap">Comment</th>
                                        <th class="bg-dark text-white text-nowrap">Status Updated By</th>
                                        <th class="bg-dark text-white text-nowrap">Order Status</th>
                                    </tr>
                                </thead>
                                <tbody id="parts-row">
                                    @foreach ($order->histories as $history)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($history->created_at)->format('M d, Y h:i A') }}</td>
                                            <td>{{ $history->comment }}</td>
                                            @if($history->status_changed_by == 'administrator')
                                                <td>{{ \App\Models\Administrator::find($history->status_changer_id)->firstname }} {{ \App\Models\Administrator::find($history->status_changer_id)->lastname }}</td>
                                            @else
                                                <td>{{ \App\Models\Franchise::find($history->status_changer_id)->firstname }} {{ \App\Models\Franchise::find($history->status_changer_id)->lastname }}</td>
                                            @endif
                                            <td>
                                                <h4>
                                                    <span class="badge border badge-danger-lighten">{{ ucfirst($history->status) }}</span>
                                                </h4>
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
