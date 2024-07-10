<div>
    <div wire:ignore.self class="modal fade" id="updateSetting" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Edit Setting</h5>
                    <x-button color="close" dismiss="true" click="closeModal" data-bs-dismiss="modal" aria-label="Close" />
                </div>
                <form wire:submit.prevent="updateSetting" method="POST">
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-12">
                                @if($settingId == 1)
                                <x-input-field id="checkInStart" label="Mulai Jam Masuk" model="checkInStart" placeholder="Enter a Setting Name.." required />
                                @elseif($settingId == 2)
                                <x-input-field id="checkInEnd" label="Akhir Jam Masuk" model="checkInEnd" placeholder="Enter a Setting Name.." required />
                                @elseif($settingId == 3)
                                <x-input-field id="checkOutStart" label="Mulai Jam Keluar" model="checkOutStart" placeholder="Enter a Setting Name.." required />
                                @elseif($settingId == 4)
                                <x-input-field id="checkOutEnd" label="Akhir Jam Keluar" model="checkOutEnd" placeholder="Enter a Setting Name.." required />
                                @elseif($settingId == 5)
                                <x-input-field id="holiday1" label="Hari Libur 1" model="holiday1" placeholder="Enter a Setting Name.." required />
                                @elseif($settingId == 6)
                                <x-input-field id="holiday2" label="Hari Libur 2" model="holiday2" placeholder="Enter a Setting Name.." required />
                                @elseif($settingId == 7)
                                <x-input-field id="timeZone" label="Zona Waktu" model="timeZone" placeholder="Enter a Setting Name.." required />
                                @elseif($settingId == 8)
                                <x-input-field id="ipAddress" label="IP Address" model="ipAddress" placeholder="Enter a Setting Name.." required />
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <x-button color="secondary" data-bs-dismiss="modal" aria-label="Close" click="closeModal">
                            Close
                        </x-button>

                        <x-button type="submit" color="primary">
                            Save Changes
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
    @script

    <script>
        $wire.on('show-modal', () => {
            var myModal = new bootstrap.Modal(document.getElementById('updateSetting'));
            myModal.show();
        });

        $wire.on('hide-modal', () => {
            var myModal = new bootstrap.Modal(document.getElementById('updateSetting'));
            myModal.hide();
        });

    </script>
    @endscript
    @endpush
</div>
