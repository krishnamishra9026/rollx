@if (app()->getLocale() == 'es')
    <a href="{{ route('change-language', 'es') }}" class="nav-link dropdown-toggle d-flex language-toggle"
        data-bs-toggle="dropdown" aria-expanded="false">
        <img src="{{ asset('assets/images/flags/spain.jpg') }}" alt="flags"><span class="d-none d-xl-block d-none d-xl-block desktop-view">Spanish</span>
    </a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ route('change-language', 'us') }}"><img
                    src="{{ asset('assets/images/flags/uk.png') }}" class="me-1" alt="flags" width="27"
                    height="18"> English</a></li>
        <li><a class="dropdown-item" href="{{ route('change-language', 'nl') }}"><img
                    src="{{ asset('assets/images/flags/bq.png') }}" class="me-1" alt="flags" width="27"
                    height="18"> Dutch</a></li>
        <li><a class="dropdown-item" href="{{ route('change-language', 'no') }}"><img
                    src="{{ asset('assets/images/flags/bv.png') }}" class="me-1" alt="flags" width="27"
                    height="18"> Norwegian</a></li>
        <li><a class="dropdown-item" href="{{ route('change-language', 'pl') }}"><img
                    src="{{ asset('assets/images/flags/pl.png') }}" class="me-1" alt="flags" width="27"
                    height="18"> Polish</a></li>
    </ul>
@elseif (app()->getLocale() == 'nl')
    <a href="{{ route('change-language', 'nl') }}" class="nav-link dropdown-toggle d-flex language-toggle"
        data-bs-toggle="dropdown" aria-expanded="false">
        <img src="{{ asset('assets/images/flags/bq.png') }}" alt="flags"><span class="d-none d-xl-block desktop-view">Dutch</span>
    </a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ route('change-language', 'us') }}"><img
                    src="{{ asset('assets/images/flags/uk.png') }}" class="me-1" alt="flags" width="27"
                    height="18"> English</a></li>
        <li><a class="dropdown-item" href="{{ route('change-language', 'es') }}"><img
                    src="{{ asset('assets/images/flags/spain.jpg') }}" class="me-1" alt="flags" width="27"
                    height="18"> Spanish</a></li>
        <li><a class="dropdown-item" href="{{ route('change-language', 'no') }}"><img
                    src="{{ asset('assets/images/flags/bv.png') }}" class="me-1" alt="flags" width="27"
                    height="18"> Norwegian</a></li>
        <li><a class="dropdown-item" href="{{ route('change-language', 'pl') }}"><img
                    src="{{ asset('assets/images/flags/pl.png') }}" class="me-1" alt="flags" width="27"
                    height="18"> Polish</a></li>
    </ul>
@elseif (app()->getLocale() == 'no')
    <a href="{{ route('change-language', 'no') }}" class="nav-link dropdown-toggle d-flex language-toggle"
        data-bs-toggle="dropdown" aria-expanded="false">
        <img src="{{ asset('assets/images/flags/bv.png') }}" alt="flags"><span class="d-none d-xl-block desktop-view">Norwegian</span>
    </a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ route('change-language', 'us') }}"><img
                    src="{{ asset('assets/images/flags/uk.png') }}" class="me-1" alt="flags" width="27"
                    height="18"> English</a></li>
        <li><a class="dropdown-item" href="{{ route('change-language', 'es') }}"><img
                    src="{{ asset('assets/images/flags/spain.jpg') }}" class="me-1" alt="flags" width="27"
                    height="18"> Spanish</a></li>
        <li><a class="dropdown-item" href="{{ route('change-language', 'no') }}"><img
                    src="{{ asset('assets/images/flags/bq.png') }}" class="me-1" alt="flags" width="27"
                    height="18"> Dutch</a></li>
        <li><a class="dropdown-item" href="{{ route('change-language', 'pl') }}"><img
                    src="{{ asset('assets/images/flags/pl.png') }}" class="me-1" alt="flags" width="27"
                    height="18"> Polish</a></li>
    </ul>
@elseif (app()->getLocale() == 'pl')
    <a href="{{ route('change-language', 'pl') }}" class="nav-link dropdown-toggle d-flex language-toggle"
        data-bs-toggle="dropdown" aria-expanded="false">
        <img src="{{ asset('assets/images/flags/pl.png') }}" alt="flags"><span class="d-none d-xl-block desktop-view">Polish</span>
    </a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ route('change-language', 'us') }}"><img
                    src="{{ asset('assets/images/flags/uk.png') }}" class="me-1" alt="flags" width="27"
                    height="18"> English</a></li>
        <li><a class="dropdown-item" href="{{ route('change-language', 'es') }}"><img
                    src="{{ asset('assets/images/flags/spain.jpg') }}" class="me-1" alt="flags" width="27"
                    height="18"> Spanish</a></li>
        <li><a class="dropdown-item" href="{{ route('change-language', 'nl') }}"><img
                    src="{{ asset('assets/images/flags/bq.png') }}" class="me-1" alt="flags" width="27"
                    height="18"> Dutch</a></li>
        <li><a class="dropdown-item" href="{{ route('change-language', 'no') }}"><img
                    src="{{ asset('assets/images/flags/bv.png') }}" class="me-1" alt="flags" width="27"
                    height="18"> Norwegian</a></li>
    </ul>
@else
    <a href="{{ route('change-language', 'us') }}" class="nav-link dropdown-toggle d-flex language-toggle"
        data-bs-toggle="dropdown" aria-expanded="false">
        <img src="{{ asset('assets/images/flags/uk.png') }}" alt="flags"><span class="d-none d-xl-block desktop-view">English</span>
    </a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ route('change-language', 'es') }}"><img
                    src="{{ asset('assets/images/flags/spain.jpg') }}" class="me-1" alt="flags" width="27"
                    height="18"> Spanish</a></li>
        <li><a class="dropdown-item" href="{{ route('change-language', 'nl') }}"><img
                    src="{{ asset('assets/images/flags/bq.png') }}" class="me-1" alt="flags" width="27"
                    height="18"> Dutch</a></li>
        <li><a class="dropdown-item" href="{{ route('change-language', 'no') }}"><img
                    src="{{ asset('assets/images/flags/bv.png') }}" class="me-1" alt="flags" width="27"
                    height="18"> Norwegian</a></li>
        <li><a class="dropdown-item" href="{{ route('change-language', 'pl') }}"><img
                    src="{{ asset('assets/images/flags/pl.png') }}" class="me-1" alt="flags" width="27"
                    height="18"> Polish</a></li>
    </ul>
@endif
