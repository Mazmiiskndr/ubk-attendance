<!DOCTYPE html>
@php
$menuFixed = ($configData['layout'] === 'vertical') ? ($menuFixed ?? '') : (($configData['layout'] === 'front') ? '' :
$configData['headerType']);
$navbarType = ($configData['layout'] === 'vertical') ? ($configData['navbarType'] ?? '') : (($configData['layout'] ===
'front') ? 'layout-navbar-fixed': '');
$isFront = ($isFront ?? '') == true ? 'Front' : '';
$contentLayout = (isset($container) ? (($container === 'container-xxl') ? "layout-compact" : "layout-wide") : "");
@endphp

<html lang="{{ session()->get('locale') ?? app()->getLocale() }}" class="{{ $configData['style'] }}-style {{($contentLayout ?? '')}} {{ ($navbarType ?? '') }} {{ ($menuFixed ?? '') }} {{ $menuCollapsed ?? '' }} {{ $menuFlipped ?? '' }} {{ $menuOffcanvas ?? '' }} {{ $footerFixed ?? '' }} {{ $customizerHidden ?? '' }}" dir="{{ $configData['textDirection'] }}" data-theme="{{ $configData['theme'] }}" data-assets-path="{{ asset('/assets') . '/' }}" data-base-url="{{url('/')}}" data-framework="laravel" data-template="{{ $configData['layout'] . '-menu-' . $configData['themeOpt'] . '-' . $configData['styleOpt'] }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title') -
        {{ config('variables.templateName') ? config('variables.templateName') : 'TemplateName' }}
    </title>
    <meta name="description" content="{{ config('variables.templateDescription') ? config('variables.templateDescription') : '' }}" />
    <meta name="keywords" content="{{ config('variables.templateKeyword') ? config('variables.templateKeyword') : '' }}">
    <!-- laravel CRUD token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Canonical SEO -->
    <link rel="canonical" href="{{ config('variables.productPage') ? config('variables.productPage') : '' }}">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/logo/logo-ubk.png') }}" />

    {{-- Livewire --}}
    @livewireStyles
    {{-- End Livewire --}}

    <!-- Include Styles -->
    <!-- $isFront is used to append the front layout styles only on the front layout otherwise the variable will be blank -->
    @include('layouts/sections/styles')
    @stack('styles')

    <!-- Include Scripts for customizer, helper, analytics, config -->
    <!-- $isFront is used to append the front layout scriptsIncludes only on the front layout otherwise the variable will be blank -->
    @include('layouts/sections/scriptsIncludes')
</head>

<body>

    <!-- Layout Content -->
    @yield('layoutContent')
    <!--/ Layout Content -->

    <!-- Include Scripts -->
    <!-- $isFront is used to append the front layout scripts only on the front layout otherwise the variable will be blank -->
    {{-- Livewire --}}
    @livewireScripts
    {{-- End Livewire --}}
    @include('layouts/sections/scripts')
    @stack('scripts')
    {{-- Check if the authentication is already exist! --}}
    @if (session()->has('auth'))
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            if ("{{ session('auth') }}") {
                Swal.fire({
                    icon: 'error'
                    , title: 'Oops...'
                    , text: "{{ session('auth') }}"
                    , type: 'error'
                    , customClass: {
                        confirmButton: 'btn btn-primary'
                    }
                    , buttonsStyling: false
                });
            }
        });

    </script>
    @endif
    @if (session()->has('logout'))
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            if ("{{ session('logout') }}") {
                Swal.fire({
                    position: 'center'
                    , icon: 'success'
                    , title: "{{ session('logout') }}"
                    , showConfirmButton: false
                    , timer: 2500
                });
            }
        });

    </script>

    @endif
</body>

</html>
