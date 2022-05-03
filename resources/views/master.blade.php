<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Quản lý học sinh</title>
    <!-- loader-->
    <link href="{{ asset('/Css/assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('/Css/assets/js/pace.min.js') }}"></script>
    <!--favicon-->
    <link rel="icon" href="{{ asset('/Css/assets/images/favicon.ico') }}" type="image/x-icon">
    <!-- Vector CSS -->
    {{-- <link href="{{asset('Css/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet"/> --}}
    <!-- simplebar CSS-->
    <link href="{{ asset('/Css/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <!-- Bootstrap core CSS-->
    <link href="{{ '/Css/assets/css/bootstrap.min.css' }}" rel="stylesheet" />
    <!-- animate CSS-->
    <link href="{{ asset('/Css/assets/css/animate.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons CSS-->
    <link href="{{ asset('/Css/assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <!-- Sidebar CSS-->
    <link href="{{ asset('/Css/assets/css/sidebar-menu.css') }}" rel="stylesheet" />
    <!-- Custom Style-->
    <link href="{{ asset('/Css/assets/css/app-style.css') }}" rel="stylesheet" />
    <!-- toastr js -->

    @yield('css');

</head>

<body class="bg-theme bg-theme1">

    <!-- Start wrapper-->
    <div id="wrapper">

        <!--Start sidebar-wrapper-->
        <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
            <div class="brand-logo">
                <a href="index.html">
                    <img src="{{ asset('/Css/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
                    <h5 class="logo-text">Quản lý học sinh</h5>
                </a>
            </div>
            <ul class="sidebar-menu do-nicescrol">

                <li>
                    <a href="{{ route('user.listUser') }}">
                        <i class="zmdi zmdi-view-dashboard"></i> <span>Giáo viên</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('student.index') }}">
                        <i class="zmdi zmdi-invert-colors"></i> <span>Học sinh</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('lophoc.index') }}">
                        <i class="zmdi zmdi-format-list-bulleted"></i> <span>Lớp</span>
                    </a>
                </li>
                        <li><a class="student-search" href="{{route('student.viewSearch')}}"><i class="fa fa-search"></i>Tra cứu học sinh</a></li>


                {{-- <li >
                    <button class="dropdown-btn sidebar-menu do-nicescrol">
                        <i class="fa fa-search"></i>
                        <span>Tra cứu</span>
                        </button>
                    <ul class="dropdown-container sidebar-menu do-nicescrol">
                        <li>
                            <a href="{{route('student.search')}}">
                                <i class="zmdi zmdi-format-list-bulleted"></i> <span>Tra cứu học sinh</span>
                            </a>
                        </li>
                    </ul>
                </li> --}}

            </ul>

        </div>
        <!--End sidebar-wrapper-->

        <!--Start topbar header-->
        <header class="topbar-nav">
            <nav class="navbar navbar-expand fixed-top">
                <ul class="navbar-nav mr-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link toggle-menu" href="javascript:void();">
                            <i class="icon-menu menu-icon"></i>
                        </a>
                    </li>

                </ul>

                <ul class="navbar-nav align-items-center right-nav-link">
                    <li class="nav-item dropdown-lg">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown"
                            href="javascript:void();">
                            <i class="fa fa-envelope-open-o"></i></a>
                    </li>
                    <li class="nav-item dropdown-lg">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown"
                            href="javascript:void();">
                            <i class="fa fa-bell-o"></i></a>
                    </li>
                    <li class="nav-item language">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown"
                            href="javascript:void();"><i class="fa fa-flag"></i></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item"> <i class="flag-icon flag-icon-gb mr-2"></i> English</li>
                            <li class="dropdown-item"> <i class="flag-icon flag-icon-fr mr-2"></i> French</li>
                            <li class="dropdown-item"> <i class="flag-icon flag-icon-cn mr-2"></i> Chinese</li>
                            <li class="dropdown-item"> <i class="flag-icon flag-icon-de mr-2"></i> German</li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
                            <span class="user-profile"><img src="{{asset( Auth::user()->image) }}" class="img-circle"
                                    alt="user avatar"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item user-details">
                                <a href="javaScript:void();">
                                    <div class="media">
                                        <div class="avatar"><img class="align-self-start mr-3"
                                                src="{{asset(Auth::user()->image) }}" alt="user avatar"></div>
                                        <div class="media-body">
                                            <h6 class="mt-2 user-title">{{ Auth::user()->name }}</h6>
                                            <p class="user-subtitle">{{ Auth::user()->email }}</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            {{-- <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="icon-envelope mr-2"></i> Inbox</li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="icon-wallet mr-2"></i> Account</li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="icon-settings mr-2"></i> Setting</li>
        <li class="dropdown-divider"></li> --}}
                            <li class="dropdown-item"><i class="icon-power mr-2"></i><a
                                    href="{{ route('logout') }}">Đăng xuất</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>
        <!--End topbar header-->

        <div class="clearfix"></div>

        <div class="content-wrapper">
            <div class="container-fluid">

                <!--Start Dashboard Content-->



                @yield('content')



                <!--End Dashboard Content-->

                <!--start overlay-->
                <div class="overlay toggle-menu"></div>
                <!--end overlay-->

            </div>
            <!-- End container-fluid-->

        </div>
        <!--End content-wrapper-->
        <!--Start Back To Top Button-->
        <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
        <!--End Back To Top Button-->

        <!--Start footer-->
        <footer class="footer">
            <div class="container">
                <div class="text-center">
                    Copyright © 2018 Dashtreme Admin
                </div>
            </div>
        </footer>
        <!--End footer-->

        <!--start color switcher-->
        <div class="right-sidebar">
            <div class="switcher-icon">
                <i class="zmdi zmdi-settings zmdi-hc-spin"></i>
            </div>
            <div class="right-sidebar-content">

                <p class="mb-0">Gaussion Texture</p>
                <hr>

                <ul class="switcher">
                    <li id="theme1"></li>
                    <li id="theme2"></li>
                    <li id="theme3"></li>
                    <li id="theme4"></li>
                    <li id="theme5"></li>
                    <li id="theme6"></li>
                </ul>

                <p class="mb-0">Gradient Background</p>
                <hr>

                <ul class="switcher">
                    <li id="theme7"></li>
                    <li id="theme8"></li>
                    <li id="theme9"></li>
                    <li id="theme10"></li>
                    <li id="theme11"></li>
                    <li id="theme12"></li>
                    <li id="theme13"></li>
                    <li id="theme14"></li>
                    <li id="theme15"></li>
                </ul>

            </div>
        </div>
        <!--end color switcher-->

    </div>
    <!--End wrapper-->

    <!-- Bootstrap core JavaScript-->
    {{-- <script src="{{asset('/Css/assets/js/jquery.min.js')}}"></script> --}}
    {{-- <script src="{{asset('/Css/assets/js/popper.min.js')}}"></script> --}}
    {{-- <script src="{{asset('/Css/assets/js/bootstrap.min.js')}}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <!-- simplebar js -->
    <script src="{{ asset('/Css/assets/plugins/simplebar/js/simplebar.js') }}"></script>
    <!-- sidebar-menu js -->
    <script src="{{ asset('/Css/assets/js/sidebar-menu.js') }}"></script>
    <!-- loader scripts -->
    {{-- <script src="{{asset('Css/assets/js/jquery.loading-indicator.js')}}"></script> --}}
    <!-- Custom scripts -->
    {{-- <script src="{{asset('/Css/assets/js/app-script.js')}}"></script> --}}
    <!-- Chart js -->

    <script src="{{ asset('/Css/assets/plugins/Chart.js/Chart.min.js') }}"></script>

    <!-- Index js -->
    {{-- <script src="{{asset('/Css/assets/js/index.js')}}"></script> --}}

    @yield('js')

</body>

</html>
