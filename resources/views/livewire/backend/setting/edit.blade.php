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
                                <x-input-field id="timeZone" label="Zona Waktu" model="timeZone" placeholder="Zona Waktu.." required />
                                @elseif($settingId == 2)
                                <x-input-field id="botToken" label="Zona Waktu" model="botToken" placeholder="Bot Tken.." required />
                                @elseif($settingId == 3)
                                <x-input-field id="ipAddress" label="IP Address" model="ipAddress" placeholder="IP Address.." required />
                                @endif
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
        // function initializeFlatpickr() {
        // let timeFields = ['#checkInStart', '#checkInEnd', '#checkOutStart', '#checkOutEnd'];

        // timeFields.forEach(function(selector) {
        //  let element = document.querySelector(selector);
        // if (element) {
        //  element.flatpickr({
        //  enableTime: true
        // , noCalendar: true
        // , dateFormat: "H:i:S"
        // , time_24hr: true
        // , enableSeconds: true
        // });
        // }
        // });
        // }

        document.addEventListener('livewire:init', function() {
            let myModal = new bootstrap.Modal(document.getElementById('updateSetting'));

            // Event listener for showing modal
            Livewire.on('show-modal', () => {
                myModal.show(); // Delay to ensure the modal is fully rendered
            });

            // Event listener for hiding modal
            Livewire.on('hide-modal', () => {
                myModal.hide();
            });
        });

    </script>
    @endpush
</div>
