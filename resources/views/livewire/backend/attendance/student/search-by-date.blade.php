 <div class="mb-1 mb-sm-0 text-center">
     <x-input-field id="searchByDate" model="searchByDate" placeholder="Cari Berdasarkan Tanggal.." required style="width:300px" />
 </div>
 @push('scripts')
 <script>
     document.addEventListener('livewire:init', function() {
         let timeFields = ['#searchByDate'];
         timeFields.forEach(function(selector) {
             let element = document.querySelector(selector);
             if (element) {
                 element.flatpickr();
             }
         });
     });

 </script>
 @endpush
