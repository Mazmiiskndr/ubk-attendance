<div wire:ignore class="table">
    <table class="table table-hover table-bordered table-responsive display" id="myTable" data-route="{{ route('show-student-course-schedules.getDatatable', ['courseId' => $courseId]) }}" aria-describedby="myCourseSchedulesTables">
        <thead>
            <tr>
                <th><b>No</b></th>
                <th><b>Hari</b></th>
                <th><b>Mulai Masuk</b></th>
                <th><b>Akhir Masuk</b></th>
                <th><b>Mulai Keluar</b></th>
                <th><b>Akhir Keluar</b></th>
            </tr>
        </thead>
    </table>
</div>
