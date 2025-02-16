<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TechBlog</title>
    <link rel="icon" href="{{ asset('img/Fevicon.png') }}" type="image/png">

    <link rel="stylesheet" href="{{ asset('vendors/bootstrap/bootstrap.min.css') }}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" /> --}}
    <link rel="stylesheet" href="{{ asset('vendors/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/linericon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/owl-carousel/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
@yield('css')

<body>
    <!--================Header Menu Area =================-->
    <header class="header_area">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container box_1620">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="{{ url('/') }}">
                        {{-- <img src="{{ asset('img/logo.png') }}" alt=""> --}}
                        <h4 class="logoText" style="font-weight: bold;"> TechBlog </h4>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav justify-content-center">
                            <li class="nav-item {{ Request::is('/') ? 'active' : '' }}"><a class="nav-link"
                                    href="{{ url('/') }}">Home</a></li>
                            <li
                                class="nav-item {{ Request::is('search') || Request::is('search-post') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('/search') }}">Search</a>
                            </li>
                            <li
                                class="nav-item submenu dropdown {{ Request::is('create') || Request::is('*/view') || Request::is('*/edit') ? 'active' : '' }}">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false">Post</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="{{ url('/create') }}">Create a
                                            post</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right navbar-social">
                            @if (Auth::check())
                                <li class="nav-item submenu dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"
                                        role="button" aria-haspopup="true" aria-expanded="false"><i
                                            class="fa-regular fa-user"> {{ explode(' ', Auth::user()->name)[0] }}
                                        </i></a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item"><a class="nav-link" href="blog-details.html"><i
                                                    class="fa-regular fa-user"> Profile </i></a>
                                        <li class="nav-item"><a class="nav-link" href="{{ url('/logout') }}"><i
                                                    class="fa-solid fa-arrow-right-from-bracket"> Logout </i></a>
                                        </li>
                                    </ul>
                                </li>
                            @else
                                <li><a href="{{ url('/login') }}"><i class="fa-solid fa-right-to-bracket"> Login
                                        </i></a>
                                </li>
                                <li><a href="{{ url('/register') }}"><i class="fa-regular fa-id-card"> Register
                                        </i></a>
                                </li>
                            @endif
                        </ul>

                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!--================Header Menu Area =================-->

    <main class="site-main">

        @yield('bannerAndSlider')

        <!--================ Start Blog Post Area =================-->
        <section class="blog-post-area section-margin mt-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">

                        @yield('body')

                    </div>

                    <!-- Start Blog Post Siddebar -->
                    <div class="col-lg-4 sidebar-widgets">
                        <div class="widget-wrap">

                            <div class="single-sidebar-widget popular-post-widget">
                                <h4 class="single-sidebar-widget__title">Popular Post</h4>
                                <div class="popular-post-list">
                                    @foreach ($popularPost as $post)
                                        <div class="single-post-list">
                                            <div class="thumb">
                                                <img class="card-img rounded-0" src="{{ $post->thumbnail }}"
                                                    alt="">
                                                <ul class="thumb-info">
                                                    <li><a
                                                            href="#">{{ Str::limit($post->user->name, 9, '...') }}</a>
                                                    </li>
                                                    <li><a href="#">{{ $post->updated_at->format('M d') }}</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="details mt-20">
                                                <a id="readMoreBTN" href="#" data-id="{{ $post->id }}">
                                                    <h6>{{ $post->title }}</h6>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- End Blog Post Siddebar -->
            </div>
        </section>
        <!--================ End Blog Post Area =================-->
    </main>

    <!--================ Start Footer Area =================-->
    <footer class="footer-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3  col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>About Us</h6>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                            ut labore dolore
                            magna aliqua.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4  col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>Newsletter</h6>
                        <p>Stay update with our latest</p>
                        <div class="" id="mc_embed_signup">

                            <form target="_blank" novalidate="true"
                                action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                                method="get" class="form-inline">

                                <div class="d-flex flex-row">

                                    <input class="form-control" name="EMAIL" placeholder="Enter Email"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '"
                                        required="" type="email">


                                    <button class="click-btn btn btn-default"><span
                                            class="lnr lnr-arrow-right"></span></button>
                                    <div style="position: absolute; left: -5000px;">
                                        <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1"
                                            value="" type="text">
                                    </div>

                                    <!-- <div class="col-lg-4 col-md-4">
                    <button class="bb-btn btn"><span class="lnr lnr-arrow-right"></span></button>
                  </div>  -->
                                </div>
                                <div class="info"></div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3  col-md-6 col-sm-6">
                    <div class="single-footer-widget mail-chimp">
                        <h6 class="mb-20">Instragram Feed</h6>
                        <ul class="instafeed d-flex flex-wrap">
                            <li><img src="{{ asset('img/instagram/i1.jpg') }}" alt=""></li>
                            <li><img src="{{ asset('img/instagram/i2.jpg') }}" alt=""></li>
                            <li><img src="{{ asset('img/instagram/i3.jpg') }}" alt=""></li>
                            <li><img src="{{ asset('img/instagram/i4.jpg') }}" alt=""></li>
                            <li><img src="{{ asset('img/instagram/i5.jpg') }}" alt=""></li>
                            <li><img src="{{ asset('img/instagram/i6.jpg') }}" alt=""></li>
                            <li><img src="{{ asset('img/instagram/i7.jpg') }}" alt=""></li>
                            <li><img src="{{ asset('img/instagram/i8.jpg') }}" alt=""></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>Follow Us</h6>
                        <p>Let us be social</p>
                        <div class="footer-social d-flex align-items-center">
                            <a href="#">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#">
                                <i class="fab fa-dribbble"></i>
                            </a>
                            <a href="#">
                                <i class="fab fa-behance"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
                <p class="footer-text m-0">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved | This template is made with <i class="fa fa-heart"
                        aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
            </div>
        </div>
    </footer>
    <!--================ End Footer Area =================-->

    <script src="{{ asset('vendors/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <script src="https://kit.fontawesome.com/d639410787.js"></script>
    <script src="{{ asset('vendors/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('js/mail-script.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @yield('script')
    <script>
        $(document).on('click', '#readMoreBTN', function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            window.location = window.location.origin + '/' + id + '/view';
        });
    </script>
</body>

</html>
