// Initialize DataTable when the DOM is fully loaded
document.addEventListener('DOMContentLoaded', function () {
  const columns = [
    { data: 'DT_RowIndex', name: 'DT_RowIndex', width: '10px', orderable: false, searchable: false },
    { data: 'variable', name: 'variable' },
    { data: 'parameter', name: 'parameter' },
    { data: 'description', name: 'description' },
    { data: 'action', name: 'action', orderable: false, searchable: false }
  ];

  dataTable = $('#myTable').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,
    order: [[0]], // order by the second column
    ajax: document.getElementById('myTable').dataset.route,
    columns: columns
  });
});

// Refresh DataTable when 'refreshDatatable' event is fired
window.addEventListener('refreshDatatable', () => {
  dataTable.ajax.reload();
});

// Function to show a modal for DETAIL!
function showSetting(settingId) {
  Livewire.dispatch('getSetting', settingId);
}
