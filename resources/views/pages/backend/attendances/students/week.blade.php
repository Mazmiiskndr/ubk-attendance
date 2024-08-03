@extends('layouts/layoutMaster')
@section('title', 'Presensi Mahasiswa Perminggu')

@push('styles')
@vite(['resources/assets/css/datatables.min.css','resources/assets/vendor/libs/flatpickr/flatpickr.scss'])
@endpush

@section('content')
{{-- Is Allowed User To List Presensi Mahasiswa --}}
<h4 class="py-3">
    <span class="text-muted fw-light">Presensi / Mahasiswa /</span> Perminggu
</h4>
<!-- DataTable with Buttons -->
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between flex-column flex-sm-row">
            <div class="mb-1 mb-sm-0 text-center text-sm-start">
                <h4 class="card-title">Tabel Presensi Mahasiswa Perminggu</h4>
            </div>
            @livewire('backend.attendance.student.search-by-week')
            @livewire('backend.attendance.student.show-by-week')
        </div>
    </div>

    {{-- Start List DataTable --}}
    <div class="card-body">
        @livewire('backend.attendance.student.week-datatables')
    </div>
    {{-- End List DataTable --}}

    @push('scripts')
    @vite([
    'resources/assets/js/datatables.min.js',
    'resources/assets/js/student-by-week-management.js',
    'resources/assets/vendor/libs/flatpickr/flatpickr.js'
    ])
    @endpush
</div>

@endsection
