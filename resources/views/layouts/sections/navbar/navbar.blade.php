@php
$containerNav = ($configData['contentLayout'] === 'compact') ? 'container-xxl' : 'container-fluid';
$navbarDetached = ($navbarDetached ?? '');
@endphp

<!-- Navbar -->
@if(isset($navbarDetached) && $navbarDetached == 'navbar-detached')
<nav class="layout-navbar {{$containerNav}} navbar navbar-expand-xl {{$navbarDetached}} align-items-center bg-navbar-theme" id="layout-navbar">
    @endif
    @if(isset($navbarDetached) && $navbarDetached == '')
    <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
        <div class="{{$containerNav}}">
            @endif

            <!--  Brand demo (display only for navbar-full and hide on below xl) -->
            @if(isset($navbarFull))
            <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
                <a href="{{url('/')}}" class="app-brand-link gap-2">
                    <span class="app-brand-logo demo">
                        @include('_partials.macros',["height"=>20])
                    </span>
                    <span class="app-brand-text demo menu-text fw-bold">{{config('variables.templateName')}}</span>
                </a>
            </div>
            @endif

            <!-- ! Not required for layout-without-menu -->
            @if(!isset($navbarHideToggle))
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0{{ isset($menuHorizontal) ? ' d-xl-none ' : '' }} {{ isset($contentNavbar) ?' d-xl-none ' : '' }}">
                <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                    <i class="ti ti-menu-2 ti-sm"></i>
                </a>
            </div>
            @endif

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

                @if($configData['hasCustomizer'] == true)
                <!-- Style Switcher -->
                <div class="navbar-nav align-items-center">
                    <div class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                            <i class='ti ti-md'></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-start dropdown-styles">
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                                    <span class="align-middle"><i class='ti ti-sun me-2'></i>Light</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                                    <span class="align-middle"><i class="ti ti-moon me-2"></i>Dark</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                                    <span class="align-middle"><i class="ti ti-device-desktop me-2"></i>System</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--/ Style Switcher -->
                @endif

                <ul class="navbar-nav flex-row align-items-center ms-auto">

                    <!-- User -->
                    <li class="nav-item navbar-dropdown dropdown-user dropdown">
                        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                            <div class="avatar avatar-online">
                                <img src="{{ asset('assets/images/users/' . auth()->user()->images ?? "default" . '.png') }}" alt class="h-auto rounded-circle">
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar avatar-online">
                                                <img src="{{ asset('assets/images/users/' . auth()->user()->images ?? "default" . '.png') }}" alt class="h-auto rounded-circle">
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <span class="fw-medium d-block">
                                                @if (auth()->check())
                                                {{ auth()->user()->name }}
                                                @else
                                                -
                                                @endif
                                            </span>
                                            <small class="text-muted">{{ auth()->user()->role->name
                                                }}</small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ auth()->user()->id }}">
                                    <i class='ti ti-settings me-2'></i>
                                    <span class="align-middle">Profil Saya</span>
                                </a>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                            </li>
                            @if (auth()->check())
                            <li>
                                <a class="dropdown-item text-danger" href="javascript:void(0)" onclick="logoutButton();">
                                    <i class='ti ti-logout me-2'></i>
                                    <span class="align-middle">Keluar</span>
                                </a>
                            </li>
                            <form method="POST" id="logout-form" action="{{ route('logout') }}">
                                @csrf
                            </form>
                            @endif
                        </ul>
                    </li>
                    <!--/ User -->
                </ul>
            </div>

            @if(!isset($navbarDetached))
        </div>
        @endif
    </nav>
    <!-- / Navbar -->
    @push('scripts')
    <script>
        function logoutButton() {
            event.preventDefault();
            Swal.fire({
                title: 'Anda yakin ingin keluar?'
                , text: "Anda tidak akan dapat mengakses data lagi!!"
                , icon: 'warning'
                , showCancelButton: true
                , confirmButtonColor: '#7367f0'
                , cancelButtonColor: '#d33'
                , confirmButtonText: 'Ya, Keluar!'
                , cancelButtonText: 'Batal'
                , customClass: {
                    confirmButton: 'btn btn-primary me-1'
                    , cancelButton: 'btn btn-label-secondary'
                }
                , buttonsStyling: false
            , }).then((result) => {
                // Jika Result adalah True maka form akan di submit untuk logout
                if (result.isConfirmed) {
                    document.querySelector("#logout-form").submit();
                }
            });
        }

    </script>
    @endpush
