document.addEventListener('DOMContentLoaded', function () {
  const daysInWeek = 7;
  let searchByWeek = { startDate: null, endDate: null };
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
    ...Array.from({ length: daysInWeek }, (_, i) => ({
      data: `day_${i + 1}`,
      name: `day_${i + 1}`,
      className: 'text-center'
    })),
    { data: 'A', name: 'A', className: 'text-center' },
    { data: 'T', name: 'T', className: 'text-center' },
    { data: 'S', name: 'S', className: 'text-center' },
    { data: 'I', name: 'I', className: 'text-center' },
    { data: 'H', name: 'H', className: 'text-center' }
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
        type: 'GET',
        data: function (d) {
          d.startDate = searchByWeek.startDate;
          d.endDate = searchByWeek.endDate;
        }
      },
      columns: columns
    });

    window.addEventListener('searchByWeek', event => {
      searchByWeek.startDate = event.detail[0].startDate;
      searchByWeek.endDate = event.detail[0].endDate;
      dataTable.ajax.reload();
    });

    window.addEventListener('refreshDatatable', () => {
      dataTable.ajax.reload();
    });
  }
});
