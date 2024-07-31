<div>
    <div class=" flex-grow-1 ">
        <div class="row g-4 mb-4">
            @if(auth()->user()->role->name_alias == 'admin')
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span>Total Pengguna Aplikasi</span>
                                <div class="d-flex align-items-center my-2">
                                    <h3 class="mb-0 me-2">{{ $totalUsers }}</h3>
                                </div>
                            </div>
                            <div class="avatar">
                                <span class="avatar-initial rounded bg-label-warning">
                                    <i class="ti ti-user-pause ti-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span>Total Mahasiswa</span>
                                <div class="d-flex align-items-center my-2">
                                    <h3 class="mb-0 me-2">{{ $totalStudents }}</h3>
                                </div>
                            </div>
                            <div class="avatar">
                                <span class="avatar-initial rounded bg-label-primary">
                                    <i class="ti ti-users ti-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span>Total Dosen</span>
                                <div class="d-flex align-items-center my-2">
                                    <h3 class="mb-0 me-2">{{ $totalLecturers }}</h3>
                                </div>
                            </div>
                            <div class="avatar">
                                <span class="avatar-initial rounded bg-label-success">
                                    <i class="ti ti-users-group ti-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if(auth()->user()->role->name_alias == 'dosen')
            <div class="col-sm-12 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span>Total Absensi Bulan {{ \Carbon\Carbon::now()->translatedFormat('F') }}</span>
                                <div class="d-flex align-items-center my-2">
                                    <h3 class="mb-0 me-2">{{ $totalAttendancePerMonth }}</h3>
                                </div>
                            </div>
                            <div class="avatar">
                                <span class="avatar-initial rounded bg-label-info">
                                    <i class="ti ti-fingerprint ti-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span>Total Mahasiswa</span>
                                <div class="d-flex align-items-center my-2">
                                    <h3 class="mb-0 me-2">{{ $totalStudents }}</h3>
                                </div>
                            </div>
                            <div class="avatar">
                                <span class="avatar-initial rounded bg-label-primary">
                                    <i class="ti ti-users ti-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span>Total Absensi Mahasiswa</span>
                                <div class="d-flex align-items-center my-2">
                                    <h3 class="mb-0 me-2">{{ $totalAttendanceStudent }}</h3>
                                </div>
                            </div>
                            <div class="avatar">
                                <span class="avatar-initial rounded bg-label-success">
                                    <i class="ti ti-users-group ti-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if(auth()->user()->role->name_alias == 'mahasiswa')
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span>Total Kehadiran Bulan {{ \Carbon\Carbon::now()->translatedFormat('F') }}</span>
                                <div class="d-flex align-items-center my-2">
                                    <h3 class="mb-0 me-2">{{ $totalHadir }}</h3>
                                </div>
                            </div>
                            <div class="avatar">
                                <span class="avatar-initial rounded bg-label-success">
                                    <i class="ti ti-calendar-event ti-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span>Total Alpha Bulan {{ \Carbon\Carbon::now()->translatedFormat('F') }}</span>
                                <div class="d-flex align-items-center my-2">
                                    <h3 class="mb-0 me-2">{{ $totalAlpa }}</h3>
                                </div>
                            </div>
                            <div class="avatar">
                                <span class="avatar-initial rounded bg-label-danger">
                                    <i class="ti ti-square-x ti-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span>Total Sakit Bulan {{ \Carbon\Carbon::now()->translatedFormat('F') }}</span>
                                <div class="d-flex align-items-center my-2">
                                    <h3 class="mb-0 me-2">{{ $totalSakit }}</h3>
                                </div>
                            </div>
                            <div class="avatar">
                                <span class="avatar-initial rounded bg-label-warning">
                                    <i class="ti ti-mood-sick ti-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
