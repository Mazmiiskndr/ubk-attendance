<div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
    <!-- User Card -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="user-avatar-section">
                <div class=" d-flex align-items-center flex-column">
                    <img class="img-fluid rounded mb-3 pt-1 mt-4" src="{{ asset('storage/assets/images/users/' . $student->images ?? 'assets/images/users/default.png' ) }}" height="100" width="100" alt="User avatar" />
                    <div class="user-info text-center">
                        <h4 class="mb-2">{{ $student->name }}</h4>
                        <span class="badge bg-label-secondary mt-1 text-black">{{ $student->userDetail->ident_number ?? '-'}}</span>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-around flex-wrap mt-3 pt-3 pb-4 border-bottom">
                <div class="d-flex align-items-start me-4 mt-3 gap-2">
                    <span class="badge bg-label-primary p-2 rounded"><i class='ti ti-checkbox ti-sm'></i></span>
                    <div>
                        <p class="mb-0 fw-medium">1.23k</p>
                        <small>Tasks Done</small>
                    </div>
                </div>
                <div class="d-flex align-items-start mt-3 gap-2">
                    <span class="badge bg-label-primary p-2 rounded"><i class='ti ti-briefcase ti-sm'></i></span>
                    <div>
                        <p class="mb-0 fw-medium">568</p>
                        <small>Projects Done</small>
                    </div>
                </div>
            </div>
            <p class="mt-4 small text-uppercase text-muted">Details</p>
            <div class="info-container">
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <span class="fw-medium me-1">Username:</span>
                        <span>{{ $student->username }}</span>
                    </li>
                    <li class="mb-2 pt-1">
                        <span class="fw-medium me-1">Email:</span>
                        <span>{{ $student->email }}</span>
                    </li>
                    <li class="mb-2 pt-1">
                        <span class="fw-medium me-1">Status:</span>
                        @if ($student->status == 1)
                        <span class="badge bg-label-success">Aktif</span>
                        @else
                        <span class="badge bg-label-danger">Tidak Aktif</span>
                        @endif
                    </li>
                    <li class="mb-2 pt-1">
                        <span class="fw-medium me-1">No Telepon:</span>
                        <span>{{ $student->userDetail->phone_number ?? '-' }}</span>
                    </li>
                    <li class="mb-2 pt-1">
                        <span class="fw-medium me-1">Jenis Kelamin:</span>
                        <span>{{ $student->userDetail->gender ?? "-" }}</span>
                    </li>
                    <li class="pt-1">
                        <span class="fw-medium me-1">Tanggal Lahir:</span>
                        <span>{{ $student->userDetail->birthdate ?? "-" }}</span>
                    </li>
                    <li class="pt-1">
                        <span class="fw-medium me-1">Alamat:</span>
                        <span>{{ $student->userDetail->address ?? "-" }}</span>
                    </li>
                </ul>
                {{-- TODO: --}}
                <hr>
                <div class="d-flex justify-content-center">
                    <a href="{{ route('backend.student.edit',base64_encode($student->id)) }}" class="btn btn-primary me-3"><i class="fa fa-edit"></i>&nbsp;Edit</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /User Card -->

</div>
