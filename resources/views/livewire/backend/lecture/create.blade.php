<div class="card mb-4" wire:ignore.self>
    <h5 class="card-header">Detail Profil</h5>

    <div class="card-body">
        <form wire:submit.prevent="storeNewLecture" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="mb-3 col-md-6 col-sm-12">
                    <x-input-field id="name" label="Nama Lengkap" model="form.name" placeholder="Nama Lengkap.." required />
                </div>
                <div class="mb-3 col-md-6 col-sm-12">
                    <x-input-field id="identNumber" label="NIP (Nomor Induk Pegawai)" model="form.identNumber" placeholder="NIP (Nomor Induk Pegawai).." required tooltip="NIP yang di masukkan akan digunakan sebagai username dan password." />
                </div>
                <div class="mb-3 col-md-6 col-sm-12">
                    <x-input-field type="email" id="email" label="Email" model="form.email" placeholder="Email.." required />
                </div>
                <div class="mb-3 col-md-6 col-sm-12">
                    <x-input-field id="phoneNumber" label="No. Telepon" model="form.phoneNumber" placeholder="No. Telepon.." required />
                </div>
                <div class="mb-3 col-lg-4 col-md-6 col-sm-12">
                    <x-select-field id="gender" label="Jenis Kelamin" model="form.gender" required :options="['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan']" placeholder="true" />
                </div>
                <div class="mb-3 col-lg-4 col-md-6 col-sm-12">
                    <x-input-field id="birthDate" label="Tanggal Lahir" model="form.birthDate" placeholder="Tanggal Lahir.." required />
                </div>
                <div class="mb-3 col-lg-4 col-md-12 col-sm-12">
                    <x-input-field type="file" id="images" label="Gambar" model="form.images" placeholder="Gambar.." />
                </div>
                <div class="mb-3 col-md-12">
                    <x-textarea id="address" model="form.address" placeholder="Alamat Lengkap..." label="Alamat Lengkap" rows="3" required></x-textarea>
                </div>

            </div>
            <x-button type="submit" color="primary">
                <i class="ti ti-download"></i>&nbsp;Tambah
            </x-button>
        </form>
        <div class="loading-overlay d-none d-flex flex-column justify-content-center align-items-center" role="status" wire:poll.keep-alive.1000ms="checkState" wire:ignore.self>
            <div class="spinner-border" style="color: #fff !important;width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <span class="mt-3 fw-bold" style="color: #fff">{{ $message }}</span>
            <span class="mt-1 fw-bold" style="color: #fff">{{ $loadingMessage }}</span>
        </div>
    </div>
    @push('styles')
    <style>
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* Semi-transparent background */
            backdrop-filter: blur(5px);
            /* Blur effect */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 999999;
            /* Ensure it is above other content */
        }

        .spinner-border {
            width: 3rem;
            height: 3rem;
        }

        .d-none {
            display: none;
        }

    </style>
    @endpush

    @push('scripts')
    <script>
        document.addEventListener('livewire:init', function() {
            let loadingOverlay = document.querySelector('.loading-overlay');
            window.addEventListener('showLoading', () => {
                loadingOverlay.classList.remove('d-none');
            });

            window.addEventListener('hideLoading', () => {
                loadingOverlay.classList.add('d-none');
            });
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
