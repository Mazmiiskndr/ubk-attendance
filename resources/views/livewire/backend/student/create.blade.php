<div class="card mb-4" wire:ignore.self>
    <h5 class="card-header">Detail Profil</h5>

    <div class="card-body">
        <form wire:submit.prevent="storeNewStudent" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="mb-3 col-md-6 col-sm-12">
                    <x-input-field id="name" label="Nama Lengkap" model="form.name" placeholder="Nama Lengkap.." required />
                </div>
                <div class="mb-3 col-md-6 col-sm-12">
                    <x-input-field id="identNumber" label="NIM (Nomor Induk Mahasiswa)" model="form.identNumber" placeholder="NIM (Nomor Induk Mahasiswa).." required tooltip="NIM yang di masukkan akan digunakan sebagai username dan password." />
                </div>
                <div class="mb-3 col-md-6 col-sm-12">
                    <x-input-field type="email" id="email" label="Email" model="form.email" placeholder="Email.." required />
                </div>
                <div class="mb-3 col-md-6 col-sm-12">
                    <x-input-field id="phoneNumber" label="No. Telepon" model="form.phoneNumber" placeholder="No. Telepon.." required />
                </div>
                <div class="mb-3 col-md-6 col-sm-12">
                    <x-select-field id="gender" label="Jenis Kelamin" model="form.gender" required :options="['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan']" placeholder="true" />
                </div>
                <div class="mb-3 col-md-6 col-sm-12">
                    <x-select-field id="classId" label="Kelas" model="form.classId" required :options="$kelas ? $kelas->pluck('name', 'id')->toArray() : []" class="select2 form-select" data-allow-clear="true" />
                </div>
                <div class="mb-3 col-lg-4 col-md-6 col-sm-12">
                    <x-input-field type="number" id="semester" label="Semester" model="form.semester" placeholder="Semester.." required min="1" max="50" />
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
            <div class="d-flex justify-content-between flex-column flex-sm-row">
                <div class="gap-2 flex-column flex-sm-row d-flex">
                    <x-button type="submit" color="primary" id="saveButton" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambahkan data mahasiswa dan daftarkan sidik jari ke sistem absensi. Pastikan kontroler terhubung dengan benar.">
                        <i class="ti ti-download"></i>&nbsp;Tambah
                    </x-button>
                    <x-button color="secondary" id="cancelButton" click="resetFields">
                        <i class="ti ti-circle-x"></i>&nbsp;Cancel
                    </x-button>
                </div>
            </div>

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
