@extends('layouts/layoutMaster')

@section('title', 'Beranda')

@section('vendor-script')
@vite(['resources/assets/vendor/libs/chartjs/chartjs.js'])
@endsection

@section('page-script')
{{-- @vite(['resources/assets/js/charts-chartjs.js']) --}}

@endsection

@section('content')
<h4 class="fw-bold py-3 mb-1">Beranda</h4>
@livewire('backend.dashboard.cards')
<div class="row">
    @if(auth()->user()->role->name_alias == 'admin')
    <!-- Bar Charts -->
    @livewire('backend.dashboard.lecture-charts')
    <!-- /Bar Charts -->
    @endif

    <!-- Horizontal Bar Charts -->
    @livewire('backend.dashboard.student-charts')
    <!-- /Horizontal Bar Charts -->

</div>
@endsection
