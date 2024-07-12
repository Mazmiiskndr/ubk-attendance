@php
$customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Halaman Login')

{{-- @section('vendor-style')
@vite(['resources/assets/vendor/libs/@form-validation/form-validation.scss'])
@endsection --}}

{{-- @section('vendor-script')
@vite(['resources/assets/vendor/libs/@form-validation/popular.js',
'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
'resources/assets/vendor/libs/@form-validation/auto-focus.js'])
@endsection
--}}
@section('page-style')
@vite(['resources/assets/vendor/scss/pages/page-auth.scss'])
@endsection

@section('page-script')
@vite(['resources/assets/js/pages-auth.js'])
@endsection

@section('content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
            <!-- Login -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mb-2">
                        <a href="{{url('/')}}" class="app-brand-link gap-2">
                            <img src="{{ asset('assets/images/logo/logo-ubk.png') }}" alt="" width="100">
                        </a>
                    </div>
                    <!-- /Logo -->
                    <h4 class="mb-3 text-center fw-bold">Welcome to {{config('variables.templateName')}}! 👋</h4>

                    {{-- START LOGIN FORM --}}
                    @livewire('auth.login.form')
                    {{-- END LOGIN FORM --}}

                </div>
            </div>
        </div>
        <!-- /Register -->
    </div>
</div>
</div>
@endsection
