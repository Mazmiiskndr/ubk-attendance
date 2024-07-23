@extends('layouts/layoutMaster')
@section('title', 'Presensi Mahasiswa Perbulan')

@push('styles')
@vite(['resources/assets/js/datatable/datatables.min.css'])
@endpush

@section('content')
{{-- Is Allowed User To List Presensi Mahasiswa --}}
<h4 class="py-3">
    <span class="text-muted fw-light">Presensi / Mahasiswa /</span> Perbulan
</h4>
<!-- DataTable with Buttons -->
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between flex-column flex-sm-row">
            <div class="mb-1 mb-sm-0 text-center text-sm-start">
                <h4 class="card-title">Tabel Presensi Mahasiswa Perbulan</h4>
            </div>
        </div>
    </div>

    {{-- Start List DataTable --}}
    <div class="card-body">
        {{-- @livewire('backend.course.datatables') --}}
    </div>
    {{-- End List DataTable --}}

    @push('scripts')
    @vite([
    'resources/assets/js/datatable/datatables.min.js'
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

@endsection