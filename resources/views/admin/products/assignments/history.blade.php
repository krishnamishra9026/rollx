@extends('layouts.admin')
@section('title', 'Assignment History')
@section('content')
<div class="container-fluid">
    <!-- Page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <a href="{{ route('admin.products.assignments.create', $product->id) }}" 
                        class="btn btn-primary btn-sm">
                        <i class="mdi mdi-plus me-1"></i>New Assignment
                    </a>
                </div>
                <h4 class="page-title">Assignment History - {{ $product->name }}</h4>
            </div>
        </div>
    </div>

    <!-- Assignment history table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if($assignments->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-centered table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>Comment</th>
                                        <th>Assigned By</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($assignments as $assignment)
                                        <tr>
                                            <td>{{ $assignment->assigned_at->format('d M Y H:i') }}</td>
                                            <td>{{ ucfirst($assignment->assignment_type) }}</td>
                                            <td>{{ $assignment->quantity }}</td>
                                            <td>
                                                <span class="badge bg-{{ $assignment->status === 'active' ? 'success' : 'danger' }}">
                                                    {{ ucfirst($assignment->status) }}
                                                </span>
                                            </td>
                                            <td>{{ $assignment->comment }}</td>
                                            <td>{{ optional($assignment->assignedByUser)->name }}</td>
                                            <td>
                                                @if($assignment->status === 'active')
                                                    <a href="{{ route('admin.products.assignments.edit', $assignment->id) }}" 
                                                        class="btn btn-sm btn-info">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $assignments->links() }}
                        </div>
                    @else
                        <div class="text-center p-4">
                            <p class="text-muted mb-0">No assignments found</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.table').DataTable({
            order: [[0, 'desc']],
            pageLength: 25,
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>
@endpush