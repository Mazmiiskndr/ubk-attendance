@extends('layouts/layoutMaster')
@section('title', 'List Mahasiswa')

@push('styles')
@vite(['resources/assets/vendor/libs/flatpickr/flatpickr.scss'])
@endpush

@section('content')
<h4 class="py-3 mb-2">
    <span class="text-muted fw-light">List Mahasiswa /</span> Edit Mahasiswa
</h4>

<div class="row">
    <div class="col-md-12">
        @livewire('backend.student.edit', ['student' => $student])
    </div>
</div>


@push('scripts')
@vite(['resources/assets/vendor/libs/flatpickr/flatpickr.js'])
@endpush
</div>

@endsection