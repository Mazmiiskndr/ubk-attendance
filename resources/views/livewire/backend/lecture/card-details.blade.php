 <!-- User Card -->
 <div class="card mb-4">
     <div class="card-body">
         <div class="user-avatar-section">
             <div class=" d-flex align-items-center flex-column">
                 <img class="img-fluid rounded mb-3 pt-1 mt-4" src="{{ asset('storage/assets/images/users/' . $lecture->images ?? 'assets/images/users/default.png' ) }}" height="100" width="100" alt="User avatar" />
                 <div class="user-info text-center">
                     <h4 class="mb-2">{{ $lecture->name }}</h4>
                     <span class="badge bg-label-secondary mt-1 text-black">{{ $lecture->userDetail->ident_number ?? '-'}}</span>
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
                     <span>{{ $lecture->username }}</span>
                 </li>
                 <li class="mb-2 pt-1">
                     <span class="fw-medium me-1">Email:</span>
                     <span>{{ $lecture->email }}</span>
                 </li>
                 <li class="mb-2 pt-1">
                     <span class="fw-medium me-1">NIP:</span>
                     <span>{{ $lecture->userDetail->ident_number?? '-' }}</span>
                 </li>
                 <li class="mb-2 pt-1">
                     <span class="fw-medium me-1">Status:</span>
                     @if ($lecture->status == 1)
                     <span class="badge bg-label-success">Aktif</span>
                     @else
                     <span class="badge bg-label-danger">Tidak Aktif</span>
                     @endif
                 </li>
                 <li class="mb-2 pt-1">
                     <span class="fw-medium me-1">No Telepon:</span>
                     <span>{{ $lecture->userDetail->phone_number ?? '-' }}</span>
                 </li>
                 <li class="mb-2 pt-1">
                     <span class="fw-medium me-1">Jenis Kelamin:</span>
                     <span>{{ $lecture->userDetail->gender ?? "-" }}</span>
                 </li>
                 <li class="pt-1">
                     <span class="fw-medium me-1">Tanggal Lahir:</span>
                     <span>{{ $lecture->userDetail->birthdate ?? "-" }}</span>
                 </li>
                 <li class="pt-1">
                     <span class="fw-medium me-1">Alamat:</span>
                     <span>{{ $lecture->userDetail->address ?? "-" }}</span>
                 </li>
             </ul>
             <hr>
             <div class="d-flex justify-content-center">
                 <a href="{{ route('backend.lecture.edit',base64_encode($lecture->id)) }}" class="btn btn-primary me-3"><i class="fa fa-edit"></i>&nbsp;Edit</a>
             </div>
         </div>
     </div>
 </div>
 <!-- /User Card -->
