<div>
    <div wire:ignore.self class="modal fade" id="editKelas" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Edit Data Jadwal Kelas</h5>
                    <x-button color="close" dismiss="true" click="closeModal" data-bs-dismiss="modal" aria-label="Close" />
                </div>
                <form wire:submit.prevent="updateKelas" method="POST">
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">
                                <x-input-field id="updateName" label="Nama Kelas" model="form.name" placeholder="Nama Kelas.." required />
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
            let myModal = new bootstrap.Modal(document.getElementById('editKelas'));

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
