<tr>   
    <td>{{ $sub_category->id }}</td>  
    <td>{{ \App\Models\Category::where('id', $sub_category->category_id)->first()->category }} <i class="mdi mdi-greater-than mx-1"></i> {{ $sub_category->category }}</td>    
    <td class="text-end">
        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="mdi mdi-dots-vertical"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <a href="{{ route('admin.categories.edit', $sub_category->id) }}" class="dropdown-item"><i
                    class="fa fa-edit me-1"></i>
                Edit
                </a>
            <a href="javascript:void(0);" onclick="confirmDelete({{ $sub_category->id }})" class="dropdown-item"><i
                    class="fa fa-trash-alt me-1"></i>
                Delete
                </a>
            <form id='delete-form{{ $sub_category->id }}'
                action='{{ route('admin.categories.destroy', $sub_category->id) }}' method='POST'>
                <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                <input type='hidden' name='_method' value='DELETE'>
            </form>
        </div>
    </td>
</tr>
@foreach ($sub_category->subCategories as $sub_sub_category)
<tr>   
    <td>{{ $sub_sub_category->id }}</td>  
    <td>{{ \App\Models\Category::where('id', $sub_category->category_id)->first()->category }} <i class="mdi mdi-greater-than mx-1"></i> {{ \App\Models\Category::where('id', $sub_sub_category->category_id)->first()->category }} <i class="mdi mdi-greater-than mx-1"></i> {{ $sub_sub_category->category }}</td>
    <td class="text-end">
        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="mdi mdi-dots-vertical"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <a href="{{ route('admin.categories.edit', $sub_sub_category->id) }}" class="dropdown-item"><i
                    class="fa fa-edit me-1"></i>
                Edit
                </a>
            <a href="javascript:void(0);" onclick="confirmDelete({{ $sub_sub_category->id }})" class="dropdown-item"><i
                    class="fa fa-trash-alt me-1"></i>
                Delete
                </a>
            <form id='delete-form{{ $sub_sub_category->id }}'
                action='{{ route('admin.categories.destroy', $sub_sub_category->id) }}' method='POST'>
                <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                <input type='hidden' name='_method' value='DELETE'>
            </form>
        </div>
    </td>
</tr>
@endforeach

