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

        <!-- Courses Menu  -->
        <li class="menu-item {{ request()->is('courses*') || request()->is('course*') ? 'active' : '' }}">
            <a href="{{ route('backend.courses.index') }}" class="menu-link ">
                <i class="menu-icon tf-icons ti ti-books"></i>
                <div>Mata Kuliah</div>
            </a>
        </li>

        <!-- Attendances Item -->
        <li class="menu-item {{ request()->is('attendances*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-fingerprint"></i>
                <div>Presensi</div>
            </a>

            <!-- Submenu for User -->
            <ul class="menu-sub">
                <!-- Submenu for Students -->
                <li class="menu-item {{ request()->is('attendances/students*') || request()->is('attendances/student/*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle ml-4">
                        <div>Mahasiswa</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ request()->is('attendances/students/date*') ? 'active' : '' }}" style="margin-right: 20px;">
                            <a href="#" class="menu-link ml-4" style="position: relative; left: 1rem;">
                                <div>Pertanggal</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('attendances/students/month*') ? 'active' : '' }}" style="margin-right: 20px;">
                            <a href="#" class="menu-link ml-4" style="position: relative; left: 1rem;">
                                <div>Perbulan</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Submenu for Lecturers -->
                <li class="menu-item {{ request()->is('attendances/lecturers*') || request()->is('attendances/lecture/*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle ml-4">
                        <div>Dosen</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ request()->is('attendances/lecturers/date*') ? 'active' : '' }}" style="margin-right: 20px;">
                            <a href="#" class="menu-link ml-4" style="position: relative; left: 1rem;">
                                <div>Pertanggal</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('attendances/lecturers/month*') ? 'active' : '' }}" style="margin-right: 20px;">
                            <a href="#" class="menu-link ml-4" style="position: relative; left: 1rem;">
                                <div>Perbulan</div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>


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
                <li class="menu-item {{ request()->is('users/lecturers*') || request()->is('users/lecture/*') ? 'active' : '' }}">
                    <a href="{{ route('backend.lecturers.index') }}" class="menu-link ml-4">
                        <div>List Dosen</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Settings Menu  -->
        <li class="menu-item {{ request()->is('settings*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-settings"></i>
                <div>Pengaturan</div>
            </a>

            <!-- Submenu for User -->
            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('settings') ? 'active' : '' }}">
                    <a href="{{ route('backend.settings.index') }}" class="menu-link ml-4">
                        <div>Server</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('settings/kelas') ? 'active' : '' }}">
                    <a href="{{ route('backend.kelas.index') }}" class="menu-link ml-4">
                        <div>Kelas</div>
                    </a>
                </li>
            </ul>
        </li>

        @else

        @endif

    </ul>

</aside>
