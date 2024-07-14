@extends('layouts/layoutMaster')
@section('title', 'List Mahasiswa')

@push('styles')
@vite(['resources/assets/js/datatable/datatables.min.css'])
@endpush

@section('content')
{{-- Is Allowed User To List Mahasiswa --}}
@livewire('backend.student.cards')

<!-- DataTable with Buttons -->
<div class="card">
    <div class="card-header ">
        <div class="d-flex justify-content-between flex-column flex-sm-row">
            <div class="mb-1 mb-sm-0 text-center text-sm-start">
                <h4 class="card-title">Tabel Mahasiswa</h4>
            </div>
            <div>
                <div class="d-flex justify-content-sm-end flex-column flex-sm-row gap-1">
                    {{-- Start Button for Create New Mahasiswa --}}
                    <x-link-button color="primary btn-sm me-sm-1 mb-2 mb-sm-0" route="backend.students.create" icon="tf-icons fas fa-plus-circle ti-xs me-1">
                        &nbsp; Tambah Data Mahasiswa
                    </x-link-button>
                    {{-- End Button for Create New Mahasiswa --}}

                    {{-- Start Button for Delete Batch --}}
                    {{-- TODO: DELETE BATCH --}}
                    <x-button type="button" color="label-danger btn-sm" onclick="confirmDeleteBatch()">
                        <i class="tf-icons fas fa-trash-alt ti-xs me-1"></i>&nbsp; Hapus Massal
                    </x-button>
                    {{-- End Button for Delete Batch --}}
                </div>
            </div>
        </div>
    </div>

    {{-- Start List DataTable --}}
    <div class="card-body">
        @livewire('backend.student.datatables')
    </div>
    {{-- End List DataTable --}}

    @push('scripts')
    @vite([
    'resources/assets/js/datatable/datatables.min.js',
    'resources/assets/js/backend/users/students-management.js'
    ])
    <script>
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

    </script>
    @endpush
</div>

{{-- START FORM CREATE MAHASISWA --}}
{{-- @livewire('backend.resumes.create') --}}
{{-- END FORM CREATE MAHASISWA --}}

{{-- START FORM EDIT MAHASISWA --}}
{{-- @livewire('backend.resumes.edit') --}}
{{-- END FORM EDIT MAHASISWA --}}

@endsection
