<div class="card mb-4" wire:ignore.self>
    <h5 class="card-header">Detail Profil</h5>

    <div class="card-body">
        <form wire:submit.prevent="updateLecture" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="mb-3 col-md-6 col-sm-12">
                    <x-input-field id="name" label="Nama Lengkap" model="form.name" placeholder="Nama Lengkap.." required value="{{ $lecture->name }}" />
                    <x-input-field id="idLecture" type="hidden" model="form.idLecture" required value="{{ $lecture->id }}" />
                </div>
                <div class="mb-3 col-md-6 col-sm-12">
                    <x-input-field id="identNumber" label="NIP (Nomor Induk Pegawai)" model="form.identNumber" value="{{ $lecture->userDetail->ident_number }}" placeholder="NIP (Nomor Induk Pegawai).." required tooltip="NIP yang di masukkan akan digunakan sebagai username dan password." />
                </div>
                <div class="mb-3 col-md-6 col-sm-12">
                    <x-input-field type="email" id="email" label="Email" model="form.email" placeholder="Email.." required value="{{ $lecture->email }}" />
                </div>
                <div class="mb-3 col-md-6 col-sm-12">
                    <x-input-field id="phoneNumber" label="No. Telepon" model="form.phoneNumber" placeholder="No. Telepon.." required value="{{ $lecture->userDetail->phone_number }}" />
                </div>
                <div class="mb-3 col-lg-4 col-md-6 col-sm-12">
                    <x-select-field id="gender" label="Jenis Kelamin" model="form.gender" required :options="['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan']" placeholder="true" data="{{ $lecture->userDetail->gender }}" />
                </div>
                <div class="mb-3 col-lg-4 col-md-6 col-sm-12">
                    <x-input-field id="birthDate" label="Tanggal Lahir" model="form.birthDate" placeholder="Tanggal Lahir.." required value="{{ $lecture->userDetail->birthdate }}" />
                </div>
                <div class="mb-3 col-lg-4 col-md-12 col-sm-12">
                    <x-input-field type="file" id="images" label="Gambar" model="form.images" placeholder="Gambar.." />
                </div>
                <div class="mb-3 col-md-12">
                    <x-textarea id="address" model="form.address" placeholder="Alamat Lengkap..." label="Alamat Lengkap" rows="3" required>{{ $lecture->userDetail->address }}</x-textarea>
                </div>

            </div>
            <x-button type="submit" color="primary">
                <i class="ti ti-edit"></i>&nbsp; Update
            </x-button>
        </form>
    </div>
    @push('scripts')
    <script>
        document.addEventListener('livewire:init', function() {
            let timeFields = ['#birthDate'];
            timeFields.forEach(function(selector) {
                let element = document.querySelector(selector);
                if (element) {
                    element.flatpickr({
                        monthSelectorType: "static"
                    });
                }
            });
        });

    </script>
    @endpush
    <!-- /Account -->
</div>
