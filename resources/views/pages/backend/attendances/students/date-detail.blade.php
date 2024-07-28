@extends('layouts/layoutMaster')
@section('title', 'Detail Presensi Mahasiswa')

@push('styles')
@vite([])
@endpush

@section('content')
{{-- Is Allowed User To List Dosen --}}
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Presensi Mahasiswa Pertanngal /</span> Detail Presensi
</h4>
<div class="row">
    <!-- User Card Details -->
    @livewire('backend.attendance.student.card-details', ['attendance' => $attendance])
    <!--/ User Card Details -->
</div>
@push('scripts')
@vite(['resources/assets/js/backend/lightbox.js'])
@endpush
</div>
@endsection
