<div class="leftside-menu">

    <!-- LOGO -->
    <a href="{{ route('admin.dashboard') }}" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="{{ asset('assets/images/SHL-logo-white.png') }}">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('assets/images/SHL-logo-white-sm.png') }}">
        </span>
    </a>

    <!-- LOGO -->
    <a href="{{ route('admin.dashboard') }}" class="logo text-center logo-dark">
        <span class="logo-lg">
            <img src="{{ asset('assets/images/logo.png') }}">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('assets/images/logo_sm.png') }}">
        </span>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar>

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-item">
                <a href="{{ route('admin.dashboard') }}" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboard </span>
                </a>
            </li>


            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#inventoryMenu" aria-expanded="false" aria-controls="inventoryMenu"
                    class="side-nav-link">
                    <i class="dripicons-stack"></i>
                    <span> Inventory </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="inventoryMenu">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('admin.products.index') }}">All Products</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.products.create') }}">Add Products</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item {{ request()->is('admin/orders') || request()->is('admin/orders/*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('admin.orders.index') }}" class="side-nav-link">
                    <i class="uil-shopping-cart-alt"></i>
                    <span> Orders </span>
                </a>
            </li>

            <li class="side-nav-item {{ request()->is('admin/wallet') || request()->is('admin/wallet/*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('admin.wallet.index') }}" class="side-nav-link">
                    <i class="uil-shopping-cart-alt"></i>
                    <span> Wallet/Points </span>
                </a>
            </li>

            @can('Leads')
            <li class="side-nav-item {{ request()->is('admin/leads') || request()->is('admin/leads/*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('admin.leads.index') }}" class="side-nav-link">
                    <i class="uil-user-check"></i>
                    <span> Lead </span>
                </a>
            </li>
            @endcan

            <li class="side-nav-item {{ request()->is('admin/franchises') || request()->is('admin/franchises/*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('admin.franchises.index') }}" class="side-nav-link">
                    <i class="uil-user-check"></i>
                    <span> Franchises </span>
                </a>
            </li>

            <li
                class="side-nav-item {{ request()->is('admin/users/') || request()->is('admin/users/*') || request()->is('admin/roles/') || request()->is('admin/roles/*') ? 'menuitem-active' : '' }}">
                <a data-bs-toggle="collapse" href="#sidebarUserManagement" aria-expanded="false"
                    aria-controls="sidebarUserManagement" class="side-nav-link">
                    <i class="uil-user"></i>
                    <span> User Management </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse {{ request()->is('admin/users/') || request()->is('admin/users/*') || request()->is('admin/roles/') || request()->is('admin/roles/*') ? 'show' : '' }}"
                    id="sidebarUserManagement">
                    <ul class="side-nav-second-level">
                            <li>
                                <a href="{{ route('admin.roles.index') }}"
                                    class="{{ request()->is('admin/roles/') || request()->is('admin/roles/*') ? 'active' : '' }}"><i
                                        class="dripicons-chevron-right me-1"></i>Roles</a>
                            </li>
                    
                            <li>
                                <a href="{{ route('admin.users.index') }}"
                                    class="{{ request()->is('admin/users/') || request()->is('administrator/users/*') ? 'active' : '' }}"><i
                                        class="dripicons-chevron-right me-1"></i>Users</a>
                            </li>
                    </ul>
                </div>
            </li>


            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarSettings" aria-expanded="false"
                    aria-controls="sidebarSettings" class="side-nav-link">
                    <i class="uil-cog"></i>
                    <span> Settings </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarSettings">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('admin.password.form') }}">Change Password</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.my-account.edit', Auth::guard('administrator')->id()) }}">My
                                Account</a>
                        </li>

                    </ul>
                </div>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>

</div>
