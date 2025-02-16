@foreach ($order->parts as $part)
<tr>
    <td>#{{ $part->part_id }}</td>
    <td>{{ $part->part->part }}</td>
    <td>{{ $part->part->category->category }} @if($part->available == false) <span class="text-danger">***</span> @endif</td>
    <td>{{ $part->quantity }}</td>
    {{-- <td>{{ \Carbon\Carbon::parse($part->installation_date)->format('M d, Y') }}</td>
  <td>{{ $part->warranty_upto == "custom" ? \Carbon\Carbon::parse($part->warranty_date )->format('M d, Y') : $part->warranty_upto.' Weeks'}}</td> --}}

    <td><a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $part->id }})"><i class="uil-trash-alt"></i></a>
        <form id='delete-form{{ $part->id }}'
        action='{{ route('admin.sales.delete-equipment-part', $part->id) }}'
        method='POST'>
        <input type='hidden' name='_token'
            value='{{ csrf_token() }}'>
        <input type='hidden' name='_method' value='DELETE'>
    </form></td>
</tr>
@endforeach   