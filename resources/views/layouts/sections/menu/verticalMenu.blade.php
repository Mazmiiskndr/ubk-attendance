@php
$configData = Helper::appClasses();
@endphp

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

    <!-- ! Hide app brand if navbar-full -->
    @if(!isset($navbarFull))
    <div class="app-brand demo">
        <a href="{{url('/')}}" class="app-brand-link">
            <img class="img-fluid" src="{{ asset('assets/images/logo/logo-ubk.png') }}" width="50" alt="">
            {{-- @include('_partials.macros',["height"=>20]) --}}
            <span class="app-brand-text demo menu-text fw-bold">{{config('variables.templateName')}}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>
    @endif


    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

        @if (auth()->user()->role->name_alias == 'admin')

        <!-- Dashboard Menu  -->
        <li class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">
            <a href="{{ route('backend.dashboard') }}" class="menu-link ">
                <i class="menu-icon tf-icons ti ti-home"></i>
                <div>Beranda</div>
            </a>
        </li>

        <!-- Dashboard Menu  -->
        <!-- User Menu Item -->
        <li class="menu-item {{ request()->is('users*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div>Pengguna</div>
            </a>

            <!-- Submenu for User -->
            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('users/students*') || request()->is('users/student/*') ? 'active' : '' }}">
                    <a href="{{ route('backend.students.index') }}" class="menu-link ml-4">
                        <div>List Mahasiswa</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('users/lecturers') ? 'active' : '' }}">
                    <a href="{{ route('backend.lecturers.index') }}" class="menu-link ml-4">
                        <div>List Dosen</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Settings Menu  -->
        <li class="menu-item {{ request()->is('courses*') ? 'active' : '' }}">
            <a href="{{ route('backend.settings.index') }}" class="menu-link ">
                <i class="menu-icon tf-icons ti ti-books"></i>
                <div>Mata Kuliah</div>
            </a>
        </li>
        <!-- Settings Menu  -->
        <li class="menu-item {{ request()->is('settings*') ? 'active' : '' }}">
            <a href="{{ route('backend.settings.index') }}" class="menu-link ">
                <i class="menu-icon tf-icons ti ti-settings"></i>
                <div>Pengaturan</div>
            </a>
        </li>

        @else

        @endif

    </ul>

</aside>
