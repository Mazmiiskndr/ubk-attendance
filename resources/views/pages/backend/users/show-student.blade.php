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
    @livewire('backend.student.card-details', ['student' => $student])
    <!--/ User Card Details -->

    {{-- TODO: --}}
</div>
@push('scripts')
@vite([
'resources/assets/js/datatable/datatables.min.js',
'resources/assets/js/backend/users/students-management.js'
])
{{-- <script>
    function confirmDeleteBatch() {
        // Ambil semua studentId yang dicentang
        let studentIds = Array.from(document.querySelectorAll('.students-checkbox:checked')).map(el => el.value);

        if (studentIds.length > 0) {
            showSwalDialog('Apakah Anda yakin?', 'Anda tidak akan bisa mengembalikan data ini!', () => {
                // Emit an event untuk menghapus siswa yang dicentang
                Livewire.dispatch('deleteBatch', {
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

{{-- START FORM CREATE MAHASISWA --}}
{{-- @livewire('backend.resumes.create') --}}
{{-- END FORM CREATE MAHASISWA --}}

{{-- START FORM EDIT MAHASISWA --}}
{{-- @livewire('backend.resumes.edit') --}}
{{-- END FORM EDIT MAHASISWA --}}

@endsection
