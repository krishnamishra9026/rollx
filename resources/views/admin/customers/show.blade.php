@extends('layouts.admin')
@section('title', 'View Company')

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a style="margin-bottom: 10px;" href="{{ url()->previous() }}" class="btn btn-sm btn-dark me-1"><i
                                class="mdi mdi-chevron-double-left me-1" ></i>Back</a>
                    </div>
                    {{-- <h4 class="page-title">{{ $customer->name }}</h4> --}}
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <!-- end page title -->
        <div class="row">
            <div class="col-md-9">
                <div class="card">

                        <div class="row me-0 ms-0">
                            <div class="col-sm-4 bg-dark text-center">
                                <div class="card-body">
                                    <img src="{{ $customer->avatar }}" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                                    <a href="{{ route('admin.customers.edit', $customer->id) }}" class="text-primary mt-2" style="display: block"><i class="fa fa-edit me-1"></i>Edit</a>
                                    <p class="text-white m-0 mt-3 mb-1">Added By : {{ \App\Models\Administrator::find($customer->administrator_id)->firstname }} {{ \App\Models\Administrator::find($customer->administrator_id)->lastname }}</p>
                                    <p class="text-white m-0">{{ \Carbon\Carbon::parse($customer->created_at)->format('M d, Y | h:i:s A') }}</p>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="card-body">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="pb-2"><span class="fw-bold">Company </span><br> {{ $customer->company }} </td>
                                                <td class="ps-5 pb-2"><span class="fw-bold">Contact Person </span><br> {{ $customer->name }}</td>

                                           </tr>
                                           <tr>
                                                <td class="pb-2"><span class="fw-bold">Email</span><br> {{ $customer->email }} </td>
                                                <td class="ps-5 pb-2"><span class="fw-bold">Email (Alternate)</span><br> {{ $customer->alternate_email }}</td>

                                           </tr>
                                            <tr>
                                                <td class="pb-2"><span class="fw-bold">Contact </span><br> {{ $customer->contact }}</td>
                                                <td class="ps-5 pb-2"><span class="fw-bold">Contact (Alternate)</span><br> {{ $customer->alternate_contact }}</td>

                                            </tr>
                                            <tr>
                                                <td class="pb-2"><span class="fw-bold">Address </span><br> {{  $customer->mainAddress ? $customer->mainAddress->address : "" }}</td>
                                                <td class="ps-5 pb-2"><span class="fw-bold">Unit Number </span><br> {{  $customer->mainAddress ? $customer->mainAddress->unit_number : "" }} {{  $customer->mainAddress ? $customer->mainAddress->unit_number : "" }}</td>

                                            </tr>
                                            <tr>
                                                <td class="pb-2"><span class="fw-bold">Postal Code </span><br> {{  $customer->mainAddress ? $customer->mainAddress->zipcode : "" }} {{ $customer->mainAddress ? $customer->mainAddress->zipcode : "" }}</td>
                                                <td class="ps-5 pb-2"><span class="fw-bold">Status </span><br> {{ $customer->status == true ? 'Enabled' : 'Disabled' }}</td>
                                            </tr>


                                        </tbody>
                                    </table>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="pb-2"><span class="fw-bold">Remark </span><br> {{ $customer->remark }} </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                   </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-dark text-white text-center">
                        <h4 class="card-title">Actions</h4>
                    </div>
                    <div class="card-body">
                    <div class="row my-4" style="margin-top:5.6rem !important">
                        <div class="col-sm-12">
                            <div class="d-grid">
                                <a href="{{ route('admin.orders.create', ['customer_id' => $customer->id]) }}" class="btn btn-outline-primary">Create New Equipment Order</a>
                            </div>
                        </div>
                        <div class="col-sm-12 my-2">
                            <div class="d-grid">
                                <a href="{{ route('admin.jobs.create', ['customer_id' => $customer->id]) }}" class="btn btn-outline-success">Create Job</a>
                            </div>
                        </div>
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
        function confirmDelete(e) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Delete it!"
            }).then(t => {
                t.isConfirmed && document.getElementById("delete-form" + e).submit()
            })
        }
    </script>
@endpush
