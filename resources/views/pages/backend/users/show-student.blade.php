@extends('layouts/layoutMaster')
@section('title', 'Detail Mahasiswa')

@push('styles')
@vite([])
@endpush

@section('content')
{{-- Is Allowed User To List Mahasiswa --}}
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">List Mahasiswa /</span> Akun Mahasiswa
</h4>
<div class="row">
    <!-- User Card Details -->
    @livewire('backend.student.card-details', ['student' => $student])
    <!--/ User Card Details -->

    {{-- TODO: --}}
</div>
@push('scripts')
@vite([])
@endpush
</div>
@endsection
