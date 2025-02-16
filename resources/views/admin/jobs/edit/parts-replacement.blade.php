@extends('layouts.admin')
@section('title', 'Edit Job')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ route('admin.jobs.edit', $job->id) }}" class="btn btn-sm btn-primary me-1"><i
                                class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                        <a href="{{ route('admin.jobs.index') }}" class="btn btn-sm btn-success me-1"><i
                                class="mdi mdi-database me-1"></i>Save</a>
                    </div>
                    <h4 class="page-title">Edit Job</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <!-- end page title -->
        <div class="row">
            <form id="jobForm" method="POST" action="{{ route('admin.jobs.save-parts-replacement', $job->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <ul class="nav nav-tabs nav-bordered mb-3">
                                        <li class="nav-item">
                                            <a href="{{ route('admin.jobs.edit', $job->id) }}" class="nav-link">
                                                <span>Job Details</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('admin.jobs.parts-replacement', $job->id) }}"
                                                class="nav-link active">
                                                <span>Parts Replacement</span>
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="tab-content">
                                        <div class="tab-pane show active" id="job-details-tab">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h4>{{ $job->equipment->equipment_name }} - Part Details</h4>
                                                </div>
                                                <div class="col-md-12 table-responive">
                                                    <table class="table table-striped" style="font-size: 14px"
                                                        id="parts-table">
                                                        <thead>
                                                            <tr>
                                                                <th class="bg-dark text-white">Part ID</th>
                                                                <th class="bg-dark text-white">Category</th>
                                                                <th class="bg-dark text-white">Part Name</th>
                                                                <th class="bg-dark text-white">Qty</th>
                                                                {{-- <th class="bg-dark text-white">Installation Date</th>
                                                                <th class="bg-dark text-white">Warranty Upto</th> --}}
                                                                <th class="bg-dark text-white"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="parts-row">
                                                            @foreach ($job->equipment->parts as $part)
                                                                @if ($part->replace == 0)
                                                                    <tr>
                                                                        <td>#{{ $part->part_id }}</td>
                                                                        <td>{{ $part->part->category->category }}</td>
                                                                        <td>{{ $part->part->part }}</td>
                                                                        <td>{{ $part->quantity }}</td>
                                                                        {{-- <td>{{ \Carbon\Carbon::parse($part->installation_date)->format('M d, Y') }}
                                                                    </td>
                                                                    <td>{{ \Carbon\Carbon::parse($part->warranty_upto)->format('M d, Y') }}
                                                                    </td> --}}
                                                                        <td>
                                                                            @if ($part->replace == 1)
                                                                                <h4>
                                                                                    <span
                                                                                        class="badge border badge-danger-lighten">Replaced</span>
                                                                                </h4>
                                                                            @else

                                                                            <a href="{{ route('admin.jobs.delete-equipment-part', $part->id) }}"
                                                                                class="btn btn-sm btn-dark"><i
                                                                                    class="fa fa-trash-alt me-1"></i>
                                                                                Delete</a>
                                                                                <a href="javascript:void(0)"
                                                                                    onclick="getpartDetails({{ $part->id }});"
                                                                                    class="btn btn-sm btn-danger"><i
                                                                                    class="mdi mdi-refresh me-1"></i>Replace
                                                                                </a>

                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h4>{{ $job->equipment->equipment_name }} - Replacement History</h4>
                                                </div>
                                                <div class="col-md-12 table-responive">
                                                    <table class="table table-striped" style="font-size: 14px"
                                                        id="parts-table">
                                                        <thead>
                                                            <tr>
                                                                <th class="bg-dark text-white">Part ID</th>
                                                                <th class="bg-dark text-white">Category</th>
                                                                <th class="bg-dark text-white">Part Name</th>
                                                                <th class="bg-dark text-white">Qty</th>
                                                                {{-- <th class="bg-dark text-white">Installation Date</th>
                                                                <th class="bg-dark text-white">Warranty Upto</th> --}}
                                                                <th class="bg-dark text-white">Replaced On</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="parts-row">
                                                            @foreach ($job->replacements as $replacement)
                                                                <tr>
                                                                    <td>#{{ $replacement->part_id }}</td>
                                                                    <td>{{ $replacement->part->category->category }}</td>
                                                                    <td>{{ $replacement->part->part }}</td>
                                                                    <td>{{ $replacement->quantity }}</td>
                                                                    {{-- <td>{{ \Carbon\Carbon::parse($replacement->installation_date)->format('M d, Y') }}
                                                                    </td>
                                                                    <td>{{ \Carbon\Carbon::parse($replacement->warranty_upto)->format('M d, Y') }}
                                                                    </td> --}}
                                                                    <td>{{ \Carbon\Carbon::parse($replacement->created_at)->format('M d, Y') }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                @if (count($job->replacements) == 0)
                                                    <div class="col-md-12">
                                                        <p class="text-center py-4">No Replacement History Found</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12 text-end">
                                    <a href="{{ route('admin.jobs.edit', $job->id) }}"
                                        class="btn btn-sm btn-primary me-1"><i
                                            class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                                    <a href="{{ route('admin.jobs.index') }}" class="btn btn-sm btn-success me-1"><i
                                            class="mdi mdi-database me-1"></i>Save</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div> <!-- container -->
    @include('admin.jobs.edit.add-replacement')
@endsection
@push('scripts')
    <script>
        function getpartDetails(part_id) {
            var job_id = '{{ $job->id }}';

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            var formData = {
                part_id: part_id,
                job_id: job_id
            };

            $.ajax({
                type: "POST",
                url: "{{ route('admin.equipments.get-part-details') }}",
                data: formData,
                dataType: 'json',
                success: function(data) {

                    $("#part_id").text(data.part.part_id)
                    $("#specific_part_id").val(part_id)
                    $("#category").text(data.part.category)
                    $("#part").text(data.part.part_name)
                    $("#part_name").val(data.part.part_name)
                    $("#quantity").text(data.part.quantity)
                    $("#new_quantity").val(data.part.quantity)
                    {{-- $("#installation_date").text(data.part.installation_date)
                    $("#warranty_upto").text(data.part.warranty_upto) --}}
                    $('#add-replacement-modal').modal('show');
                    var html = '';
                    console.log(data.collect_parts);
                    $.each(data.collect_parts, function(index, val) {

                        html += "<option value=" + val.id;
                        if (val.id == data.part.part_id) {
                            html += " selected";
                        }
                        html += ">" + val.part + "</option>";
                    });

                    $('#part_name').append(html);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }
    </script>
    <script>
        $(function() {
            $('#new_installation_date').datepicker({
                startDate: new Date(),
                format: "yyyy-mm-dd",
                autoclose: true
            });

            $('#new_warranty_upto').datepicker({
                startDate: new Date(),
                format: "yyyy-mm-dd",
                autoclose: true
            });
        });
    </script>
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
