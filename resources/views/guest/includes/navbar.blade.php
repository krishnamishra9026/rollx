
    <nav class="navbar navbar-expand-lg navbar-dark desktop-view">
        <div class="container">
            <!-- logo -->
            <a href="{{ url('/') }}" class="navbar-brand me-lg-5">
                <img src="{{ asset('assets/images/logo/color-logo-no-background.svg') }}" alt="user-image"
                    class="img-fluid">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <i class="mdi mdi-menu"></i>
            </button>
            <!-- menus -->
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <!-- left menu -->
                <ul class="navbar-nav m-auto mhome">
                    <li class="nav-item"><a href="/" class="nav-link">@lang('navbar.nb_home')</a></li>
                   
                </ul>
                <!-- right menu -->
                <ul class="navbar-nav ms-auto m_menu">

                 
                </ul>
            </div>
        </div>
    </nav>
{{-- End Desktop Header --}}

{{-- Mobile Header --}}
    <header class="mobile-menu mobile-view">
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <a href="{{ url('/') }}" class="navbar-brand me-lg-5">
                        <img src="{{ asset('assets/images/logo/color-logo-no-background.svg') }}" alt="user-image" class="img-fluid">
                    </a>
                </div>
                <div class="col-2 text-end">
                </div>
                <div class="col-2">
                    <div class="m-triger text-end">
                        <a class="navbar-toggle" type="button" class="openbtn" onclick="openNav()" href="javascript:openMMenu();">
                            <span><i class="mdi mdi-menu"></i></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!--Menu-->
        <div id="mySidebar">
            <nav id="menu">
                <ul>
                    <li><a href="/" class="nav-link">@lang('navbar.nb_home')</a></li>
                </ul>
            </nav>
        </div>
    </header>

