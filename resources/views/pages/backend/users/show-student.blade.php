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
    <div class="col-lg-4 col-12">
        <!-- User Card Details -->
        @livewire('backend.student.card-details', ['student' => $student])
        <!--/ User Card Details -->
    </div>

    <div class="col-lg-8 col-12">

        <!-- Attendance Datatable Details -->
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
        <!--/ Attendance Datatable Details -->
    </div>
</div>
@push('scripts')
@vite([
'resources/assets/js/datatable/datatables.min.js',
'resources/assets/js/backend/users/attendance-student-details-management.js'
])
{{-- TODO: --}}
{{-- <script>
    function confirmDeleteBatch() {
        // Ambil semua studentId yang dicentang
        let studentIds = Array.from(document.querySelectorAll('.students-checkbox:checked')).map(el => el.value);

        if (studentIds.length > 0) {
            showSwalDialog('Apakah Anda yakin?', 'Anda tidak akan bisa mengembalikan data ini!', () => {
                // Emit an event untuk menghapus siswa yang dicentang
                Livewire.dispatch('deleteBatchStudents', {
                    studentIds: studentIds
                });
            });
        } else {
            Swal.fire({
                icon: 'error'
                , type: 'error'
                , title: 'Oops...'
                , text: 'Anda harus memilih setidaknya satu mahasiswa untuk dihapus!'
                , customClass: {
                    confirmButton: 'btn btn-primary'
                    , buttonsStyling: false
                }
            });
        }
    }

    // Fungsi untuk menampilkan modal untuk MENGHAPUS!
    function confirmDeleteStudent(studentId) {
        showSwalDialog('Apakah Anda yakin?', 'Anda tidak akan bisa mengembalikan data ini!', () => {
            Livewire.dispatch('confirmStudent', {
                studentId: studentId
            });
        });
    }

    function showStudent(studentId) {
        Livewire.dispatch('requestStudentById', {
            studentId: studentId
        });
    }

</script> --}}
@endpush
</div>
@endsection
