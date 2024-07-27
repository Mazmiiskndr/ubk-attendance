<div>
    <div wire:ignore.self class="modal fade" id="editAttendanceLectureDate" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Edit Presensi Mahasiswa Pertanggal</h5>
                    <x-button color="close" dismiss="true" click="closeModal" data-bs-dismiss="modal" aria-label="Close" />
                </div>
                <form wire:submit.prevent="updateAttendanceDate" method="POST">
                    <div class="modal-body">

                        <div class="row">
                            <div class="mb-3 col-md-6 col-sm-12">
                                <x-input-field id="name" label="Name" model="form.name" readonly style="background-color:#ddd;" />
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <x-input-field id="courseName" label="Mata Kuliah" model="form.courseName" readonly style="background-color:#ddd;" />
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <x-input-field id="checkIn" label="Jam Masuk" model="form.checkIn" readonly style="background-color:#ddd;" />
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <x-input-field id="checkOut" label="Jam Keluar" model="form.checkOut" readonly style="background-color:#ddd;" />
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <x-input-field id="attendanceDate" label="Tanggal Absen" model="form.attendanceDate" readonly style="background-color:#ddd;" />
                            </div>
                            <div class="mb-3 col-md-6 col-sm-12">
                                <x-select-field id="status" label="Status" model="form.status" required :options="[
                                'H' => 'Hadir', 
                                'I' => 'Izin',
                                'T' => 'Terlambat',
                                'S' => 'Sakit',
                                'A' => 'Alpha'
                                ]" placeholder="true" />
                            </div>
                            <div class="mb-3 col-sm-12">
                                <x-textarea id="remarks" model="form.remarks" placeholder="Catatan..." label="Catatan" rows="3">{{ $form->remarks }}</x-textarea>
                            </div>

                        </div>

                    </div>
                    <div class=" modal-footer">
                        <x-button color="secondary" data-bs-dismiss="modal" aria-label="Close" click="closeModal">
                            Tutup
                        </x-button>

                        <x-button type="submit" color="primary">
                            Simpan
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        document.addEventListener('livewire:init', function() {
            let myModal = new bootstrap.Modal(document.getElementById('editAttendanceLectureDate'));

            // Event listener for showing modal
            Livewire.on('show-modal', () => {
                myModal.show();
            });

            // Event listener for hiding modal
            Livewire.on('hide-modal', () => {
                myModal.hide();
            });
        });

    </script>
    @endpush


</div>
