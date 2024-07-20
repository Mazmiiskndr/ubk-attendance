@extends('layouts/layoutMaster')
@section('title', 'List Dosen')

@push('styles')
@vite(['resources/assets/js/datatable/datatables.min.css'])
@endpush

@section('content')
@livewire('backend.lecture.cards')

<!-- DataTable with Buttons -->
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between flex-column flex-sm-row">
            <div class="mb-1 mb-sm-0 text-center text-sm-start">
                <h4 class="card-title">Tabel Dosen</h4>
            </div>
            <div>
                <div class="d-flex justify-content-sm-end flex-column flex-sm-row gap-1">
                    {{-- Start Button for Create New Dosen --}}
                    <x-link-button color="primary btn-sm me-sm-1 mb-2 mb-sm-0" route="backend.lecturers.create" icon="tf-icons fas fa-plus-circle ti-xs me-1">
                        &nbsp; Tambah Data Dosen
                    </x-link-button>
                    {{-- End Button for Create New Dosen --}}

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

        @livewire('backend.lecture.datatables')
    </div>
    {{-- End List DataTable --}}

    @push('scripts')
    @vite([
    'resources/assets/js/datatable/datatables.min.js',
    'resources/assets/js/backend/users/lecturers-management.js'
    ])
    <script>
        function confirmDeleteBatch() {
            // Ambil semua lectureId yang dicentang
            let lectureIds = Array.from(document.querySelectorAll('.lecturers-checkbox:checked')).map(el => el.value);

            if (lectureIds.length > 0) {
                showSwalDialog('Apakah Anda yakin?', 'Anda tidak akan bisa mengembalikan data ini!', () => {
                    // Emit an event untuk menghapus siswa yang dicentang
                    Livewire.dispatch('deleteBatchLecturers', {
                        lectureIds: lectureIds
                    });
                });
            } else {
                Swal.fire({
                    icon: 'error'
                    , type: 'error'
                    , title: 'Oops...'
                    , text: 'Anda harus memilih setidaknya satu dosen untuk dihapus!'
                    , customClass: {
                        confirmButton: 'btn btn-primary'
                        , buttonsStyling: false
                    }
                });
            }
        }

        // Fungsi untuk menampilkan modal untuk MENGHAPUS!
        function confirmDeleteLecture(lectureId) {
            showSwalDialog('Apakah Anda yakin?', 'Anda tidak akan bisa mengembalikan data ini!', () => {
                Livewire.dispatch('confirmLecture', {
                    lectureId: lectureId
                });
            });
        }

        function showLecture(lectureId) {
            Livewire.dispatch('requestLectureById', {
                lectureId: lectureId
            });
        }

    </script>
    @endpush
</div>
@endsection
