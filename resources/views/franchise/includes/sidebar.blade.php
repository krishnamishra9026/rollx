<div class="leftside-menu">

    <a href="{{ route('franchise.dashboard') }}" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="{{ asset('assets/images/SHL-logo-white.png') }}">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('assets/images/SHL-logo-white-sm.png') }}">
        </span>
    </a>

    <!-- LOGO -->
    <a href="{{ route('franchise.dashboard') }}" class="logo text-center logo-dark">
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
                <a href="{{ route('franchise.dashboard') }}" class="side-nav-link">
                    <i class="uil-home-alt"></i>                   
                    <span> Dashboard </span>
                </a>
            </li>

            <li class="side-nav-item {{ request()->is('franchise/stocks') || request()->is('franchise/stocks/*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('franchise.stocks') }}" class="side-nav-link">
                    <i class="uil-clipboard-notes"></i>
                    <span> Stocks </span>
                </a>
            </li>


            <li class="side-nav-item {{ request()->is('franchise/products') || request()->is('franchise/products/*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('franchise.products.index') }}" class="side-nav-link">
                    <i class="uil-box"></i>
                    <span> Live Products </span>
                </a>
            </li>


            <li class="side-nav-item {{ request()->is('franchise/orders') || request()->is('franchise/orders/*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('franchise.orders.index') }}" class="side-nav-link">
                    <i class="uil-shopping-cart-alt"></i>
                    <span> Orders </span>
                </a>
            </li>


            <li class="side-nav-item {{ request()->is('franchise/sales') || request()->is('franchise/sales/*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('franchise.sales.index') }}" class="side-nav-link">
                    <i class="uil-dollar-sign-alt"></i>
                    <span> Sales </span>
                </a>
            </li>

            <li class="side-nav-item {{ request()->is('franchise/wallet') || request()->is('franchise/wallet/*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('franchise.wallet.index') }}" class="side-nav-link">
                    <i class="uil-wallet"></i>
                    <span> Wallet </span>
                </a>
            </li>

            <li class="side-nav-item {{ request()->is('franchise/wallet-requests') || request()->is('franchise/wallet-requests/*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('franchise.wallet-requests.index') }}" class="side-nav-link">
                    <i class="uil-exchange"></i>
                    <span> Wallet Requests </span>
                </a>
            </li>
            
            <li class="side-nav-item {{ request()->is('franchise/chefs') || request()->is('franchise/chefs/*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('franchise.chefs.index') }}" class="side-nav-link">
                    <i class="uil-user-check"></i>
                    <span> Chefs </span>
                </a>
            </li>

            <li class="side-nav-item {{ request()->is('franchise/transactions') || request()->is('franchise/transactions/*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('franchise.sale.reports.index') }}" class="side-nav-link">
                    <i class="uil-analytics"></i>
                    <span> Sales Report </span>
                </a>
            </li>

             <li class="side-nav-item {{ request()->is('franchise/notifications') || request()->is('franchise/notifications/*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('franchise.notifications.list') }}" class="side-nav-link">
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
                            <a href="{{ route('franchise.settings.products-plate') }}">Product Plate Setting</a>
                        </li>

                        <li>
                            <a href="{{ route('franchise.password.form') }}">Change Password</a>
                        </li>
                        <li>
                            <a href="{{ route('franchise.my-account.edit', Auth::guard('franchise')->id()) }}">My Account</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>

</div>
