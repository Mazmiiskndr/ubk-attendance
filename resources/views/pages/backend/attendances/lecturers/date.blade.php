@extends('layouts/layoutMaster')
@section('title', 'Presensi Dosen Pertanggal')

@push('styles')
@vite(['resources/assets/css/datatables.min.css'])
@endpush

@section('content')
{{-- Is Allowed User To List Presensi Dosen --}}
<h4 class="py-3">
    <span class="text-muted fw-light">Presensi / Dosen /</span> Pertanggal
</h4>
<!-- DataTable with Buttons -->
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between flex-column flex-sm-row">
            <div class="mb-1 mb-sm-0 text-center text-sm-start">
                <h4 class="card-title">Tabel Presensi Dosen Pertanggal</h4>
            </div>
            <div>
                <h5 class="card-title">Menampilkan Tanggal : {{ date("Y/m/d") }}</h5>
            </div>
        </div>
    </div>

    {{-- Start List DataTable --}}
    <div class="card-body">
        @livewire('backend.attendance.lecture.date-datatables')
    </div>
    {{-- End List DataTable --}}

    @push('scripts')
    <script src="{{ asset('assets/datatable/datatables.min.js') }}" defer></script>
    @vite([
    'resources/assets/js/lecture-by-date-management.js'
    ])
    <script>
        function showAttendance(attendanceId) {
            Livewire.dispatch('requestLectureDateById', {
                attendanceId: attendanceId
            });
        }

    </script>
    @endpush
</div>
{{-- START FORM EDIT ATTENDANCE BY DATE --}}
@livewire('backend.attendance.lecture.edit-date')
{{-- END FORM EDIT ATTENDANCE BY DATE --}}
@endsection
