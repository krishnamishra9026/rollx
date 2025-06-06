<div class="navbar-custom">
    <ul class="list-unstyled topbar-menu float-end mb-0">

        <li class="dropdown notification-list" style="display: block;">
            <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <i class="dripicons-bell noti-icon"></i>
                <span class="noti-icon-badge"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg notification-dropdown">

                <div class="dropdown-item noti-title">
                    <h5 class="m-0">
                        <span class="float-end">
                            @if (auth()->guard('chef')->user()->unreadNotifications && count(auth()->guard('chef')->user()->unreadNotifications))
                            <a href="{{route('chef.notifications.mark-all-read')}}" class="text-dark" >
                                <small>Clear All</small>
                            </a>
                            @endif
                        </span>Notification
                    </h5>
                </div>

                <div style="max-height: 230px;" data-simplebar>
                    <div id="chef-notification-container">
                        @include('chef.includes.notifications-list')
                    </div>
                </div>

            </div>
        </li>

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#"
                role="button" aria-haspopup="false" aria-expanded="false">
                @isset(Auth::guard('chef')->user()->avatar)
                    <span class="account-user-avatar">
                        <img src="{{ asset('storage/uploads/chef/'.Auth::guard('chef')->user()->avatar) }}" alt="user-image" class="rounded-circle">
                    </span>
                @else
                    <span class="account-user-avatar">
                        <img src="{{ asset('assets/images/users/avatar.png') }}" alt="user-image" class="rounded-circle">
                    </span>
                @endisset
                <span>
                    <span class="account-user-name text-dark">{{ Auth::guard('chef')->user()->firstname }}
                        {{ Auth::guard('chef')->user()->lastname }}</span>
                    <span class="account-position">Chef</span>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">

                <a href="#" class="dropdown-item notify-item d-sm-block d-md-none">

                    <span class="account-user-avatar">
                    @isset(Auth::guard('chef')->user()->avatar)
                        <img  height="30" width="30" src="{{ asset('storage/uploads/chef/'.Auth::guard('chef')->user()->avatar) }}" alt="user-image" class="rounded-circle">
                    @else
                        <img  height="30" width="30" src="{{ asset('assets/images/users/avatar.png') }}" alt="user-image" class="rounded-circle">
                    @endisset
                    </span>
                    <span >{{ Auth::guard('chef')->user()->firstname }}
                        {{ Auth::guard('chef')->user()->lastname }}</span>
                </a>

                <a href="{{ route('chef.my-account.edit', Auth::guard('chef')->id()) }}" class="dropdown-item notify-item">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5"
                        stroke="currentColor" width="20" height="20" aria-hidden="true">
                        <path strokeLinecap="round" strokeLinejoin="round"
                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                    </svg>
                    <span>Edit Account</span>
                </a>

                <!-- item-->
                <a href="{{ route('chef.password.form') }}" class="dropdown-item notify-item">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5"
                        stroke="currentColor" width="20" height="20" aria-hidden="true">
                        <path strokeLinecap="round" strokeLinejoin="round"
                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                    </svg>
                    <span>Change Password</span>
                </a>


                <!-- item-->
                <a href="{{ route('chef.logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="dropdown-item notify-item">
                    <svg class="filament-dropdown-list-item-icon mr-2 h-5 w-5 rtl:ml-2 rtl:mr-0 group-hover:text-white group-focus:text-white text-gray-500"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"
                        width="20" height="20">
                        <path fill-rule="evenodd"
                            d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span>Logout</span>
                </a>
                <form id="logout-form"
                    action="{{ 'App\Models\Supplier' == Auth::getProvider()->getModel() ? route('chef.logout') : route('chef.logout') }}"
                    method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </li>

    </ul>
    <div class="m-toggle">
        <button class="button-menu-mobile open-left">
            <svg class="w-6 h-6" width="32" height="32" viewBox="0 0 24 24" stroke-width="2" stroke="#000">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5">
                </path>
            </svg>
        </button>
        <button type="button" class="btn btn-sm btn-dark" style="margin-top: 22px;">Welcome Chef</button>
    </div>
</div>
