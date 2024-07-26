@extends('layouts/layoutMaster')
@section('title', 'Presensi Mahasiswa Pertanggal')

@push('styles')
@vite(['resources/assets/js/datatable/datatables.min.css','resources/assets/vendor/libs/flatpickr/flatpickr.scss'])
@endpush

@section('content')
{{-- Is Allowed User To List Presensi Mahasiswa --}}
<h4 class="py-3">
    <span class="text-muted fw-light">Presensi / Mahasiswa /</span> Pertanggal
</h4>
<!-- DataTable with Buttons -->
<div class="card">

    <div class="card-header">
        <div class="d-flex justify-content-between flex-column flex-sm-row">
            <div class="mb-1 mb-sm-0 text-center text-sm-start">
                <h4 class="card-title">Tabel Presensi Mahasiswa Pertanggal</h4>
            </div>
            @livewire('backend.attendance.student.search-by-date')
            @livewire('backend.attendance.student.show-by-date')
        </div>
    </div>

    {{-- Start List DataTable --}}
    <div class="card-body">
        @livewire('backend.attendance.student.date-datatables')
    </div>
    {{-- End List DataTable --}}

    @push('scripts')
    @vite([
    'resources/assets/js/datatable/datatables.min.js',
    'resources/assets/js/backend/attendances/student-by-date-management.js',
    'resources/assets/vendor/libs/flatpickr/flatpickr.js'
    ])
    <script>
        function showAttendance(attendanceId) {
            Livewire.dispatch('requestStudentDateById', {
                attendanceId: attendanceId
            });
        }

    </script>
    @endpush
</div>
{{-- START FORM EDIT ATTENDANCE BY DATE --}}
@livewire('backend.attendance.student.edit-date')
{{-- END FORM EDIT ATTENDANCE BY DATE --}}
@endsection
