<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>UniFAST</title>
    <link rel="icon" type="image/png" sizes="1024x1021" href="{{ url('img\UnifastLogo.png') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" type="text/css" href="{{ url('css\bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css\style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css\iframe.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('fonts\fontawesome-all.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('fonts\font-awesome.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('fonts\fontawesome5-overrides.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ url('https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js') }}"></script>

</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0"
                    data-bs-hover-animate="jello" href="#">
                    <div class="sidebar-brand-icon"><img src="{{ url('img\UnifastLogo.png') }}" width="50px"
                            height="50px"></div>
                    <div class="sidebar-brand-text mx-3"><span>FHE Portal</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="nav navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="{{ route('dashboard') }}"><i
                                class="fas fa-home"></i><span>Home</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="{{ route('billings') }}"><i
                                class="fas fa-users"></i><span>FHE Billing</span></a></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0"
                        id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3"
                            id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <h6 id="hei_name_header" name="hei_name_header" class="text-info mb-0"></h6>
                        <script type="text/javascript">
                            $.ajax({
                                url: "/get-heis",
                                method: 'get',
                                success: function(response) {
                                    $('#hei_name_header').text(response.hei_name);
                                }
                            });
                        </script>
                        <ul class="nav navbar-nav flex-nowrap ml-auto">
                            <li class="nav-item dropdown no-arrow" role="presentation">
                                <div id="avatar_header_div" name="avatar_header_div" class="nav-item dropdown no-arrow">
                                    <a class="dropdown-toggle nav-link" data-bs-toggle="dropdown" aria-expanded="false"
                                        href="#"><span
                                            class="d-none d-lg-inline mr-2 text-gray-600 small">{{ Auth::user()->fhe_focal_fname . ' ' . Auth::user()->fhe_focal_mname . ' ' . Auth::user()->fhe_focal_lname }}</span><img
                                            class="border rounded-circle img-profile"
                                            @if (is_null(Auth::user()->avatar)) src="{{ url('storage\images\user.png') }}"
                                        @else
                                        src="{{ url('storage\images') . '/' . Auth::user()->avatar }}" @endif></a>
                                    <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in"
                                        role="menu">
                                        <a class="dropdown-item" role="presentation" href="{{ route('profile') }}"><i
                                                class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Profile</a>
                                        <a class="dropdown-item" role="presentation" href="#"><i
                                                class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Settings</a>
                                        <a class="dropdown-item" role="presentation" href="#"><i
                                                class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Activity
                                            log</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                                                class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
