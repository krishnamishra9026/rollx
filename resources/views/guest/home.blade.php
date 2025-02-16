@extends('layouts.app')

@section('title', '')
@section('og-title', '')

@section('meta-desc', '')
@section('og-desc', '')
@section('og-type', 'website')
@section('meta-keywords', 'Gardening')
@section('head')

@endsection
@section('content')
    <section class="home-banner">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-8 col-xl-7 col-12">
                    <div class="caption">
                        <h1>{{ 'Finding a local Tradesman for you' }}</h1>
                        <p>{{  'Your reliable partner for every job' }}</p>
                        <h4>{{ 'Post your job & get quotes from Tradesman' }}</h4>
             
                            <div class="declaration d-none d-md-block d-lg-none d-xl-block">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h5>{{ '"No hassle, No hidden cost"' }}</h5>
                                        <p>{{  'Free from unexpected fees or complications' }}</p>
                                    </div>
                                    <div class="col-sm-4">
                                        <h5>{{ '"Approved tradesman"' }}</h5>
                                        <p>{{  'Quality and skilled professionals' }}</p>
                                    </div>
                                    <div class="col-sm-4">
                                        <h5>{{ '"Guaranteed Satisfaction"' }}</h5>
                                        <p>{{   'Delivering quality you can trust' }}</p>
                                    </div>
                                </div>
                            </div>

                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-5 col-12 text-center">

                    <img src="{{ asset('assets/images/hero.png') }}" alt="Best work" class="wrenchMan img-fluid">
                </div>
            </div>
        </div>
    </section>




<section style="display: flex; gap: 20px; flex-wrap: wrap; justify-content: center; padding: 40px; background-color: #f9f9f9;">
    <div style="background: white; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); padding: 20px; border-radius: 10px; text-align: center; width: 200px;">
        <img src="assets/images/insurance.png" alt="Secure Platform" style="width: 50px; margin-bottom: 10px;">
        <h3>Secure Platform</h3>
    </div>
    <div style="background: white; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); padding: 20px; border-radius: 10px; text-align: center; width: 200px;">
        <img src="assets/images/reputation.png" alt="Experienced Tradespeople" style="width: 50px; margin-bottom: 10px;">
        <h3>Experienced Tradespeople</h3>
    </div>
    <div style="background: white; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); padding: 20px; border-radius: 10px; text-align: center; width: 200px;">
        <img src="assets/images/approved.png" alt="Approved And Verified Tradespeople" style="width: 50px; margin-bottom: 10px;">
        <h3>Approved And Verified Tradespeople</h3>
    </div>
    <div style="background: white; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); padding: 20px; border-radius: 10px; text-align: center; width: 200px;">
        <img src="assets/images/file-security.png" alt="Our Guarantee" style="width: 50px; margin-bottom: 10px;">
        <h3>Our Guarantee</h3>
    </div>
    <div style="background: white; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); padding: 20px; border-radius: 10px; text-align: center; width: 200px;">
        <img src="assets/images/friends.png" alt="User Friendly" style="width: 50px; margin-bottom: 10px;">
        <h3>User Friendly</h3>
    </div>
</section>




@endsection


@push('scripts')
    <script>
        const swiper = new Swiper('.swiper', {
            // Optional parameters
            direction: 'horizontal',
            loop: true,
            slidesPerView: 3,
            spaceBetween: 30,

            // If we need pagination
            pagination: {
                el: '.swiper-pagination',
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
    // When screen width is >= 320px (small mobile screens)
    320: {
      slidesPerView: 1,
      spaceBetween: 10,
    },
    // When screen width is >= 480px (larger mobile screens)
    480: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    // When screen width is >= 768px (tablets or small laptops)
    768: {
      slidesPerView: 2,
      spaceBetween: 30,
    },
    // When screen width is >= 1024px (desktop)
    1024: {
      slidesPerView: 3,
      spaceBetween: 40,
    },
  }
        });
    </script>
@endpush
