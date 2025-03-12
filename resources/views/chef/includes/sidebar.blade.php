<div class="leftside-menu">

    <a href="{{ route('chef.dashboard') }}" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="{{ asset('assets/images/SHL-logo-white.png') }}">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('assets/images/SHL-logo-white-sm.png') }}">
        </span>
    </a>

    <!-- LOGO -->
    <a href="{{ route('chef.dashboard') }}" class="logo text-center logo-dark">
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
                <a href="{{ route('chef.dashboard') }}" class="side-nav-link">
                    <i class="uil-home-alt"></i>                   
                    <span> Dashboard </span>
                </a>
            </li>


            <li class="side-nav-item {{ request()->is('chef/orders') || request()->is('chef/orders/*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('chef.orders.index') }}" class="side-nav-link">
                    <i class="uil-shopping-cart-alt"></i>
                    <span> Orders </span>
                </a>
            </li>


            <li class="side-nav-item {{ request()->is('chef/sales') || request()->is('chef/sales/*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('chef.sales.index') }}" class="side-nav-link">
                    <i class="uil-dollar-sign-alt"></i>
                    <span> Sales </span>
                </a>
            </li>

            <li class="side-nav-item {{ request()->is('chef/notifications') || request()->is('chef/notifications/*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('chef.notifications.list') }}" class="side-nav-link">
                    <i class="uil-bell"></i>
                    <span> Notifications </span>
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
                            <a href="{{ route('chef.password.form') }}">Change Password</a>
                        </li>
                        <li>
                            <a href="{{ route('chef.my-account.edit', Auth::guard('chef')->id()) }}">My Account</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>

</div>
