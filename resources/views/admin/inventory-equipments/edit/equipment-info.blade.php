@extends('layouts.admin')
@section('title', 'Edit Equipment')
@section('head')
    <link href="{{ asset('assets/js/plugins/intl-tel-input/css/intlTelInput.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
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
                        <button type="submit" class="btn btn-sm btn-danger" form="orderForm"><i
                                class="mdi mdi-database me-1"></i>Save</button>
                    </div>
                    <h4 class="page-title">Edit Equipment</h4>
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
                                            class="nav-link active">
                                            <span>Equipment Info</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.inventory-equipment.createPart', $equipment->id) }}"
                                            class="nav-link">
                                            <span>Add Part</span>
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane show active" id="order-info-tab">
                                        <form id="serviceForm" method="POST"
                                            action="{{ route('admin.inventory-equipment.update', $equipment->id) }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
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
                                                                    value="{{ old('equipment_name', $equipment->equipment_name) }}"
                                                                    autofocus>

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
                                                                    class="form-control @error('date_added') is-invalid @enderror"
                                                                    name="date_added" placeholder="Enter Date Added"
                                                                    value="{{ old('date_added', $equipment->date_added) }}">

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
                                                                    placeholder="Enter Equipment remark">{{ old('remark', $equipment->remark) }}</textarea>
                                                                @error('remark')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class='row mb-2'>
                                                            <label for="date_added"
                                                                class="col-md-3 col-form-label text-md-start">{{ __('Serial Numbers') }}</label>

                                                            <div class="col-md-9">
                                                                <table id="item" class="table table-sm">
                                                                    <tbody>
                                                                        @foreach ($equipment->serial_nos as $key => $serial_no)
                                                                        <tr id="item-row{{ $key }}">
                                                                            <td width="96%"><input type="text" name="items[{{ $key }}][serial_no]"
                                                                                    placeholder="Serial Number" class="form-control"
                                                                                    id="serial_no_{{ $key }}" value="{{ $serial_no->serial_no }}" required></td>
                                                                            <td class="text-end"><button type="button"
                                                                                    onclick="$('#item-row{{ $key }}').remove();" class="btn btn-danger"><i
                                                                                        class="fas fa-minus-circle"></i></button></td>
                                                                        </tr>
                                                                        @endforeach

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
                                                    </div>

                                                </div>
                                            </div>
                                        </form>

                                        {{-- @include('admin.orders.edit.parts') --}}
                                        {{-- @include('admin.orders.edit.add-parts') --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ route('admin.inventory-equipment.index') }}" class="btn btn-sm btn-primary me-1"><i
                                class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                        <button type="submit" class="btn btn-sm btn-danger" form="serviceForm"><i
                                class="mdi mdi-database me-1"></i>Save</button>
                    </div>
                    {{-- <div class="card-footer">
                        <div class="row mb-2 text-end">
                            <div class="col-md-12">

                                @if (session()->has('route'))
                                   <a href="{{  session()->get('route') }}" class="btn btn-sm btn-primary me-1"><i
                                        class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                              @else
                                <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-sm btn-primary me-1"><i
                                        class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                            @endif
                                        <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-danger me-1"><i
                                            class="mdi mdi-check me-1"></i>Finish</a>
                    </div> --}}
                </div>

            </div>
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
