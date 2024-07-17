@extends('layouts/layoutMaster')
@section('title', 'List Mata Kuliah')

@push('styles')
@vite(['resources/assets/js/datatable/datatables.min.css'])
@endpush

@section('content')
{{-- Is Allowed User To List Mata Kuliah --}}
<h4 class="fw-bold py-3 mb-1">List Mata Kuliah</h4>
<!-- DataTable with Buttons -->
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between flex-column flex-sm-row">
            <div class="mb-1 mb-sm-0 text-center text-sm-start">
                <h4 class="card-title">Tabel Mata Kuliah</h4>
            </div>
            <div>
                <div class="d-flex justify-content-sm-end flex-column flex-sm-row gap-1">
                    {{-- Start Button for Create New Mata Kuliah --}}
                    <x-button type="button" color="primary btn-sm me-sm-1 mb-2 mb-sm-0" data-bs-toggle="modal" data-bs-target="#createNewResume">
                        <i class="tf-icons fas fa-plus-circle ti-xs me-1"></i>&nbsp; Tambah Data Mata Kuliah
                    </x-button>
                    {{-- End Button for Create New Mata Kuliah --}}

                    {{-- Start Button for Delete Batch --}}
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

        @livewire('backend.course.datatables')
    </div>
    {{-- End List DataTable --}}

    @push('scripts')
    @vite([
    'resources/assets/js/datatable/datatables.min.js',
    'resources/assets/js/backend/courses/courses-management.js'
    ])
    <script>
        function confirmDeleteBatch() {
            // Ambil semua courseId yang dicentang
            let courseIds = Array.from(document.querySelectorAll('.courses-checkbox:checked')).map(el => el.value);

            if (courseIds.length > 0) {
                showSwalDialog('Apakah Anda yakin?', 'Anda tidak akan bisa mengembalikan data ini!', () => {
                    // Emit an event untuk menghapus siswa yang dicentang
                    Livewire.dispatch('deleteBatchCourses', {
                        courseIds: courseIds
                    });
                });
            } else {
                Swal.fire({
                    icon: 'error'
                    , type: 'error'
                    , title: 'Oops...'
                    , text: 'Anda harus memilih setidaknya satu mata kuliah untuk dihapus!'
                    , customClass: {
                        confirmButton: 'btn btn-primary'
                        , buttonsStyling: false
                    }
                });
            }
        }

        // Fungsi untuk menampilkan modal untuk MENGHAPUS!
        function confirmDeleteCourse(courseId) {
            showSwalDialog('Apakah Anda yakin?', 'Anda tidak akan bisa mengembalikan data ini!', () => {
                Livewire.dispatch('confirmCourse', {
                    courseId: courseId
                });
            });
        }

        function showCourse(courseId) {
            Livewire.dispatch('requestCourseById', {
                courseId: courseId
            });
        }

    </script>
    @endpush
</div>

{{-- START FORM CREATE MATA KULIAH --}}
{{-- @livewire('backend.resumes.create') --}}
{{-- END FORM CREATE MATA KULIAH --}}

{{-- START FORM EDIT MATA KULIAH --}}
{{-- @livewire('backend.resumes.edit') --}}
{{-- END FORM EDIT MATA KULIAH --}}

@endsection
