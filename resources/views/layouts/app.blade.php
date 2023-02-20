<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('images/choco-logo-color.jpeg') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('images/choco-logo-color.jpeg') }}" type="image/x-icon">
    <title>KPI-RP : @yield('title')</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/vendors/font-awesome.css') }}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/vendors/icofont.css') }}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/vendors/themify.css') }}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/vendors/flag-icon.css') }}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/vendors/feather-icon.css') }}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/vendors/sweetalert2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/vendors/prism.css') }}">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/vendors/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.css') }}">
    <style>
        .label {
            padding: .2em .6em .3em;
        }

        .sidebar-link.sidebar-title.thisMenu {
            background: rgba(99, 98, 231, 0.5) !important;
            color: white !important;
        }

        .thisMenu span {
            color: white !important;
        }

        .box-layout {
            background-repeat: no-repeat !important;
            background-size: cover !important;
        }

        .dataTables_wrapper table.dataTable td {
            padding: 0.35rem 0.5rem;
        }

        .dataTables_wrapper .btn-group button {
            margin: 0;
        }

        .dropdown-menu .dropdown-item {
            opacity: 1 !important;
        }

        .dropdown-divider {
            border-top: 0.1rem solid rgba(0, 0, 0, 1);
        }

        body {
            overflow: hidden;
        }
    </style>
    @yield('css')
</head>

<body class="box-layout">
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        <div class="page-header">
            <div class="header-wrapper row m-0">
                <div class="header-logo-wrapper col-auto p-0">
                    <div class="logo-wrapper"><a href=""><img class="img-fluid"
                                src="{{ asset('images/choco-logo.png') }}" alt=""></a></div>
                    <div class="toggle-sidebar">
                        <div class="status_toggle sidebar-toggle d-flex">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <g>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M21.0003 6.6738C21.0003 8.7024 19.3551 10.3476 17.3265 10.3476C15.2979 10.3476 13.6536 8.7024 13.6536 6.6738C13.6536 4.6452 15.2979 3 17.3265 3C19.3551 3 21.0003 4.6452 21.0003 6.6738Z"
                                            stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M10.3467 6.6738C10.3467 8.7024 8.7024 10.3476 6.6729 10.3476C4.6452 10.3476 3 8.7024 3 6.6738C3 4.6452 4.6452 3 6.6729 3C8.7024 3 10.3467 4.6452 10.3467 6.6738Z"
                                            stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M21.0003 17.2619C21.0003 19.2905 19.3551 20.9348 17.3265 20.9348C15.2979 20.9348 13.6536 19.2905 13.6536 17.2619C13.6536 15.2333 15.2979 13.5881 17.3265 13.5881C19.3551 13.5881 21.0003 15.2333 21.0003 17.2619Z"
                                            stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M10.3467 17.2619C10.3467 19.2905 8.7024 20.9348 6.6729 20.9348C4.6452 20.9348 3 19.2905 3 17.2619C3 15.2333 4.6452 13.5881 6.6729 13.5881C8.7024 13.5881 10.3467 15.2333 10.3467 17.2619Z"
                                            stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </g>
                                </g>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="left-side-header col ps-0 d-none d-md-block">
                </div>
                <div class="nav-right col-10 col-sm-6 pull-right right-header p-0">
                    <ul class="nav-menus">
                        <li class="profile-nav onhover-dropdown pe-0 py-0 me-0">
                            <div class="media profile-media">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <g>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M9.55851 21.4562C5.88651 21.4562 2.74951 20.9012 2.74951 18.6772C2.74951 16.4532 5.86651 14.4492 9.55851 14.4492C13.2305 14.4492 16.3665 16.4342 16.3665 18.6572C16.3665 20.8802 13.2505 21.4562 9.55851 21.4562Z"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M9.55849 11.2776C11.9685 11.2776 13.9225 9.32356 13.9225 6.91356C13.9225 4.50356 11.9685 2.54956 9.55849 2.54956C7.14849 2.54956 5.19449 4.50356 5.19449 6.91356C5.18549 9.31556 7.12649 11.2696 9.52749 11.2776H9.55849Z"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path
                                                d="M16.8013 10.0789C18.2043 9.70388 19.2383 8.42488 19.2383 6.90288C19.2393 5.31488 18.1123 3.98888 16.6143 3.68188"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path
                                                d="M17.4608 13.6536C19.4488 13.6536 21.1468 15.0016 21.1468 16.2046C21.1468 16.9136 20.5618 17.6416 19.6718 17.8506"
                                                stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <ul class="profile-dropdown onhover-show-div">
                                <li><a href=""><i data-feather="user"></i><span>Account </span></a>
                                <li><a href="#"
                                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"><i
                                            data-feather="log-in"> </i><span>Log out</span></a></li>
                            </ul>
                        </li>
                    </ul>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
                <script class="result-template" type="text/x-handlebars-template">
            <div class="ProfileCard u-cf">
            <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
            <div class="ProfileCard-details">
            <div class="ProfileCard-realName">"[[name]]</div>
            </div>
            </div>
          </script>
                <script class="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
            </div>
        </div>
        <!-- Page Header Ends                              -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper horizontal-menu">
            <!-- Page Sidebar Start-->
            <div class="sidebar-wrapper">
                <div>
                    <div class="logo-wrapper">
                        <a href="">
                            {{-- <img class="img-fluid for-light" src="{{ asset('images/choco-logo.png') }}"
                                alt="">
                            <img class="img-fluid for-dark" src="{{ asset('images/choco-logo.png') }}"
                                alt=""> --}}
                        </a>
                        <div class="back-btn"><i class="fa fa-angle-left"></i></div>
                    </div>
                    <div class="logo-icon-wrapper"><a href=""><img class="img-fluid"
                                src="{{ asset('images/logo-icon.png') }}" alt=""></a></div>
                    <nav class="sidebar-main">
                        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                        <div id="sidebar-menu">
                            <ul class="sidebar-links" id="simple-bar">
                                <li class="back-btn"><a href=""><img class="img-fluid"
                                            src="{{ asset('images/logo-icon.png') }}" alt=""></a>
                                    <div class="mobile-back text-end"><span>Back</span><i
                                            class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                                </li>
                                <li class="sidebar-list"><a
                                        class="sidebar-link sidebar-title @if (Route::is('home')) thisMenu @endif"
                                        href=""><i data-feather="file-text"></i><span>Report
                                        </span></a></li>
                                <li class="sidebar-list"><a
                                        class="sidebar-link sidebar-title @if (Route::is('histories.*')) thisMenu @endif"
                                        href="{{ route('histories.index')}}">
                                        <i data-feather="list"></i><span>History </span></a></li>
                                <li class="sidebar-list"><a
                                        class="sidebar-link sidebar-title @if (Route::is('holidays.*')) thisMenu @endif"
                                        href="{{ route('holidays.index') }}"><i
                                            data-feather="aperture"></i><span>Holiday</span></a></li>
                                <li class="sidebar-list"><a
                                        class="sidebar-link sidebar-title @if (Route::is('teams.*')) thisMenu @endif"
                                        href="{{ route('teams.index') }}"><i
                                            data-feather="users"></i><span>Team</span></a></li>
                                <li class="sidebar-list"><a
                                        class="sidebar-link sidebar-title @if (Route::is('accounts.*')) thisMenu @endif"
                                        href="{{ route('accounts.index') }}"><i data-feather="user"></i><span>Account
                                        </span></a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
            <!-- Page Sidebar Ends-->
            <div class="page-body">
                <div class="container-fluid">
                    @yield('breadcrumb')
                </div>
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- Container-fluid Ends-->
            </div>
            <!-- footer start-->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 footer-copyright text-center">
                            <p class="mb-0">Copyright 2022 © Report Converter by preedata.ch </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- latest jquery-->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('js/icons/feather-icon/feather-icon.js') }}"></script>
    <!-- scrollbar js-->
    <script src="{{ asset('js/scrollbar/simplebar.js') }}"></script>
    <script src="{{ asset('js/scrollbar/custom.js') }}"></script>
    <!-- Sidebar jquery-->
    <script src="{{ asset('js/config.js') }}"></script>
    <!-- Plugins JS start-->
    <script src="{{ asset('js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('js/prism/prism.min.js') }}"></script>
    <script src="{{ asset('js/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ asset('js/custom-card/custom-card.js') }}"></script>
    <script src="{{ asset('js/typeahead/handlebars.js') }}"></script>
    <script src="{{ asset('js/typeahead/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('js/typeahead/typeahead.custom.js') }}"></script>
    <script src="{{ asset('js/typeahead-search/handlebars.js') }}"></script>
    <script src="{{ asset('js/tooltip-init.js') }}"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('js/script.js') }}"></script>
    @include('sweetalert::alert')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <!-- login js-->
    <!-- Plugin used-->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function fncDelete(e) {
            let text = $(e).attr('data-text');
            let form = $(e).attr('data-form');
            let popup = new swal({
                title: "Are you sure?",
                text: "Once deleted, You won't be able to revert this!",
                icon: "warning",
                buttons: {
                    cancel: true,
                    confirm: {
                        text: text,
                        className: 'btn-danger'
                    },
                },
            }).then((willDelete) => {
                if (willDelete) {
                    $('#' + form).submit();
                } else {
                    swal.close();
                }
            });
            return popup;
        }
    </script>
    @yield('javascript')
</body>

</html>
