@extends('layouts/layoutMaster')
@section('title', 'Detail Mahasiswa')

@push('styles')
@vite(['resources/assets/js/datatable/datatables.min.css'])
@endpush

@section('content')
{{-- Is Allowed User To List Mahasiswa --}}
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">List Mahasiswa /</span> Akun Mahasiswa
</h4>
<div class="row">
    <!-- User Card Details -->
    <div class="col-lg-4 col-12">
        @livewire('backend.student.card-details', ['student' => $student])
    </div>
    <!--/ User Card Details -->

    <!-- Attendance Datatable Details -->
    <div class="col-lg-8 col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between flex-column flex-sm-row">
                    <div class="mb-1 mb-sm-0 text-center text-sm-start">
                        <h4 class="card-title">Tabel Presensi Mahasiswa Pertanggal</h4>
                    </div>
                    @livewire('backend.attendance.student.show-by-date')
                </div>
            </div>
            <div class="card-body">
                @livewire('backend.student.attendance-detail-datatables', ['student' => $student])
            </div>
        </div>
    </div>
    <!--/ Attendance Datatable Details -->
</div>
@push('scripts')
@vite([
'resources/assets/js/datatable/datatables.min.js',
'resources/assets/js/backend/users/attendance-student-details-management.js'
])
<script>
    function showAttendance(attendanceId) {
        Livewire.dispatch('requestStudentDateById', {
            attendanceId: attendanceId
        });
    }

</script>
@endpush
{{-- START FORM EDIT ATTENDANCE BY DATE --}}
@livewire('backend.attendance.student.edit-date')
{{-- END FORM EDIT ATTENDANCE BY DATE --}}
</div>
@endsection
