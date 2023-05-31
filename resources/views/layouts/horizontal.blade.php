<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MagicBox</title>

    <link rel="stylesheet" href="{{asset('theme/css/pages/form-element-select.css')}}">
    <link rel="stylesheet" href="{{asset('theme/css/pages/email.css')}}">
    <link rel="stylesheet" href="{{asset('theme/css/main/app.css')}}">
    <link rel="shortcut icon" href="{{asset('theme/images/logo/favicon.svg')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('theme/images/logo/favicon.png')}}" type="image/png">


    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link rel="stylesheet" href="{{asset('theme/css/shared/iconly.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/DataTables/datatables.css')}}">
    <link rel="stylesheet" href="{{asset('theme/css/pages/filepond.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @yield('page-css')


</head>

<body>
    <div id="app">
        <div id="main" class="layout-horizontal">
            <header class="mb-5">
                <div class="header-top">
                    <div class="container">
                        <div class="logo">
                            <a href="index.html"><img src="{{asset('theme/images/logo/logo.png')}}" alt="Logo" srcset=""></a>
                        </div>
                        <div class="header-top-right">

                            <div class="dropdown">
                                <a href="#" class="user-dropdown d-flex dropend" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="avatar avatar-md2">
                                        <img src="{{asset('theme/images/faces/7.jpg')}}" alt="Avatar">
                                    </div>
                                    <div class="text">
                                        <h6 class="user-dropdown-name">Hey, Welcome</h6>
                                        <p class="user-dropdown-status text-sm text-muted">Sign in here</p>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="#">My Account</a></li>
                                    <li><a class="dropdown-item" href="#">Settings</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="auth-login.html">Logout</a></li>
                                </ul>
                            </div>

                            <!-- Burger button responsive -->
                            <a href="#" class="burger-btn d-block d-xl-none">
                                <i class="bi bi-justify fs-3"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <nav class="main-navbar">
                    <div class="container">
                        <ul>
                            <li class="menu-item">
                                <a href="{{url('')}}" class='menu-link'>
                                    <i class="bi bi-grid-fill"></i>
                                    <span>For Authors</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{url('')}}" class='menu-link'>
                                    <i class="bi bi-grid-fill"></i>
                                    <span>For Reviewers</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{route('pricing')}}" class='menu-link'>
                                    <i class="bi bi-coin"></i>
                                    <span>Pricing</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{route('pricing')}}" class='menu-link'>
                                    <i class="bi bi-info-circle-fill"></i>
                                    <span>About</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>

            </header>

            <div class="content-wrapper container">

                <!-- <div class="page-heading">
                    <h3>Welcome to MagicBox</h3>
                </div> -->
                <div class="page-content">

                    @yield('main-content')
                </div>

            </div>

            <footer>
                <div class="container">
                    <div class="footer clearfix mb-0 text-muted">
                        <div class="float-start">
                            <p>{{date('Y')}} &copy; MagicBox</p>
                        </div>
                        <div class="float-end">
                            <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a href="#">H. Yawovi</a></p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>


    @yield('page-modals')

    <script src="{{asset('theme/js/app.js')}}"></script>
    <script src="{{asset('theme/js/pages/dashboard.js')}}"></script>

    <script src="{{asset('theme/js/pages/horizontal-layout.js')}}"></script>
    <script src="{{asset('theme/js/extensions/form-element-select.js')}}"></script>

    <script src="{{asset('js/vendor/jquery.min.js')}}"></script>



    <script src="{{asset('plugins/DataTables/datatables.js')}}"></script>

    <!-- <script src="{{asset('theme/js/extensions/filepond.js')}}"></script> -->
    <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
    <script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>

    <!-- Markdown-it - modern pluggable markdown parser. -->
    <!-- <script src="  https://unpkg.com/showdown/dist/showdown.min.js"></script> -->


    <script src="{{asset('js/vendor/prettyTextDiff/diff_match_patch.js')}}"></script>
    <script src="{{asset('js/vendor/prettyTextDiff/jquery.pretty-text-diff.js')}}"></script>
    <!-- <script src="{{asset('theme/js/extensions/form-element-select.js')}}"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>




    @yield('page-js')

    <script src="{{asset('js/helpers.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>


</body>

</html>