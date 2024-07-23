<div wire:ignore class="table">
    <table class="table table-hover table-bordered table-responsive display" id="myTable" data-route="{{ route('attendances.students.date.getDatatable') }}" aria-describedby="myStudentByDateTables">
        <thead>
            <tr>
                <th id="th-1">
                    <input class="form-check-input" style="border: 1px solid #8f8f8f;" type='checkbox' id='select-all-checkbox'>
                </th>
                <th><b>No</b></th>
                <th><b>Nama Mahasiswa</b></th>
                <th><b>Jam Masuk</b></th>
                <th><b>Jam Keluar</b></th>
                <th><b>Tanggal</b></th>
                <th><b>Status</b></th>
                <th><b>Aksi</b></th>
            </tr>
        </thead>
    </table>
</div>
