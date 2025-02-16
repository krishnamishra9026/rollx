@extends('layouts.admin')
@section('title', 'Add Equipment')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary me-1"><i
                                class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                        <button type="submit" class="btn btn-sm btn-danger" form="serviceForm"><i
                                class="mdi mdi-database me-1"></i>Save</button>
                    </div>
                    <h4 class="page-title">Add Equipment</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <!-- end page title -->
        <div class="row">
            <form id="serviceForm" method="POST" action="{{ route('admin.inventory-equipment.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <label for="equipment_name"
                                    class="col-md-3 col-form-label text-md-start">{{ __('Equipment Name') }}</label>

                                <div class="col-md-9">
                                    <input id="equipment_name" type="text"
                                        class="form-control @error('equipment_name') is-invalid @enderror"
                                        name="equipment_name" placeholder="Enter Equipment Name"
                                        value="{{ old('equipment_name') }}">

                                    @error('equipment_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label for="date_added"
                                    class="col-md-3 col-form-label text-md-start">{{ __('Date Added') }}</label>

                                <div class="col-md-9">
                                    <input id="date_added" type="date"
                                        class="form-control @error('date_added') is-invalid @enderror" name="date_added"
                                        placeholder="Enter Date Added" value="{{ old('date_added') }}">

                                    @error('date_added')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="date_added"
                                    class="col-md-3 col-form-label text-md-start">{{ __('Remark') }}</label>

                                <div class="col-md-9">
                                    <textarea name="remark" class="form-control @error('remark') is-invalid @enderror" id="remark" rows="3"
                                        placeholder="Enter Equipment remark">{{ old('remark') }}</textarea>
                                    @error('remark')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class='row mb-2'>
                                    <label for="date_added"
                                        class="col-md-3 col-form-label text-md-start">{{ __('Serial Numbers') }}</label>

                                    <div class="col-md-9">
                                        <table id="item" class="table table-sm">
                                            <tbody>
                                                <tr id="item-row0">
                                                    <td width="96%"><input type="text" name="items[0][serial_no]"
                                                            placeholder="Serial Number" class="form-control"
                                                            id="serial_no_0" required></td>
                                                    <td class="text-end"><button type="button"
                                                            onclick="$('#item-row0').remove();" class="btn btn-danger"><i
                                                                class="fas fa-minus-circle"></i></button></td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td class="text-end" style="border-bottom: none;" colspan="2"><button
                                                            type="button" onclick="addItem();" data-toggle="tooltip"
                                                            title="Add Item" class="btn btn-secondary"
                                                            data-original-title="Add Item"><i
                                                                class="fas fa-plus-circle"></i></button></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                </div>
                                <div class="card-footer text-end">
                                    <a href="{{ route('admin.inventory-equipment.index') }}"
                                        class="btn btn-sm btn-primary me-1"><i
                                            class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                                    <button type="submit" class="btn btn-sm btn-danger" form="serviceForm"><i
                                            class="mdi mdi-database me-1"></i>Save</button>
                                </div>
                            </div>
                        </div>
            </form>
        </div>
    </div> <!-- container -->


@endsection
@push('scripts')
    <script>
        var item_row = {{ isset($equipment) ? count($equipment->serial_nos) : 1 }}

        function addItem() {
            if (item_row < 50) {
                html = '<tr id="item-row' + item_row + '">';
                html += '<td><input type="text" name="items[' + item_row +
                    '][serial_no]" placeholder="Serial Number" class="form-control" id="serial_no_' + item_row +
                    '" required></td>';
                html += '<td class="text-end"><button type="button" onclick="$(\'#item-row' + item_row +
                    '\').remove();" data-toggle="tooltip" title="Remove Button" class="btn btn-danger ms-btn-icon btn-danger"><i class="fas fa-minus-circle"></i></button></td>';
                html += '<tr>';
                $('#item tbody').append(html);
                item_row++;
            }
        }
    </script>
@endpush
