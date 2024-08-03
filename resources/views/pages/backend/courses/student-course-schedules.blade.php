@extends('layouts/layoutMaster')
@section('title', 'Jadwal Mata Kuliah Mahasiswa')

@push('styles')
@vite(['resources/assets/css/datatables.min.css'])
@endpush

@section('content')
{{-- Is Allowed User To Jadwal Mata Kuliah Mahasiswa --}}
<h4 class="fw-bold py-3 mb-1">List Jadwal Mata Kuliah</h4>
<!-- DataTable with Buttons -->
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between flex-column flex-sm-row">
            <div class="mb-1 mb-sm-0 text-center text-sm-start">
                <h4 class="card-title">Tabel Jadwal Mata Kuliah</h4>
            </div>

        </div>
    </div>

    {{-- Start List DataTable --}}
    <div class="card-body">
        @livewire('backend.course.student-course-schedule-datatables')
    </div>
    {{-- End List DataTable --}}

    @push('scripts')
    @vite([
    'resources/assets/js/datatables.min.js',
    'resources/assets/js/student-course-schedules-management.js'
    ])
    {{-- <script>
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

    </script> --}}
    @endpush
</div>

{{-- START FORM CREATE MATA KULIAH --}}
{{-- @livewire('backend.course.create-course') --}}
{{-- END FORM CREATE MATA KULIAH --}}

{{-- START FORM EDIT MATA KULIAH --}}
{{-- @livewire('backend.course.edit-course') --}}
{{-- END FORM EDIT MATA KULIAH --}}

@endsection
