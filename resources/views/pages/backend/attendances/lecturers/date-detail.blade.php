@extends('layouts/layoutMaster')
@section('title', 'Detail Presensi Dosen')

@push('styles')
@vite([])
@endpush

@section('content')
{{-- Is Allowed User To List Dosen --}}
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Presensi Dosen Pertanngal /</span> Detail Presensi
</h4>
<div class="row">
    <!-- User Card Details -->
    @livewire('backend.attendance.lecture.card-details', ['attendance' => $attendance])
    <!--/ User Card Details -->
</div>
@push('scripts')
@vite(['resources/assets/js/backend/lightbox.js'])
@endpush
</div>
@endsection
