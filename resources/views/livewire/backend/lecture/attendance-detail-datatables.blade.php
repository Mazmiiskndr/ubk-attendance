@php
$canEdit = (auth()->user()->role->name_alias == 'dosen' || auth()->user()->role->name_alias == 'admin') ? true : false;
@endphp

<div wire:ignore class="table text-nowrap">
    <table class="table table-hover table-bordered table-responsive display" id="myTable" data-route="{{ route('attendances.lecturers.detail.date.getDatatable') }}" aria-describedby="myLectureByDateTables">
        <thead>
            <tr>
                <th class="text-center fw-bold">No</th>
                <th class="text-center fw-bold">Nama</th>
                <th class="text-center fw-bold">Jam Masuk</th>
                <th class="text-center fw-bold">Jam Keluar</th>
                <th class="text-center fw-bold">Tanggal</th>
                <th class="text-center fw-bold">Status</th>
                @if ($canEdit)
                <th class="text-center fw-bold">Aksi</th>
                @endif
            </tr>
        </thead>
    </table>
</div>
@push('scripts')
<script>
    var canEdit = @json($canEdit);
    var userId = @json($lectureId);

</script>
@endpush
