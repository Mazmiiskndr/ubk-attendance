<div wire:ignore class="table">
    <table class="table table-hover table-bordered table-responsive display" id="myTable" data-route="{{ route('student.getDatatable') }}" aria-describedby="myStudentTables">
        <thead>
            <tr>
                <th id="th-1">
                    <input class="form-check-input" style="border: 1px solid #8f8f8f;" type='checkbox' id='select-all-checkbox'>
                </th>
                <th><b>No</b></th>
                <th><b>Nama</b></th>
                <th><b>NIM</b></th>
                <th><b>Jenis Kelamin</b></th>
                <th><b>No. HP</b></th>
                <th><b>Status</b></th>
                <th><b>Aksi</b></th>
            </tr>
        </thead>
    </table>
</div>
