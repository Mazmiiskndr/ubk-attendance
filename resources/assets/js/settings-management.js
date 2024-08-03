document.addEventListener('livewire:init', function () {
  const columns = [
    {
      data: 'DT_RowIndex',
      name: 'DT_RowIndex',
      width: '10px',
      orderable: false,
      searchable: false,
      className: 'text-center fw-semibold'
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
      searchable: false,
      className: 'text-center'
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
