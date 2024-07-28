<div class="col-12">
    <div class="card">
        <div class="card-header">
            <div class="mb-sm-0 text-center text-sm-start">
                <h4 class="card-title">{{ $attendance->user->name }}</h4>
            </div>
        </div>
        <div class="card-body">
            <h2 class="small text-uppercase fw-bold">Details</h2>
            <div class="row">
                <div class="table mb-3">
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
                        <tr>
                            <th class="fw-bold">Catatan</th>
                            <th class="fw-bold">:</th>
                            <th>{{ $attendance->remarks }}</th>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-6 d-flex justify-content-center">
                    @if ($attendance->image_in)
                    <a href="{{ asset('storage/assets/images/attendances/' . $attendance->image_in) }}" class="glightbox">
                        <img src="{{ asset('storage/assets/images/attendances/' . $attendance->image_in) }}" alt="Gambar Masuk" class="img-fluid rounded shadow-lg" width="200">
                    </a>
                    @else
                    <span>Tidak Ada Gambar</span>
                    @endif

                </div>
                <div class="col-6 d-flex justify-content-center">
                    @if ($attendance->image_out)
                    <a href="{{ asset('storage/assets/images/attendances/' . $attendance->image_out) }}" class="glightbox">
                        <img src="{{ asset('storage/assets/images/attendances/' . $attendance->image_out) }}" alt="Gambar Keluar" class="img-fluid rounded shadow-lg" width="200">
                    </a>
                    @else
                    <span>Tidak Ada Gambar</span>
                    @endif
                </div>
            </div>

        </div>
    </div>

</div>
