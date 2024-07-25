document.addEventListener('DOMContentLoaded', function () {
  const daysInWeek = 7;
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
    { data: 'H', name: 'H', className: 'text-center' },
    {
      data: 'action',
      name: 'action',
      orderable: false,
      searchable: false,
      width: '150px',
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
      order: [[0]],
      ajax: {
        url: document.getElementById('myTable').dataset.route,
        type: 'GET'
      },
      columns: columns,
      createdRow: function (row, data, dataIndex) {
        // Iterate over each cell to set the innerHTML directly to avoid HTML being escaped
        for (let i = 0; i < daysInWeek; i++) {
          const cell = $(row).find(`td:eq(${i + 2})`); // +2 to skip DT_RowIndex and student columns
          const cellData = data[`day_${i + 1}`];
          cell.html(cellData); // Set the cell content directly
        }
      },
      drawCallback: function (settings) {
        if (settings.aoData.length === 0) {
          $('#myTable tbody').html(
            '<tr>' + '<td colspan="' + columns.length + '" class="text-center">No matching records found</td>' + '</tr>'
          );
        }
      }
    });

    window.addEventListener('refreshDatatable', () => {
      dataTable.ajax.reload();
    });
  }
});
