@extends('layouts/layoutMaster')
@section('title', 'Detail Dosen')

@push('styles')
@vite([])
@endpush

@section('content')
{{-- Is Allowed User To List Dosen --}}
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">List Dosen /</span> Akun Dosen
</h4>
<div class="row">
    <!-- User Card Details -->
    @livewire('backend.lecture.card-details', ['lecture' => $lecture])
    <!--/ User Card Details -->

    {{-- TODO: --}}
</div>
@push('scripts')
@vite([])
@endpush
</div>
@endsection
