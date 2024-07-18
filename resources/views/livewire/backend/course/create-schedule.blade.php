<div>
    <div wire:ignore.self class="modal fade" id="createNewSchedule" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Tambah Data Jadwal Mata Kuliah</h5>
                    <x-button color="close" dismiss="true" click="closeModal" data-bs-dismiss="modal" aria-label="Close" />
                </div>
                <form wire:submit.prevent="storeNewSchedule" method="POST">
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <x-input-field id="checkInStart" label="Mulai Jam Masuk" model="form.checkInStart" placeholder="Mulai Jam Masuk.." required />
                            </div>
                            <div class="col-lg-6 mt-md-3 mt-lg-0 col-md-12">
                                <x-input-field id="checkInEnd" label="Akhir Jam Masuk" model="form.checkInEnd" placeholder="Akhir Jam Masuk.." required />
                            </div>
                            <div class="col-lg-6 mt-3 col-md-12">
                                <x-input-field id="checkOutStart" label="Mulai Jam Keluar" model="form.checkOutStart" placeholder="Mulai Jam Keluar.." required />
                            </div>
                            <div class="col-lg-6 mt-3 col-md-12">
                                <x-input-field id="checkOutEnd" label="Akhir Jam Keluar" model="form.checkOutEnd" placeholder="Akhir Jam Keluar.." required />
                            </div>
                            <div class="mt-3 col-md-12">
                                <x-select-field id="day" label="Hari" model="form.day" required :options="[
                                'Senin' => 'Senin', 
                                'Selasa' => 'Selasa',
                                'Rabu' => 'Rabu',
                                'Kamis' => 'Kamis',
                                'Jumat' => 'Jumat',
                                'Sabtu' => 'Sabtu',
                                'Minggu' => 'Minggu',
                                ]" placeholder="true" />
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
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
            let timeFields = ['#checkInStart', '#checkInEnd', '#checkOutStart', '#checkOutEnd'];
            timeFields.forEach(function(selector) {
                let element = document.querySelector(selector);
                if (element) {
                    element.flatpickr({
                        enableTime: true
                        , noCalendar: true
                        , dateFormat: "H:i"
                        , time_24hr: true
                    });
                }
            });

            let myModal = new bootstrap.Modal(document.getElementById('createNewSchedule'));

            // Event listener for hiding modal
            Livewire.on('hide-modal', () => {
                myModal.hide();
            });
        });

    </script>
    @endpush


</div>
