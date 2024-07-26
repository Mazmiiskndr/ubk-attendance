<div class="order-2 order-md-2 mb-1 mb-sm-0 text-center">
    <x-input-field id="searchByWeek" model="searchByWeek" placeholder="Cari Berdasarkan Tanggal.." required style="width:300px" />
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:init', function() {
        let timeFields = ['#searchByWeek'];
        timeFields.forEach(function(selector) {
            let element = document.querySelector(selector);
            if (element) {
                element.flatpickr({
                    mode: "range"
                    , dateFormat: "Y-m-d"
                    , onChange: function(selectedDates, dateStr, instance) {
                        if (selectedDates.length === 1) {
                            // Set the maximum selectable end date to one week from the start date
                            let startDate = selectedDates[0];
                            let endDate = new Date(startDate);
                            endDate.setDate(startDate.getDate() + 6); // One week later
                            instance.set('maxDate', endDate);
                            instance.set('minDate', startDate); // Disable dates before the start date
                        } else if (selectedDates.length === 2) {
                            // Reset min and max date after a complete range is selected
                            instance.set('minDate', null);
                            instance.set('maxDate', null);
                        }
                    }
                });
            }
        });
    });

</script>
@endpush
