@extends('layouts/layoutMaster')
@section('title', 'Detail Dosen')

@push('styles')
@vite(['resources/assets/js/datatables.min.css'])
@endpush

@section('content')
{{-- Is Allowed User To List Dosen --}}
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">List Dosen /</span> Akun Dosen
</h4>
<div class="row">

    <!-- User Card Details -->
    <div class="col-lg-4 col-12">
        @livewire('backend.lecture.card-details', ['lecture' => $lecture])
    </div>
    <!--/ User Card Details -->

    <!-- Attendance Datatable Details -->
    <div class="col-lg-8 col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between flex-column flex-sm-row">
                    <div class="mb-1 mb-sm-0 text-center text-sm-start">
                        <h4 class="card-title">Tabel Presensi Dosen Pertanggal</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @livewire('backend.lecture.attendance-detail-datatables', ['lecture' => $lecture])
            </div>
        </div>
    </div>
    <!--/ Attendance Datatable Details -->
</div>
@push('scripts')
@vite([
'resources/assets/js/datatables.min.js',
'resources/assets/js/backend/users/attendance-lecture-details-management.js'
])
<script>
    function showAttendance(attendanceId) {
        Livewire.dispatch('requestLectureDateById', {
            attendanceId: attendanceId
        });
    }

</script>
@endpush
{{-- START FORM EDIT ATTENDANCE BY DATE --}}
@livewire('backend.attendance.lecture.edit-date')
{{-- END FORM EDIT ATTENDANCE BY DATE --}}
</div>
@endsection
