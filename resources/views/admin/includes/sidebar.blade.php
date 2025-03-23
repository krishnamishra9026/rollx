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

            @if(Auth::guard('administrator')->user()->roles()->first()->name == 'Sales' || Auth::guard('administrator')->user()->roles()->first()->name == 'Administrator')

            <li class="side-nav-item {{ request()->is('admin/leads') || request()->is('admin/leads/*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('admin.leads.index') }}" class="side-nav-link">
                    <i class="uil-users-alt"></i>
                    <span> Leads </span>
                </a>
            </li>

            @endif


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
                        <li>
                            <a href="{{ route('admin.product-prices.index') }}">Product Pricing</a>
                        </li>

                        <li>
                            <a href="{{ route('admin.product.quantity') }}">Product Quantities</a>
                        </li>

                        <li>
                            <a href="{{ route('admin.product-franchises.index') }}">Product Franchises</a>
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

            <li class="side-nav-item {{ request()->is('admin/sales') || request()->is('admin/sales/*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('admin.sales.index') }}" class="side-nav-link">
                    <i class="uil-dollar-sign-alt"></i>
                    <span> Sales </span>
                </a>
            </li>

           


            @if(Auth::guard('administrator')->user()->roles()->first()->name == 'Warehouse' || Auth::guard('administrator')->user()->roles()->first()->name == 'Administrator')

            <li class="side-nav-item {{ request()->is('admin/warehouse-items') || request()->is('admin/warehouse-items/*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('admin.warehouse-items.index') }}" class="side-nav-link">
                    <i class="uil-box"></i>
                    <span> Warehouse Items </span>
                </a>
            </li>

            @endif

            <li class="side-nav-item {{ request()->is('admin/wallet') || request()->is('admin/wallet/*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('admin.wallet.index') }}" class="side-nav-link">
                    <i class="uil-wallet"></i>
                    <span> Wallet/Points </span>
                </a>
            </li>

            @if(Auth::guard('administrator')->user()->roles()->first()->name == 'Sales' || Auth::guard('administrator')->user()->roles()->first()->name == 'Administrator')

            <li class="side-nav-item {{ request()->is('admin/wallet-requests') || request()->is('admin/wallet-requests/*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('admin.wallet-requests.index') }}" class="side-nav-link">
                    <i class="uil-exchange"></i>
                    <span> Wallet Requests </span>
                </a>
            </li>

            @endif

            @if(Auth::guard('administrator')->user()->roles()->first()->name == 'Operations' || Auth::guard('administrator')->user()->roles()->first()->name == 'Administrator')

            <li class="side-nav-item {{ request()->is('admin/transactions') || request()->is('admin/transactions/*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('admin.transactions.index') }}" class="side-nav-link">
                    <i class="uil-money-bill"></i>
                    <span> Financial Transactions </span>
                </a>
            </li>


            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#reportMenu" aria-expanded="false" aria-controls="reportMenu"
                    class="side-nav-link">
                    <i class="uil-money-bill"></i>
                    <span> Reports </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="reportMenu">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('admin.product.sale.reports.index') }}">Product Sale</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.franchise.sale.reports.index') }}">Franchise Sale</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.franchise.product.sale.reports.index') }}">Franchise Product Sale</a>
                        </li>

                        <li>
                            <a href="{{ route('admin.product.franchise.sales.reports.index') }}">Date Wise Sale</a>
                        </li>

                        <li>
                            <a href="{{ route('admin.product.franchise.sale.reports.index') }}">Product Franchise Sale</a>
                        </li>

                        <li>
                            <a href="{{ route('admin.sale.reports.index') }}">Sales</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.order.sale.reports.index') }}">Order Sales</a>
                        </li>
                    </ul>
                </div>
            </li>

            @endif

           


             @if(Auth::guard('administrator')->user()->roles()->first()->name == 'Administrator')

            <li class="side-nav-item {{ request()->is('admin/franchises') || request()->is('admin/franchises/*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('admin.franchises.index') }}" class="side-nav-link">
                    <i class="uil-user-check"></i>
                    <span> Franchises </span>
                </a>
            </li>

            <li class="side-nav-item {{ request()->is('admin/chefs') || request()->is('admin/chefs/*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('admin.chefs.index') }}" class="side-nav-link">
                    <i class="uil-user-check"></i>
                    <span> Chefs </span>
                </a>
            </li>



            
            @canany(['Users', 'Roles'])
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
                        @can('Roles')
                        <li>
                            <a href="{{ route('admin.roles.index') }}"
                                class="{{ request()->is('admin/roles/') || request()->is('admin/roles/*') ? 'active' : '' }}"><i
                                    class="dripicons-chevron-right me-1"></i>Roles</a>
                        </li>
                        @endcan
                        @can('Users')
                        <li>
                            <a href="{{ route('admin.users.index') }}"
                                class="{{ request()->is('admin/users/') || request()->is('administrator/users/*') ? 'active' : '' }}"><i
                                    class="dripicons-chevron-right me-1"></i>Users</a>
                        </li>
                        @endcan
                    </ul>
                </div>
            </li>
            @endcan

            @endif


            <li class="side-nav-item {{ request()->is('admin/notifications') || request()->is('admin/notifications/*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('admin.notifications.list') }}" class="side-nav-link">
                    <i class="uil-bell"></i>
                    <span> Notifications </span>
                </a>
            </li>

            <li class="side-nav-item {{ request()->is('admin/inquiries') || request()->is('admin/inquiries/*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('admin.inquiries.index') }}" class="side-nav-link">
                    <i class="uil-envelope"></i>
                    <span> Inquiries </span>
                </a>
            </li>

            <li class="side-nav-item {{ request()->is('admin/blogs') || request()->is('admin/blogs/*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('admin.blogs.index') }}" class="side-nav-link">
                    <i class="uil-envelope"></i>
                    <span> Blogs </span>
                </a>
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
