@extends('layouts.admin')
@section('title', 'Support')
@section('head')
    <link href="{{ asset('assets/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">                        
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger float-end me-1" style="display: none"
                            id="delete-all">
                            <i class="mdi mdi-delete"></i> {{ __('Delete') }}</a>
                    </div>
                    <h4 class="page-title">Support</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')       
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table class="table table-striped dt-responsive nowrap w-100" style="font-size: 14px;">
                                    <thead class="bg-dark">
                                        <tr>
                                            <th class="all" width="3%">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="all-rows">
                                                    <label class="form-check-label">&nbsp;</label>
                                                </div>
                                            </th>
                                            <th style="width: 37%">Technician</th>                                              
                                            <th style="width: 60%">Message</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($helps as $help)
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input checkbox-row"
                                                            name="rows" id="customCheck{{ $help->id }}"
                                                            value="{{ $help->id }}">
                                                        <label class="form-check-label"
                                                            for="customCheck{{ $help->id }}">&nbsp;</label>
                                                    </div>
                                                </td>
                                                <td> <a href="{{ route('admin.technicians.show', $help->technician_id) }}"
                                                    class="text-body fw-semibold">{{ $help->technician->firstname }} {{ $help->technician->lastname }}</a><br><small>{{ \Carbon\Carbon::parse($help->created_at)->format('M d, Y h:i A') }}</small></td>                                              
                                             <td>{{ $help->message }}</td>                                               
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $helps->appends(request()->query())->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
@endsection
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
                    [0, "asc"]
                ],
                columnDefs: [{
                    targets: [0],
                    visible: !0,
                    searchable: !0
                }],
                columns: [{
                    orderable: !1
                }, {
                    orderable: !0
                }, {
                    orderable: !0
                }]
            })
        });
    </script>

    <script type="text/javascript">
        $("#all-rows").change(function() {
            var c = [];
            this.checked ? ($(".checkbox-row").prop("checked", !0), $("input:checkbox[name=rows]:checked").each(
                function() {
                    c.push($(this).val())
                }), $("#delete-all").css("display", "block")) : ($(".checkbox-row").prop("checked", !1),
                c = [], $("#delete-all").css("display", "none"))
        });

        $(".checkbox-row").change(function() {
            rows = [], $("input:checkbox[name=rows]:checked").each(function() {
                rows.push($(this).val())
            }), 0 == rows.length ? $("#delete-all").css("display", "none") : $("#delete-all").css("display",
                "block")
        });

        $("#delete-all").click(function(e) {
            rows = [], $("input:checkbox[name=rows]:checked").each(function() {
                rows.push($(this).val())
            }), Swal.fire({
                title: "Are you sure?",
                text: "You want to delete selected rows!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Delete selected!"
            }).then(t => {
                t.isConfirmed && ($("#delete-all").text("Deleting..."), e.preventDefault(), $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('admin.support.bulk-delete') }}",
                    data: {
                        helps: rows,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(e) {
                        location.reload()
                    }
                }))
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
