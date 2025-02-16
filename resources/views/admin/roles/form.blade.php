@extends('layouts.admin')
@section('title', isset($role) ? 'Edit Role' : 'Create Role')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark me-1"><i
                                class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                        <button type="submit" class="btn btn-sm btn-primary" form="roleForm"><i
                                class="mdi mdi-database me-1"></i>Save</button>
                    </div>
                    <h4 class="page-title">{{ isset($role) ? 'Edit Role' : 'Create Role' }}</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <form method="POST"
                    @isset($role) action="{{ route('admin.roles.update', $role->id) }}" @else action="{{ route('admin.roles.store') }}" @endif id="roleForm">
                              @csrf
                              @isset($role)
                                  @method('PUT')
                              @endisset
                    <div class="card">
                    <div class="card-body">
                        @include('admin.includes.flash-message')
                        <div class="form-group mb-1">
                            <label for="name" class="col-form-label text-md-end">{{ __('Role Name') }}</label>

                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name', isset($role) ? $role->name : '') }}"
                                autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
            </div>
            <div class="card my-3">
                <div class="card-header">
                    <p class="card-title float-start">Manage Permissions</p>
                </div>
                <div class="card-body">
                    <div class="accordion" id="permissionAccordian">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#dashboard" aria-expanded="false" aria-controls="dashboard">
                                    Product Permission
                                </button>
                            </h2>
                            <div id="dashboard" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                data-bs-parent="#permissionAccordian">
                                <div class="accordion-body">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <button type="button" class="btn btn-sm btn-warning  me-1 float-end"
                                                onclick="$('.dashboard-permission').prop('checked', true);">Select
                                                All</button>
                                            <button type="button" class="btn btn-sm btn-danger  me-1 float-end"
                                                onclick="$('.dashboard-permission').prop('checked', false);">Deselect
                                                All</button>
                                        </li>
                                        @foreach ($permissions as $permission)
                                            <li class="list-group-item">
                                                <input class="form-check-input me-1 float-end dashboard-permission"
                                                    name="permission[]" type="checkbox" value="{{ $permission->name }}"
                                                    @isset($role) {{ in_array($permission->name, $role->permissions) ? 'checked' : '' }} @endisset>
                                                {{ $permission->name }}
                                            </li>
                                            @if ($loop->iteration == 5)
                                            @break
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#lead" aria-expanded="false" aria-controls="lead">
                                Leads Permission
                            </button>
                        </h2>
                        <div id="lead" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#permissionAccordian">
                            <div class="accordion-body">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <button type="button" class="btn btn-sm btn-warning  me-1 float-end"
                                            onclick="$('.job-permission').prop('checked', true);">Select All</button>
                                        <button type="button" class="btn btn-sm btn-danger  me-1 float-end"
                                            onclick="$('.job-permission').prop('checked', false);">Deselect
                                            All</button>
                                    </li>
                                    @foreach ($permissions as $permission)
                                        @if ($loop->iteration < 6)
                                            @continue
                                        @endif
                                        <li class="list-group-item">
                                            <input class="form-check-input me-1 float-end job-permission"
                                                name="permission[]" type="checkbox" value="{{ $permission->name }}"
                                                @isset($role) {{ in_array($permission->name, $role->permissions) ? 'checked' : '' }} @endisset>
                                            {{ $permission->name }}
                                        </li>
                                        @if ($loop->iteration == 10)
                                        @break
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#homeowner" aria-expanded="false" aria-controls="homeowner">
                            Order Permission
                        </button>
                    </h2>
                    <div id="homeowner" class="accordion-collapse collapse" aria-labelledby="headingThree"
                        data-bs-parent="#permissionAccordian">
                        <div class="accordion-body">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <button type="button" class="btn btn-sm btn-warning  me-1 float-end"
                                        onclick="$('.homeowner-permission').prop('checked', true);">Select
                                        All</button>
                                    <button type="button" class="btn btn-sm btn-danger  me-1 float-end"
                                        onclick="$('.homeowner-permission').prop('checked', false);">Deselect
                                        All</button>
                                </li>
                                @foreach ($permissions as $permission)
                                    @if ($loop->iteration < 11)
                                        @continue
                                    @endif
                                    <li class="list-group-item">
                                        <input class="form-check-input me-1 float-end homeowner-permission"
                                            name="permission[]" type="checkbox" value="{{ $permission->name }}"
                                            @isset($role) {{ in_array($permission->name, $role->permissions) ? 'checked' : '' }} @endisset>
                                        {{ $permission->name }}
                                    </li>
                                    @if ($loop->iteration == 15)
                                    @break
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#tradesperson" aria-expanded="false" aria-controls="tradesperson">
                        Franchises Permission
                    </button>
                </h2>
                <div id="tradesperson" class="accordion-collapse collapse" aria-labelledby="headingFour"
                    data-bs-parent="#permissionAccordian">
                    <div class="accordion-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <button type="button" class="btn btn-sm btn-warning  me-1 float-end"
                                    onclick="$('.tradesperson-permission').prop('checked', true);">Select
                                    All</button>
                                <button type="button" class="btn btn-sm btn-danger  me-1 float-end"
                                    onclick="$('.tradesperson-permission').prop('checked', false);">Deselect
                                    All</button>
                            </li>
                            @foreach ($permissions as $permission)
                                @if ($loop->iteration < 16)
                                    @continue
                                @endif
                                <li class="list-group-item">
                                    <input class="form-check-input me-1 float-end tradesperson-permission"
                                        name="permission[]" type="checkbox" value="{{ $permission->name }}"
                                        @isset($role) {{ in_array($permission->name, $role->permissions) ? 'checked' : '' }} @endisset>
                                    {{ $permission->name }}
                                </li>
                                @if ($loop->iteration == 20)
                                @break
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
           
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTen">
                    <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#tickets"
                        aria-expanded="false" aria-controls="tickets">
                        Tickets Permission
                    </button>
                </h2>
                <div id="tickets" class="accordion-collapse collapse"
                    aria-labelledby="headingTen"
                    data-bs-parent="#permissionAccordian">
                    <div class="accordion-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <button type="button"
                                    class="btn btn-sm btn-warning  me-1 float-end"
                                    onclick="$('.tickets-permission').prop('checked', true);">Select
                                    All</button>
                                <button type="button"
                                    class="btn btn-sm btn-danger  me-1 float-end"
                                    onclick="$('.tickets-permission').prop('checked', false);">Deselect
                                    All</button>
                            </li>
                            @foreach ($permissions as $permission)
                                @if ($loop->iteration < 21)
                                    @continue
                                @endif
                                <li class="list-group-item">
                                    <input
                                        class="form-check-input me-1 float-end tickets-permission"
                                        name="permission[]" type="checkbox"
                                        value="{{ $permission->name }}"
                                        @isset($role) {{ in_array($permission->name, $role->permissions) ? 'checked' : '' }} @endisset>
                                    {{ $permission->name }}
                                </li>
                                @if ($loop->iteration == 26)
                                @break
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThirteen">
                    <button class="accordion-button collapsed"
                        type="button" data-bs-toggle="collapse"
                        data-bs-target="#user" aria-expanded="false"
                        aria-controls="user">
                        User Permission
                    </button>
                </h2>
                <div id="user" class="accordion-collapse collapse"
                    aria-labelledby="headingThirteen"
                    data-bs-parent="#permissionAccordian">
                    <div class="accordion-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <button type="button"
                                    class="btn btn-sm btn-warning  me-1 float-end"
                                    onclick="$('.user-permission').prop('checked', true);">Select
                                    All</button>
                                <button type="button"
                                    class="btn btn-sm btn-danger  me-1 float-end"
                                    onclick="$('.user-permission').prop('checked', false);">Deselect
                                    All</button>
                            </li>
                            @foreach ($permissions as $permission)
                                @if ($loop->iteration < 27)
                                    @continue
                                @endif
                                <li class="list-group-item">
                                    <input
                                        class="form-check-input me-1 float-end user-permission"
                                        name="permission[]"
                                        type="checkbox"
                                        value="{{ $permission->name }}"
                                        @isset($role) {{ in_array($permission->name, $role->permissions) ? 'checked' : '' }} @endisset>
                                    {{ $permission->name }}
                                </li>
                                @if ($loop->iteration == 31)
                                @break
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFourteen">
                    <button class="accordion-button collapsed"
                        type="button" data-bs-toggle="collapse"
                        data-bs-target="#role" aria-expanded="false"
                        aria-controls="role">
                        Role Permission
                    </button>
                </h2>
                <div id="role"
                    class="accordion-collapse collapse"
                    aria-labelledby="headingFourteen"
                    data-bs-parent="#permissionAccordian">
                    <div class="accordion-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <button type="button"
                                    class="btn btn-sm btn-warning  me-1 float-end"
                                    onclick="$('.role-permission').prop('checked', true);">Select
                                    All</button>
                                <button type="button"
                                    class="btn btn-sm btn-danger  me-1 float-end"
                                    onclick="$('.role-permission').prop('checked', false);">Deselect
                                    All</button>
                            </li>
                            @foreach ($permissions as $permission)
                                @if ($loop->iteration < 32)
                                    @continue
                                @endif
                                <li class="list-group-item">
                                    <input
                                        class="form-check-input me-1 float-end role-permission"
                                        name="permission[]"
                                        type="checkbox"
                                        value="{{ $permission->name }}"
                                        @isset($role) {{ in_array($permission->name, $role->permissions) ? 'checked' : '' }} @endisset>
                                    {{ $permission->name }}
                                </li>
                                @if ($loop->iteration == 36)
                                @break
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFifteen">
                    <button class="accordion-button collapsed"
                        type="button" data-bs-toggle="collapse"
                        data-bs-target="#setting"
                        aria-expanded="false"
                        aria-controls="setting">
                        Setting Permission
                    </button>
                </h2>
                <div id="setting"
                    class="accordion-collapse collapse"
                    aria-labelledby="headingFifteen"
                    data-bs-parent="#permissionAccordian">
                    <div class="accordion-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <button type="button"
                                    class="btn btn-sm btn-warning  me-1 float-end"
                                    onclick="$('.setting-permission').prop('checked', true);">Select
                                    All</button>
                                <button type="button"
                                    class="btn btn-sm btn-danger  me-1 float-end"
                                    onclick="$('.setting-permission').prop('checked', false);">Deselect
                                    All</button>
                            </li>
                            @foreach ($permissions as $permission)
                                @if ($loop->iteration < 37)
                                    @continue
                                @endif
                                <li class="list-group-item">
                                    <input
                                        class="form-check-input me-1 float-end setting-permission"
                                        name="permission[]"
                                        type="checkbox"
                                        value="{{ $permission->name }}"
                                        @isset($role) {{ in_array($permission->name, $role->permissions) ? 'checked' : '' }} @endisset>
                                    {{ $permission->name }}
                                </li>
                                @if ($loop->iteration == 40)
                                @break
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="d-grid">
<button type="submit" form="roleForm"
    class="btn btn-primary">
    <i class="fe fe-database btn-icon"></i>
    {{ isset($role) ? 'Update' : 'Save' }}</button>
</div>
</form>

</div>
</div>
</div>
@endsection
@push('scripts')
@endpush
