@extends('layouts/layoutMaster')
@section('title', 'Detail Mata Kuliah Mahasiswa')

@push('styles')
@vite(['resources/assets/css/datatables.min.css'])
@endpush

@section('content')
{{-- Is Allowed User To Detail Mata Kuliah --}}
<h4 class="fw-bold py-3 mb-1">Jadwal Mata Kuliah</h4>
<!-- DataTable with Buttons -->
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between flex-column flex-sm-row">
            <div class="mb-1 mb-sm-0 text-center text-sm-start">
                <h5 class="card-title">Mata Kuliah & Ruangan : {{ $course->name ."/". $course->kelas->room }}</h5>
            </div>
        </div>
    </div>

    {{-- Start List DataTable --}}
    <div class="card-body">
        @livewire('backend.course.show-student-course-schedule-datatables', ['courseId' => $course->id])
    </div>
    {{-- End List DataTable --}}

    @push('scripts')
    <script src="{{ asset('assets/datatable/datatables.min.js') }}" defer></script>
    @vite([
    'resources/assets/js/show-student-course-schedules-management.js',
    ])
    {{-- <script>
        function confirmDeleteBatch() {
            // Ambil semua v yang dicentang
            let courseScheduleIds = Array.from(document.querySelectorAll('.course-schedules-checkbox:checked')).map(el => el.value);

            if (courseScheduleIds.length > 0) {
                showSwalDialog('Apakah Anda yakin?', 'Anda tidak akan bisa mengembalikan data ini!', () => {
                    // Emit an event untuk menghapus siswa yang dicentang
                    Livewire.dispatch('deleteBatchCourseSchedules', {
                        courseScheduleIds: courseScheduleIds
                    });
                });
            } else {
                Swal.fire({
                    icon: 'error'
                    , type: 'error'
                    , title: 'Oops...'
                    , text: 'Anda harus memilih setidaknya satu jadwal mata kuliah untuk dihapus!'
                    , customClass: {
                        confirmButton: 'btn btn-primary'
                        , buttonsStyling: false
                    }
                });
            }
        }

        // Fungsi untuk menampilkan modal untuk MENGHAPUS!
        function confirmDeleteCourse(courseScheduleId) {
            showSwalDialog('Apakah Anda yakin?', 'Anda tidak akan bisa mengembalikan data ini!', () => {
                Livewire.dispatch('confirmCourseSchedule', {
                    courseScheduleId: courseScheduleId
                });
            });
        }

        function showCourse(courseScheduleId) {
            Livewire.dispatch('requestCourseScheduleById', {
                courseScheduleId: courseScheduleId
            });
        }

    </script> --}}
    @endpush
</div>


@endsection
