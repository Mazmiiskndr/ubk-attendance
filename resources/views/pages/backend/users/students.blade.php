@extends('layouts/layoutMaster')
@section('title', 'List Mahasiswa')

@push('styles')
@vite(['resources/assets/js/datatable/datatables.min.css'])
@endpush

@section('content')
{{-- Is Allowed User To List Mahasiswa --}}
<h4 class="fw-bold py-3 mb-1">List Mahasiswa</h4>
<!-- DataTable with Buttons -->
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between flex-column flex-sm-row">
            <div class="mb-1 mb-sm-0 text-center text-sm-start">
                <h4 class="card-title">Tabel Mahasiswa</h4>
            </div>
            <div>
                <div class="d-flex justify-content-sm-end flex-column flex-sm-row gap-1">
                    {{-- Start Button for Create New Mahasiswa --}}
                    <x-button type="button" color="primary btn-sm me-sm-1 mb-2 mb-sm-0" data-bs-toggle="modal" data-bs-target="#createNewResume">
                        <i class="tf-icons fas fa-plus-circle ti-xs me-1"></i>&nbsp; Tambah Data Mahasiswa
                    </x-button>
                    {{-- End Button for Create New Mahasiswa --}}

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
        @livewire('backend.student.datatables')
    </div>
    {{-- End List DataTable --}}

    @push('scripts')
    @vite(['resources/assets/js/datatable/datatables.min.js'])
    {{-- <script src="{{ asset('assets/js/backend/resumes/resumes-management.js') }}"></script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const columns = [{
                    data: 'DT_RowIndex'
                    , name: 'DT_RowIndex'
                    , width: '10px'
                    , orderable: false
                    , searchable: false
                    , className: 'text-center fw-semibold'
                }
                , {
                    data: 'name'
                    , name: 'name'
                }
                , {
                    data: 'nim'
                    , name: 'nim'
                }
                , {
                    data: 'gender'
                    , name: 'gender'
                }
                , {
                    data: 'phone_number'
                    , name: 'phone_number'
                }
                , {
                    data: 'status'
                    , name: 'status'
                    , className: 'text-center'
                }
                , {
                    data: 'action'
                    , name: 'action'
                    , orderable: false
                    , searchable: false
                    , width: '150px'
                    , className: 'text-center'
                }
            ];

            // Initialize DataTable if it hasn't been initialized yet
            if (!$.fn.dataTable.isDataTable('#myTable')) {
                var dataTable = $('#myTable').DataTable({
                    processing: true
                    , serverSide: true
                    , responsive: true
                    , autoWidth: false
                    , ajax: {
                        url: document.getElementById('myTable').dataset.route
                        , type: 'GET'
                    }
                    , columns: columns
                });

                window.addEventListener('refreshDatatable', () => {
                    dataTable.ajax.reload();
                });
            }
        });

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
