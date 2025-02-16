<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <meta name="description" content="@yield('meta-desc')" />
    <meta name="keywords" content="@yield('meta-keywords')" />
    <meta content="FindmyTradesman.es Landscape PVT LTD" name="author" />
    <meta name="og:description" content="@yield('og-desc')" />
    <meta name="og:title" content="@yield('og-title')" />
    <meta name="og:type" content="@yield('og-type')" />
    <meta name="og:image" content="{{ asset('assets/images/site-logo.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="canonical" href="{{ Request::url() }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="Home - Find My Tradesman" />
    <meta name="twitter:description"
        content="EFFICIENCY We strive to respond &amp; deliver promptly to provide a fun, seamless &amp; simple landscaping experience for you. KNOWLEDGE We leverage on more than 30 years of expertise &amp; experience to deliver professional &amp; satisfactory services. INNOVATION We keep abreast of the the landscape industry trends to bring to you the latest landscaping solutions." />
    <meta name="twitter:image"
        content="{{ asset('assets/images/site-logo.png') }}" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- <link href="https://fonts.googleapis.com/css2?family=Changa:wght@200..800&family=IM+Fell+English+SC&display=swap"
        rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />

    <!-- App css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/5.6.1/css/jquery.mmenu.all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    @yield('head')
</head>

<body class="loading"
    data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <div class="wrapper">
    {{-- <video id="background-video" autoplay loop muted>
        <source src="{{ asset('assets/videos/background.mp4') }}" type="video/mp4">
    </video> --}}
    @include('guest.includes.navbar-guest')
    @yield('content')
    @include('guest.includes.footer')
    @include('guest.includes.script')
</body>

</html>
