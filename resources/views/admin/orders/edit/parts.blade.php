<div class="row mb-2">
    <div class="col-md-12 table-responive">
        <table class="table table-sm" style="font-size: 14px" id="parts-table">
            <thead>
                <tr>
                    <th class="bg-light">Part ID</th>
                    <th class="bg-light">Part Name</th>
                    <th class="bg-light">Category</th>
                    <th class="bg-light">Qty</th>
                    <th class="bg-light">Action</th>
                </tr>
            </thead>
            <tbody id="parts-row">
                @foreach ($order->parts as $part)
                    <tr>
                        <td>#{{ $part->part_id }}</td>
                        <td>{{ $part->part->part }}</td>
                        <td>{{ $part->part->category->category }} @if($part->available == false) <span class="text-danger">***</span> @endif</td>
                        <td>{{ $part->quantity }}</td>
                        <td><a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $part->id }})"><i class="uil-trash-alt"></i></a>
                            <form id='delete-form{{ $part->id }}'
                            action='{{ route('admin.orders.delete-equipment-part', $part->id) }}'
                            method='POST'>
                            <input type='hidden' name='_token'
                                value='{{ csrf_token() }}'>
                            <input type='hidden' name='_method' value='DELETE'>
                        </form></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
