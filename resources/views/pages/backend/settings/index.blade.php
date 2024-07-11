@extends('layouts/layoutMaster')
@section('title', 'List Pengaturan')

@push('styles')
@vite(['resources/assets/js/datatable/datatables.min.css','resources/assets/vendor/libs/flatpickr/flatpickr.scss'])
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
    @vite(['resources/assets/js/datatable/datatables.min.js','resources/assets/vendor/libs/flatpickr/flatpickr.js'])

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const columns = [{
                    data: 'DT_RowIndex'
                    , name: 'DT_RowIndex'
                    , width: '10px'
                    , orderable: false
                    , searchable: false
                }
                , {
                    data: 'variable'
                    , name: 'variable'
                }
                , {
                    data: 'parameter'
                    , name: 'parameter'
                }
                , {
                    data: 'description'
                    , name: 'description'
                }
                , {
                    data: 'action'
                    , name: 'action'
                    , orderable: false
                    , searchable: false
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
