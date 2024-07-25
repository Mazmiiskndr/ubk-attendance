<div wire:ignore class="table text-nowrap">
    <table class="table table-hover table-bordered" id="myTable" data-route="{{ route('attendances.lecturers.week.getDatatable') }}" aria-describedby="myLectureByWeekTables">
        <thead>
            <tr>
                <th rowspan="2" class="text-center fw-bold">No</th>
                <th rowspan="2" class="text-center fw-bold">Nama</th>
                <th colspan="7" class="text-center fw-bold">Daftar Presensi Mingguan</th>
                <th colspan="6" class="text-center fw-bold">Jumlah Kehadiran</th>
            </tr>
            <tr>
                @for ($i = 0; $i < 7; $i++) <th scope="col" class="text-center fw-bold">{{ \Carbon\Carbon::now()->startOfWeek()->addDays($i)->translatedFormat('l') }}</th>
                    @endfor
                    <th class="text-center fw-bold">A</th>
                    <th class="text-center fw-bold">T</th>
                    <th class="text-center fw-bold">S</th>
                    <th class="text-center fw-bold">I</th>
                    <th class="text-center fw-bold">H</th>
                    <th class="text-center fw-bold">Aksi</th>
            </tr>
        </thead>
    </table>
</div>
