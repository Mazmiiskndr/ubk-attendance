document.addEventListener('DOMContentLoaded', function () {
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
      data: 'day',
      name: 'day'
    },
    {
      data: 'check_in_start',
      name: 'check_in_start'
    },
    {
      data: 'check_in_end',
      name: 'check_in_end'
    },
    {
      data: 'check_out_start',
      name: 'check_out_start'
    },
    {
      data: 'check_out_end',
      name: 'check_out_end'
    }
  ];
  // Initialize DataTable if it hasn't been initialized yet
  if (!$.fn.dataTable.isDataTable('#myTable')) {
    var dataTable = $('#myTable').DataTable({
      processing: true,
      serverSide: true,
      responsive: true,
      autoWidth: false,
      order: [[0]],
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
