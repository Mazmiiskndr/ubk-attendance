@extends('layouts/layoutMaster')
@section('title', 'List Pengaturan')

@push('styles')
@vite(['resources/assets/js/datatables.min.css'])
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
        @livewire('backend.setting.datatables')
    </div>
    {{-- End List DataTable --}}

    @push('scripts')
    @vite(['resources/assets/js/datatables.min.js',
    'resources/assets/vendor/libs/flatpickr/flatpickr.js',
    'resources/assets/js/settings-management.js'])
    <script>
        function showSetting(settingId) {
            Livewire.dispatch('requestSettingById', {
                settingId: settingId
            });
        }

    </script>
    @endpush
</div>

{{-- START FORM EDIT PENGATURAN --}}
@livewire('backend.setting.edit')
{{-- END FORM EDIT PENGATURAN --}}

@endsection
