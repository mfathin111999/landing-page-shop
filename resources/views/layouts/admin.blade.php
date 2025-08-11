<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @yield('page-meta')

        <!-- Fonts -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.22.2/dist/sweetalert2.min.css " rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @yield('page-css')

    </head>

    <body class="d-flex flex-column bg-light small" style="min-height: 100vh;">

        @include('layouts.preloader')

        <div class="d-flex">
            <nav class="sidebar d-flex flex-column flex-shrink-0 position-fixed collapsed">
                <button class="toggle-btn" onclick="toggleSidebar()">
                    <i class="fas fa-chevron-left"></i>
                </button>

                <div class="p-4">
                    <h4 class="logo-text fw-bold mb-0">My Assist</h4>
                    <p class="text-white small hide-on-collapse">Dashboard</p>
                </div>

                <div class="nav flex-column">
                    <a class="sidebar-link text-decoration-none p-3 {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="fas fa-home me-3"></i>
                        <span class="hide-on-collapse">Dashboard</span>
                    </a>
                    <a class="sidebar-link text-decoration-none p-3 {{ request()->routeIs('order.*') ? 'active' : '' }}" href="{{ route('order.upload') }}">
                        <i class="fas fa-chart-bar me-3"></i>
                        <span class="hide-on-collapse">Order</span>
                    </a>
                    <a class="sidebar-link text-decoration-none p-3 {{ request()->routeIs('income.*') ? 'active' : '' }}" href="{{ route('income.upload') }}">
                        <i class="fas fa-users me-3"></i>
                        <span class="hide-on-collapse">Income</span>
                    </a>
                    <a class="sidebar-link text-decoration-none p-3 {{ request()->routeIs('product.*') ? 'active' : '' }}" href="{{ route('product.index') }}">
                        <i class="fas fa-box me-3"></i>
                        <span class="hide-on-collapse">Product</span>
                    </a>
                    <a class="sidebar-link text-decoration-none p-3 {{ request()->routeIs('store.*') ? 'active' : '' }}" href="{{ route('store.index') }}">
                        <i class="fas fa-store me-3"></i>
                        <span class="hide-on-collapse">Store</span>
                    </a>
                    <a class="sidebar-link text-decoration-none p-3 {{ request()->routeIs('user.*') ? 'active' : '' }}" href="{{ route('user.index') }}">
                        <i class="fas fa-gear me-3"></i>
                        <span class="hide-on-collapse">Settings</span>
                    </a>
                </div>

                <div class="profile-section mt-auto p-4">
                    <div class="d-flex align-items-center">
                        <div class="initial-letter">{{ substr(auth()->user()->name, 0, 1) }}</div>
                        <div class="ms-3 profile-info">
                            <h6 class="text-white mb-0">{{ auth()->user()->name }}</h6>
                            <small class="text-white">{{ __('trans.' . auth()->user()->getRoleNames()->first()) }}</small>
                        </div>
                    </div>
                </div>
            </nav>

            <main class="main-content" onclick="closeSidebar()">
                <div class="container-fluid">
                    <h3 class="bg-dark text-white p-3 rounded w-100">
                        @yield('page-title', 'Dashboard')
                    </h3>

                    <div class="mb-5" id="app">

                        <div class="small">
                            @yield('page-content')
                        </div>
                    </div>

                </div>
            </main>
        </div>

        <div class="bg-warning py-2 mt-auto">
            <p class="text-center">
                Copyright ©︎2018-{{ date('Y') }} カークリニックアキヤマ All Rights Reserved
            </p>
        </div>

        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

        <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.22.2/dist/sweetalert2.all.min.js "></script>

        @yield('page-js')

        <script>
            function toggleSidebar() {
                const sidebar = document.querySelector('.sidebar');
                sidebar.classList.toggle('collapsed');
            }

            function closeSidebar() {
                const sidebar = document.querySelector('.sidebar');
                sidebar.classList.add('collapsed');
            }

            window.addEventListener('load', function() {
                let loader = document.querySelector('.loader-wrapper');

                if (loader) {
                    loader.style.display = 'none';
                }
            });
        </script>

    </body>

</html>
