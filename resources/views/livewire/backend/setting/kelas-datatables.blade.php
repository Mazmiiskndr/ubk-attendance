<div wire:ignore class="table">
    <table class="table table-hover table-bordered table-responsive display" id="myTable" data-route="{{ route('kelas.getDatatable') }}" aria-describedby="myKelasTables">
        <thead>
            <tr>
                <th id="th-1">
                    <input class="form-check-input" style="border: 1px solid #8f8f8f;" type='checkbox' id='select-all-checkbox'>
                </th>
                <th><b>No</b></th>
                <th><b>Name</b></th>
                <th><b>Ruangan</b></th>
                <th><b>Aksi</b></th>
            </tr>
        </thead>
    </table>
</div>
