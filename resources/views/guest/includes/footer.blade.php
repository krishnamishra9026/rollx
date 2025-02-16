
    <footer class="main-footer desktop-view">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-12">
                    <div class="footer-logo text-center">
                        <img src="{{ asset('assets/images/logo/color-logo-no-background.svg') }}" alt=""
                            class="logo-dark" width="270" height="60" />
                    </div>
                </div>
                <div class="col-sm-3 col-12">
                    <div class="footer-menu">
                        <h5>@lang('navbar.nb_home_owner')</h5>
                        <ul class="list-unstyled">
                            
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3 col-12">
                    <div class="footer-menu">
                        <h5>@lang('navbar.nb_trades_person')</h5>
                        <ul class="list-unstyled">
                            
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3 col-12">
                    <div class="footer-menu">
                        <h5>@lang('navbar.nb_about')</h5>
                        <ul class="list-unstyled">
                            
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3 col-12">
                    <div class="social-menu">
                        <h5>@lang('navbar.nb_follow_us')</h5>
                        <ul class="list-inline">
                           
                        </ul>
                        <h6 class="select-lan">@lang('navbar.nb_language')</h6>
                        <div class="m-language">
                        </div>

                    </div>
                </div>
            </div>
            <hr style="color:#adadad">
            <div class="copyright">
                <p><i class="mdi mdi-copyright"></i> @lang('navbar.nb_copy_right')</p>

            </div>
        </div>
    </footer>
    <div class="mobile-footer mobile-view">
        <div class="container">
            <div class="footer-logo text-center">
                <img src="{{ asset('assets/images/logo/color-logo-no-background.svg') }}" alt=""
                    class="logo-dark mb-2" width="270" height="60" />
            </div>
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0 mt-0">
                        <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"><i class="fa fa-plus"></i>@lang('navbar.nb_home_owner')</button>
                        </h2>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="footer-menu">
                                <ul class="list-unstyled">
                                   
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0 mt-0">
                        <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"><i class="fa fa-plus"></i>@lang('navbar.nb_trades_person')</button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="footer-menu">
                                <ul class="list-unstyled">
                                   
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0 mt-0">
                        <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree"><i class="fa fa-plus"></i>@lang('navbar.nb_about')</button>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="footer-menu">
                                <ul class="list-unstyled">
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingFour">
                        <h2 class="mb-0 mt-0">
                        <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour"><i class="fa fa-plus"></i>@lang('navbar.nb_follow_us')</button>
                        </h2>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="social-menu">
                                <ul class="list-inline">
                                   
                                </ul>
                                <h6 class="select-lan">@lang('navbar.nb_language')</h6>
                                <div class="m-language">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright mt-3">
                <p><i class="mdi mdi-copyright"></i> @lang('navbar.nb_copy_right')</p>
            </div>
        </div>
    </div>
@push('scripts')

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/5.6.3/js/jquery.mmenu.min.js"></script>

    <script>
        var myMenu = $("#menu");

        // initialize mmenu
        myMenu.mmenu({});

        // initialize mmenu API
        var myMenuAPI = myMenu.data("mmenu");


        // function to set to specific subMenu
        function setMMenu(subMenu) {
            // set to subMenu
            var current = myMenu.find(subMenu);

            // myMenuAPI.setSelected(current.first());
            myMenuAPI.openPanel(current.closest(".mm-panel"));
        }

        // function to open mmmenu to specific subMenu
        function openMMenu() {
            myMenuAPI.open();
        }

        function openNav() {
            document.getElementById("mySidebar").style.width = "320px";
        }

        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
        }
    </script>

    <script>
        $(document).ready(function () {
    // Add minus icon for collapse element which is open by default
    $(".collapse.show").each(function () {
        $(this)
        .prev(".card-header")
        .find(".fa")
        .addClass("fa-minus")
        .removeClass("fa-plus");
    });

    // Toggle plus minus icon on show hide of collapse element
    $(".collapse")
        .on("show.bs.collapse", function () {
        $(this)
            .prev(".card-header")
            .find(".fa")
            .removeClass("fa-plus")
            .addClass("fa-minus");
        })
        .on("hide.bs.collapse", function () {
        $(this)
            .prev(".card-header")
            .find(".fa")
            .removeClass("fa-minus")
            .addClass("fa-plus");
        });
    });
    </script>
@endpush
