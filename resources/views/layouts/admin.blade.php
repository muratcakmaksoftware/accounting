<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- GLOBAL CSS -->
    <link rel="stylesheet" href="{{ asset('resources/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/fontawesome/css/font-awesome-4-7.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/datepicker/css/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/custom/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/admin-lte/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/sweetalert2/css/sweetalert2.min.css') }}">

    <!-- GLOBAL JS -->
    <script src="{{ asset('resources/jquery/js/jquery.min.js') }}"></script>
    <script src="{{ asset('resources/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('resources/admin-lte/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('resources/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('resources/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('resources/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('resources/moment/js/moment.min.js') }}"></script>
    <script src="{{ asset('resources/moment/js/locales.min.js') }}"></script>
    <script src="{{ asset('resources/inputmask/js/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('resources/datepicker/js/daterangepicker.js') }}"></script>
    <script src="{{ asset('resources/sweetalert2/js/sweetalert2.min.js') }}"></script>
    @yield('css')
    @yield('javascript-head')

    {{-- @vite(['resources/css/fonts.css', 'resources/css/app.css', 'resources/css/main.css']) --}}
    {{-- @vite(['resources/js/app.js']) --}}
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <!--ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="index3.html" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contact</a>
            </li>
        </ul-->

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
            <!--li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                    <form class="form-inline">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li-->

            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="" class="brand-link">
            <img src="{{ asset('images/logo.png') }}" alt="logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">Nute</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('images/profile.png') }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ auth()->user()->name ?? 'İsim Bulunamadı' }}</a>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                           aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Ana Sayfa
                            </p>
                        </a>
                    </li>

                    <li class="nav-header">ÖDEMELERİM</li>
                    <li class="nav-item">
                        <a href="{{ route('payables.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-credit-card"></i>
                            <p>
                                Ödemelerim
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('payables.create') }}" class="nav-link">
                            <i class="nav-icon fas fa-plus"></i>
                            <p>
                                Ödeme Ekle
                            </p>
                        </a>
                    </li>

                    <li class="nav-header">ALACAKLARIM</li>
                    <li class="nav-item">
                        <a href="{{ route('receivables.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-cash-register"></i>
                            <p>
                                Alacaklarım
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('receivables.create') }}" class="nav-link">
                            <i class="nav-icon fas fa-plus"></i>
                            <p>
                                Alacak Ekle
                            </p>
                        </a>
                    </li>

                    <hr class="nav-hr"/>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-university"></i>
                            <p>
                                Banka
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>
                                Ayarlar
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="fas fa-building nav-icon"></i>
                                    <p>Şirketler</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="fas fa-money nav-icon"></i>
                                    <p>Para Birimleri</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="fa fa-google-wallet nav-icon"></i>
                                    <p>Ödeme Metotları</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>
                                Çıkış Yap
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@yield('title')</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @yield('breadcrumb')
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- Default to the left -->
        <strong>Copyright &copy; 2021-{{ date('Y') }} Murat Çakmak</strong> All rights reserved.
    </footer>
</div>
@yield('javascript-footer')
<script src="{{ asset('resources/custom/js/main.js') }}"></script>
{{-- @vite(['resources/js/main.js']) --}}
</body>
</html>
