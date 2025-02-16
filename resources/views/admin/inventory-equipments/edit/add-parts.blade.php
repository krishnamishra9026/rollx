@extends('layouts.admin')
@section('title', 'Edit Parts')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ route('admin.inventory-equipment.index') }}" class="btn btn-sm btn-primary me-1"><i
                                class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                    </div>
                    <h4 class="page-title">Edit Equipment Parts</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <ul class="nav nav-tabs nav-bordered mb-3">

                                    <li class="nav-item">
                                        <a href="{{ route('admin.inventory-equipment.edit', $equipment->id) }}"
                                            class="nav-link">
                                            <span>Equipment Info</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.inventory-equipment.createPart', $equipment->id) }}"
                                            class="nav-link active">
                                            <span>Add Part</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="create-part-tab">
                                        <div class="row mb-2">
                                            <div class="col-md-4 mb-2">
                                                <label class="col-form-label" for="main_category">Main Category</label>
                                                <select name="main_category" id="main_category" class="form-select"
                                                    data-toggle=select2
                                                    onchange="getChildCategories(this.value, 'category');">
                                                    <option value="">Choose Main Category</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->category }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="invalid-feedback" role="alert" id="main_category_error"
                                                    style="display:none">
                                                    <strong>Please choose main category!</strong>
                                                </span>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label class="col-form-label" for="category">Category</label>
                                                <select name="category" id="category" class="form-select"
                                                    data-toggle=select2
                                                    onchange="getChildCategories(this.value, 'sub-category');">
                                                    <option value="">Choose Category</option>
                                                </select>
                                                <span class="invalid-feedback" role="alert" id="category_error"
                                                    style="display:none">
                                                    <strong>Please choose category!</strong>
                                                </span>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label class="col-form-label" for="sub_category">Sub Category</label>
                                                <select name="sub_category" id="sub_category" class="form-select"
                                                    data-toggle=select2 onchange="getParts()">
                                                    <option value="">Choose Sub Category</option>
                                                </select>
                                                <span class="invalid-feedback" role="alert" id="sub_category_error"
                                                    style="display:none">
                                                    <strong>Please choose sub category!</strong>
                                                </span>
                                            </div>
                                            <div class="col-md-8 mb-2">
                                                <label class="col-form-label" for="part">Choose Part</label>
                                                <select name="part" id="part" class="form-select">
                                                    <option value="">Choose Part</option>
                                                </select>
                                                <span class="invalid-feedback" role="alert" id="part_error"
                                                    style="display:none">
                                                    <strong>Please choose part!</strong>
                                                </span>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label class="col-form-label" for="quantity">Quantity</label>
                                                <input type="number" class="form-control" id="quantity" name="quantity"
                                                    placeholder="Enter Quantity" value="{{ old('quantity', 0) }}">
                                                <span class="invalid-feedback" role="alert" id="quantity_error"
                                                    style="display:none">
                                                    <strong>Please enter quantity!</strong>
                                                </span>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="button" class="btn btn-success" onclick="addPart();"
                                                    style="width: 100%"><i class="mdi mdi-plus me-1"></i>Add To
                                                    Equipment</button>
                                            </div>
                                        </div>
                                        @include('admin.inventory-equipments.parts')
                                    </div>
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
        function getChildCategories(id, type) {
            var select = (type === "sub-category") ? $('#sub_category') : $('#category');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                }
            });
            var formData = {
                id: id,
                type: type
            };
            $.ajax({
                type: 'POST',
                url: '{{ route('admin.orders.get-categories') }}',
                data: formData,
                dataType: 'json',
                beforeSend: function() {
                    select.html("");
                },
                success: function(res, status) {
                    if (type === "sub-category") {
                        select.append($('<option>').text("Choose Sub Category").attr('value', ""));
                    } else {
                        select.append($('<option>').text("Choose Category").attr('value', ""));
                    }

                    console.log(res)
                    $.each(res, function(index, value) {
                        select.append($('<option>').text(value.text).attr('value', value.id));
                    });

                },
                error: function(res, status) {
                    console.log(res);
                }
            });
        }
    </script>
    <script>
        function getParts() {
            var category_id = $('#sub_category').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            var formData = {
                category_id: category_id,
            };

            $.ajax({
                type: "POST",
                url: "{{ route('admin.categories.get-parts') }}",
                data: formData,
                dataType: 'json',
                success: function(data) {
                    $('#part').html(data.parts);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }
    </script>
    <script>
        function addPart() {
            let equipmentId = {{ $equipment->id }};
            let main_category = $("#main_category").val();
            let category = $("#category").val();
            let sub_category = $("#sub_category").val();
            let part = $("#part").val();
            let quantity = $("#quantity").val();

            if (main_category.length == "") {
                $("#main_category_error").show();
                return false;
            } else {
                $("#main_category_error").hide();
            }

            if (category.length == "") {
                $("#category_error").show();
                return false;
            } else {
                $("#category_error").hide();
            }

            if (sub_category.length == "") {
                $("#sub_category_error").show();
                return false;
            } else {
                $("#sub_category_error").hide();
            }

            if (part.length == "") {
                $("#part_error").show();
                return false;
            } else {
                $("#part_error").hide();
            }

            if (quantity.length == "") {
                $("#quantity_error").show();
                return false;
            } else {
                $("#quantity_error").hide();
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            var formData = {
                equipment_id: equipmentId,
                category: category,
                part_id: part,
                quantity: quantity,

            };

            $.ajax({
                type: "POST",
                url: "{{ route('admin.inventory-equipment.add-part') }}",
                data: formData,
                dataType: 'json',
                success: function(data) {
                    $('#parts-row').html(data.html);
                    $("#main_category").val('').change();
                    $("#category").val('').change();
                    $("#sub_category").val('').change();
                    $("#part").val('');
                    $("#quantity").val('');
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }
    </script>
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
