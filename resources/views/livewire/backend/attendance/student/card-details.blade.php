<div class="col-12">
    <div class="card">
        <div class="card-header">
            <div class="mb-sm-0 text-center text-sm-start">
                <h4 class="card-title">{{ $attendance->user->name }}</h4>
            </div>
        </div>
        <div class="card-body">
            <h2 class="small text-uppercase fw-bold">Details</h2>
            <div class="table">
                <table class="table table-borderless table-hover table-responsive">
                    <tr>
                        <th class="fw-bold" width="20%">Mata Kuliah</th>
                        <th class="fw-bold" width="5%">:</th>
                        <th width="75%">{{ $attendance->courseSchedule->course->name }}</th>
                    </tr>
                    <tr>
                        <th class="fw-bold">Jam Masuk</th>
                        <th class="fw-bold">:</th>
                        <th>{{ $attendance->check_in }}</th>
                    </tr>
                    <tr>
                        <th class="fw-bold">Jam Keluar</th>
                        <th class="fw-bold">:</th>
                        <th>{{ $attendance->check_out }}</th>
                    </tr>
                    <tr>
                        <th class="fw-bold">Tanggal Absensi</th>
                        <th class="fw-bold">:</th>
                        <th>{{ $attendance->attendance_date }}</th>
                    </tr>
                    <tr>
                        <th class="fw-bold">Status</th>
                        <th class="fw-bold">:</th>
                        <th>{!! $statusAttendance !!}</th>
                    </tr>
                    {{-- TODO: --}}
                    <tr>
                        <th class="fw-bold">Gambar Masuk</th>
                        <th class="fw-bold">:</th>
                        <th>{{ "TODO" }}</th>
                    </tr>
                    <tr>
                        <th class="fw-bold">Gambar Keluar</th>
                        <th class="fw-bold">:</th>
                        <th>{{ "TODO" }}</th>
                    </tr>
                    <tr>
                        <th class="fw-bold">Catatan</th>
                        <th class="fw-bold">:</th>
                        <th>{{ $attendance->remarks }}</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>

</div>
