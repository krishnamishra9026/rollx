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
            <div class="col-md-12">
                <div class="card" style="min-height: 282px;">
                    <div class="card-header bg-dark text-white">
                        Order Details
                    </div>
                    <div class="card-body">
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 50%"><span class="fw-bold">Project Reference </span><br> {{ $order->description }}</td>
                                    <td style="width: 50%" class="text-end"><span class="fw-bold">Model Number </span><br> {{ $order->model_number }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 50%"><span class="fw-bold">Order Date </span><br> {{ \Carbon\Carbon::parse($order->order_date)->format('M d, Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
               
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
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
