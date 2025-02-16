<html>

<head>
    <meta charset="utf-8">
    <title>EPOD</title>

    <style>
        .table tbody tr th {
            width: 15%;
            line-height: 35px;
            vertical-align: top;
            border: 1px solid #ddd;
            padding: 0px 10px;
        }
        .table tbody tr td {
            width: 85%;
            line-height: 35px;
            vertical-align: top;
            border: 1px solid #ddd;
            padding: 0px 10px;
        }
    </style>

</head>

<body>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="sheri coll" style="text-align: center;padding-bottom:15px;">
                    <img src="{{ public_path() . '/assets/images/logo.png' }}">
                    {{--  <img src="{{ '/assets/images/logo.png' }}">  --}}
                </div>
            </div>
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered" cellspacing="0" cellpadding="0" style="width: 100%;border: 1px solid #ddd;">
                                        <tbody>

                                            <tr>
                                                <th class="fw-bold" style="text-align: left; width: 15%;
                                                vertical-align: top;
                                                border: 1px solid #ddd;
                                                padding: 5px 10px;">Job Id</th>
                                                <td style="text-align: left;width: 85%;
                                                vertical-align: top;
                                                border: 1px solid #ddd;
                                                padding: 5px 10px;">{{ $job->id }}</td>
                                            </tr>
                                            <tr>
                                                <th class="fw-bold" style="text-align: left; width: 15%;
                                                vertical-align: top;
                                                border: 1px solid #ddd;
                                                padding: 5px 10px;">Customer</th>
                                                <td style="text-align: left;width: 85%;
                                                vertical-align: top;
                                                border: 1px solid #ddd;
                                                padding: 5px 10px;">
                                                    <a href="{{ route('admin.customers.show', $job->user_id) }}"
                                                        class="text-body fw-semibold">{{ $job->customer->name }}</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="fw-bold" style="text-align: left; width: 15%;
                                                vertical-align: top;
                                                border: 1px solid #ddd;
                                                padding: 5px 10px;">Service Type</th>
                                                <td style="text-align: left;width: 85%;
                                                vertical-align: top;
                                                border: 1px solid #ddd;
                                                padding: 5px 10px;">
                                                    {{ $job->equipment->equipment_name }},
                                                    {{ $job->jobType->type }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="fw-bold" style="text-align: left; width: 15%;
                                                vertical-align: top;
                                                border: 1px solid #ddd;
                                                padding: 5px 10px;">Schedule</th>
                                                <td style="text-align: left;width: 85%;
                                                vertical-align: top;
                                                border: 1px solid #ddd;
                                                padding: 5px 10px;">{{ \Carbon\Carbon::parse($job->start_date)->format('M d, Y') }},
                                                    {{ \Carbon\Carbon::parse($job->start_time)->format('h:i A') }},
                                                    {{ \Carbon\Carbon::parse($job->end_time)->format('h:i A') }}</td>
                                            </tr>
                                            <tr>
                                                <th class="fw-bold" style="text-align: left; width: 15%;
                                                vertical-align: top;
                                                border: 1px solid #ddd;
                                                padding: 5px 10px;">Address</th>
                                                <td class="text-start" style="text-align: left;width: 85%;
                                                vertical-align: top;
                                                border: 1px solid #ddd;
                                                padding: 5px 10px;">
                                                    {{ $job->address->address }}
                                                    {{ $job->address->city }}
                                                    {{ $job->address->country }},
                                                    {{ $job->address->zipcode }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="fw-bold" style="text-align: left; width: 15%;
                                                vertical-align: top;
                                                border: 1px solid #ddd;
                                                padding: 5px 10px;">Status</th>
                                                <td style="text-align: left;width: 85%;
                                                vertical-align: top;
                                                border: 1px solid #ddd;
                                                padding: 5px 10px;">
                                                    @if ($job->status == 'pending')
                                                        <h4 style="margin-top: 0;margin-bottom: 0;">
                                                            <span
                                                                class="badge border badge-warning-lighten">{{ ucfirst($job->status) }}</span>
                                                        </h4>
                                                    @else
                                                        <h4 style="margin-top: 0;margin-bottom: 0;">
                                                            <span
                                                                class="badge border badge-success-lighten">{{ ucfirst($job->status) }}</span>
                                                        </h4>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="fw-bold" style="text-align: left; width: 15%;
                                                vertical-align: top;
                                                border: 1px solid #ddd;
                                                padding: 5px 10px;">Technician</th>
                                                <td style="text-align: left;width: 85%;
                                                vertical-align: top;
                                                border: 1px solid #ddd;
                                                padding: 5px 10px;">
                                                    <a href="{{ route('admin.technicians.show', $job->technician_id) }}"
                                                        class="text-body fw-semibold">{{ $job->technician->firstname }}
                                                        {{ $job->technician->lastname }}</a>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
               <div class="signa" style="text-align: center;margin-top: 20px;margin-bottom: 20px;">
                <img src="{{ $job->signature->signature }}" width="200px" height="200px" style="border:1px solid #777"
                class="downloadable" />
               </div>
            </div>
            <div class="col-md-12">
                @foreach ($job->proof as $proof)
                    <div class="sheri coll" style="text-align: center;margin-top: 20px;margin-bottom: 20px;">
                        <img src="{{ asset('storage/uploads/jobs/' . $job->id . '/proof' . '/' . $proof->photo) }}"
                            width="200px" height="200px" />
                        <br />
                    </div>
                @endforeach
            </div>
        </div>


        </div>



    </section>

    @push('scripts')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{ asset('assets/js/vendor/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/vendor/dataTables.bootstrap4.js') }}"></script>
        <script src="{{ asset('assets/js/vendor/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('assets/js/vendor/responsive.bootstrap4.min.js') }}"></script>


        <!-- Datatable Init js -->
        <script>
            $(function() {
                $("#basic-datatable").DataTable({
                    paging: !1,
                    pageLength: 20,
                    lengthChange: !1,
                    searching: !1,
                    ordering: !0,
                    info: !1,
                    autoWidth: !1,
                    responsive: !0,
                    order: [
                        [0, "desc"]
                    ],
                    columnDefs: [{
                        targets: [0],
                        visible: !0,
                        searchable: !0
                    }],
                    columns: [{
                        orderable: !0,
                    }, {
                        orderable: !0,
                    }, {
                        orderable: !0,
                    }, {
                        orderable: !0
                    }, {
                        orderable: !0
                    }, {
                        orderable: !0
                    }, {
                        orderable: !0
                    }, {
                        orderable: !1
                    }, ]
                })
            });

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
</body>


</html>
