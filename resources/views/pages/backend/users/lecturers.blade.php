@extends('layouts/layoutMaster')
@section('title', 'List Dosen')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/datatable/datatables.min.css') }}" />
@endpush

@section('content')
{{-- Is Allowed User To List Dosen --}}
<h4 class="fw-bold py-3 mb-1">List Dosen</h4>
<!-- DataTable with Buttons -->
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between flex-column flex-sm-row">
            <div class="mb-1 mb-sm-0 text-center text-sm-start">
                <h4 class="card-title">Table Dosen</h4>
            </div>
            <div>
                <div class="d-flex justify-content-sm-end flex-column flex-sm-row">
                    {{-- Start Button for Create New Dosen --}}
                    <x-button type="button" color="primary btn-sm me-sm-1 mb-2 mb-sm-0" data-bs-toggle="modal" data-bs-target="#createNewResume">
                        <i class="tf-icons fas fa-plus-circle ti-xs me-1"></i>&nbsp; Tambah Data Dosen
                    </x-button>
                    {{-- End Button for Create New Dosen --}}

                    {{-- Start Button for Delete Batch --}}
                    <x-button type="button" color="danger btn-sm" onclick="confirmDeleteBatch()">
                        <i class="tf-icons fas fa-trash-alt ti-xs me-1"></i>&nbsp; Hapus Massal
                    </x-button>
                    {{-- End Button for Delete Batch --}}
                </div>
            </div>
        </div>
    </div>

    {{-- Start List DataTable --}}
    <div class="card-body">
        {{-- @livewire('backend.resumes.datatables') --}}
    </div>
    {{-- End List DataTable --}}

    @push('scripts')
    <script src="{{ asset('assets/datatable/datatables.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/backend/resumes/resumes-management.js') }}"></script> --}}
    @endpush
</div>

{{-- START FORM CREATE DOSEN --}}
{{-- @livewire('backend.resumes.create') --}}
{{-- END FORM CREATE DOSEN --}}

{{-- START FORM EDIT DOSEN --}}
{{-- @livewire('backend.resumes.edit') --}}
{{-- END FORM EDIT DOSEN --}}

@endsection
