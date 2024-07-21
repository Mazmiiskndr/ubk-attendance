@extends('layouts/layoutMaster')
@section('title', 'Edit Dosen')

@push('styles')
@vite(['resources/assets/vendor/libs/flatpickr/flatpickr.scss'])
@endpush

@section('content')
<h4 class="py-3 mb-2">
    <span class="text-muted fw-light">List Dosen /</span> Edit Dosen
</h4>

<div class="row">
    <div class="col-md-12">
        @livewire('backend.lecture.edit', ['lecture' => $lecture])
    </div>
</div>


@push('scripts')
@vite(['resources/assets/vendor/libs/flatpickr/flatpickr.js'])
@endpush
</div>

@endsection
