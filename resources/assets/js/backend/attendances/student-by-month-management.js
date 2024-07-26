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
    { data: 'student', name: 'student', className: 'text-nowrap' },
    { data: 'week_1', name: 'week_1', className: 'text-center' },
    { data: 'week_2', name: 'week_2', className: 'text-center' },
    { data: 'week_3', name: 'week_3', className: 'text-center' },
    { data: 'week_4', name: 'week_4', className: 'text-center' },
    { data: 'week_5', name: 'week_5', className: 'text-center' },
    { data: 'total_present', name: 'total_present', className: 'text-center' },
    { data: 'total_absent', name: 'total_absent', className: 'text-center' },
    { data: 'total_late', name: 'total_late', className: 'text-center' },
    { data: 'total_sick', name: 'total_sick', className: 'text-center' },
    { data: 'total_leave', name: 'total_leave', className: 'text-center' }
  ];

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
