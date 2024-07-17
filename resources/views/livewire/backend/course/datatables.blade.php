<div wire:ignore class="table">
    <table class="table table-hover table-bordered table-responsive display" id="myTable" data-route="{{ route('course.getDatatable') }}" aria-describedby="myCourseTables">
        <thead>
            <tr>
                <th id="th-1">
                    <input class="form-check-input" style="border: 1px solid #8f8f8f;" type='checkbox' id='select-all-checkbox'>
                </th>
                <th><b>No</b></th>
                <th><b>Nama Mata Kuliah</b></th>
                <th><b>Nama Dosen</b></th>
                <th><b>Aksi</b></th>
            </tr>
        </thead>
    </table>
</div>
