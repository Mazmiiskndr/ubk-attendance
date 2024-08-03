@extends('layouts/layoutMaster')
@section('title', 'List Kelas')

@push('styles')
@vite(['resources/assets/css/datatables.min.css'])
@endpush

@section('content')
{{-- Is Allowed User To List Kelas --}}
<h4 class="fw-bold py-3 mb-1">List Kelas</h4>
<!-- DataTable with Buttons -->
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between flex-column flex-sm-row">
            <div class="mb-1 mb-sm-0 text-center text-sm-start">
                <h4 class="card-title">Tabel Kelas</h4>
            </div>
            <div>
                <div class="d-flex justify-content-sm-end flex-column flex-sm-row gap-1">
                    {{-- Start Button for Create New Kelas --}}
                    <x-button type="button" color="primary btn-sm me-sm-1 mb-2 mb-sm-0" data-bs-toggle="modal" data-bs-target="#createNewKelas">
                        <i class="tf-icons fas fa-plus-circle ti-xs me-1"></i>&nbsp; Tambah Data Kelas
                    </x-button>
                    {{-- End Button for Create New Kelas --}}

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

        @livewire('backend.setting.kelas-datatables')

    </div>
    {{-- End List DataTable --}}

    @push('scripts')
    @vite([
    'resources/assets/js/datatables.min.js',
    'resources/assets/js/kelas-management.js'
    ])
    <script>
        function confirmDeleteBatch() {
            // Ambil semua kelasId yang dicentang
            let kelasIds = Array.from(document.querySelectorAll('.kelas-checkbox:checked')).map(el => el.value);

            if (kelasIds.length > 0) {
                showSwalDialog('Apakah Anda yakin?', 'Anda tidak akan bisa mengembalikan data ini!', () => {
                    // Emit an event untuk menghapus siswa yang dicentang
                    Livewire.dispatch('deleteBatchKelas', {
                        kelasIds: kelasIds
                    });
                });
            } else {
                Swal.fire({
                    icon: 'error'
                    , type: 'error'
                    , title: 'Oops...'
                    , text: 'Anda harus memilih setidaknya satu kelas untuk dihapus!'
                    , customClass: {
                        confirmButton: 'btn btn-primary'
                        , buttonsStyling: false
                    }
                });
            }
        }

        // Fungsi untuk menampilkan modal untuk MENGHAPUS!
        function confirmDeleteKelas(kelasId) {
            showSwalDialog('Apakah Anda yakin?', 'Anda tidak akan bisa mengembalikan data ini!', () => {
                Livewire.dispatch('confirmKelas', {
                    kelasId: kelasId
                });
            });
        }

        function showKelas(kelasId) {
            Livewire.dispatch('requestKelasById', {
                kelasId: kelasId
            });
        }

    </script>
    @endpush
</div>

{{-- START FORM CREATE KELAS --}}
@livewire('backend.setting.create-kelas')
{{-- END FORM CREATE KELAS --}}

{{-- START FORM EDIT KELAS --}}
@livewire('backend.setting.edit-kelas')
{{-- END FORM EDIT KELAS --}}

@endsection
