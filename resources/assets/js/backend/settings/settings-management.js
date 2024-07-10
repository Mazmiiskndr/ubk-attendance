document.addEventListener('DOMContentLoaded', function () {
  const columns = [
    {
      data: 'DT_RowIndex',
      name: 'DT_RowIndex',
      width: '10px',
      orderable: false,
      searchable: false
    },
    {
      data: 'variable',
      name: 'variable'
    },
    {
      data: 'parameter',
      name: 'parameter'
    },
    {
      data: 'description',
      name: 'description'
    },
    {
      data: 'action',
      name: 'action',
      orderable: false,
      searchable: false
    }
  ];

  // Initialize DataTable if it hasn't been initialized yet
  if (!$.fn.dataTable.isDataTable('#myTable')) {
    var dataTable = $('#myTable').DataTable({
      processing: true,
      serverSide: true,
      responsive: true,
      autoWidth: false,
      ajax: {
        url: document.getElementById('myTable').dataset.route,
        type: 'GET'
      },
      columns: columns
    });

    window.addEventListener('refreshDatatable', () => {
      dataTable.ajax.reload();
    });
  }
});

// Event listener for hiding modals
window.addEventListener('hide-modal', () => {
  ['createNewSetting', 'updateSetting'].forEach(id => {
    var modal = new bootstrap.Modal(document.getElementById(id));
    modal.hide();
  });
});

// Event listener for showing modals
window.addEventListener('show-modal', () => {
  var updateModal = new bootstrap.Modal(document.getElementById('updateSetting'));
  updateModal.show();
});

function showSetting(settingId) {
  Livewire.dispatch('requestSettingById', {
    settingId: settingId
  });
}
