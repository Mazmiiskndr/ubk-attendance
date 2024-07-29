<div>
    <div wire:ignore.self class="modal fade" id="editCourse" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Edit Data Jadwal Mata Kuliah</h5>
                    <x-button color="close" dismiss="true" click="closeModal" data-bs-dismiss="modal" aria-label="Close" />
                </div>
                <form wire:submit.prevent="updateCourse" method="POST">
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">
                                <x-input-field id="updateName" label="Nama Mata Kuliah" model="form.name" placeholder="Nama Mata Kuliah.." required />
                            </div>
                            <div class="mt-3 col-md-12">
                                <x-select-field id="updateLecturerId" label="Nama Dosen" model="form.lecturerId" required :options="$lecturers ? $lecturers->pluck('name', 'id')->toArray() : []" class="select2 form-select" data-allow-clear="true" />
                            </div>
                            <div class="mt-3 col-md-12">
                                <x-select-field id="updateClassId" label="Nama Kelas" model="form.classId" required :options="$kelas ? $kelas->toArray() : []" class="select2 form-select" data-allow-clear="true" />
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
            let myModal = new bootstrap.Modal(document.getElementById('editCourse'));

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
