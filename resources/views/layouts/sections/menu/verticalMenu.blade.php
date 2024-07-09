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
        <li class="menu-item {{ request()->is('users*') ? 'active' : '' }}">
            <a href="{{ route('backend.users.index') }}" class="menu-link ">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div>Pengguna</div>
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
