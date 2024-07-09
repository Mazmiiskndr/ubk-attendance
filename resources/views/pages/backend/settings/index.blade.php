@extends('layouts/layoutMaster')
@section('title', 'List Pengaturan')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/datatable/datatables.min.css') }}" />
@endpush

@section('content')
{{-- Is Allowed User To List Pengaturan --}}
<h4 class="fw-bold py-3 mb-1">List Pengaturan</h4>
<!-- DataTable with Buttons -->
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between flex-column flex-sm-row">
            <div class="mb-1 mb-sm-0 text-center text-sm-start">
                <h4 class="card-title">Tabel Pengaturan</h4>
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

{{-- START FORM CREATE PENGATURAN --}}
{{-- @livewire('backend.resumes.create') --}}
{{-- END FORM CREATE PENGATURAN --}}

{{-- START FORM EDIT PENGATURAN --}}
{{-- @livewire('backend.resumes.edit') --}}
{{-- END FORM EDIT PENGATURAN --}}

@endsection
