@extends('layouts/layoutMaster')
@section('title', 'Detail Mata Kuliah')

@push('styles')
@vite(['resources/assets/css/datatables.min.css','resources/assets/vendor/libs/flatpickr/flatpickr.scss'])
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
            <div>
                <div class="d-flex justify-content-sm-end flex-column flex-sm-row gap-1">
                    {{-- Start Button for Create New Detail Mata Kuliah --}}
                    <x-button type="button" color="primary btn-sm me-sm-1 mb-2 mb-sm-0" data-bs-toggle="modal" data-bs-target="#createNewSchedule">
                        <i class="tf-icons fas fa-plus-circle ti-xs me-1"></i>&nbsp; Tambah Data Jadwal Mata Kuliah
                    </x-button>
                    {{-- End Button for Create New Detail Mata Kuliah --}}

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

        @livewire('backend.course.schedule-datatables', ['courseId' => $course->id])
    </div>
    {{-- End List DataTable --}}

    @push('scripts')
    <script src="{{ asset('assets/datatable/datatables.min.js') }}" defer></script>
    @vite([
    'resources/assets/js/course-schedules-management.js',
    'resources/assets/vendor/libs/flatpickr/flatpickr.js'
    ])
    <script>
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

    </script>
    @endpush
</div>

{{-- START FORM CREATE Jadwal MATA KULIAH --}}
@livewire('backend.course.create-schedule', ['course' => $course])
{{-- END FORM CREATE Jadwal MATA KULIAH --}}

{{-- START FORM EDIT MATA KULIAH --}}
@livewire('backend.course.edit-schedule')
{{-- END FORM EDIT MATA KULIAH --}}

@endsection
