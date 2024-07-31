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
      data: 'lecture',
      name: 'lecture'
    },
    {
      data: 'check_in',
      name: 'check_in'
    },
    {
      data: 'check_out',
      name: 'check_out'
    },
    {
      data: 'attendance_date',
      name: 'attendance_date'
    },
    {
      data: 'status',
      name: 'status',
      className: 'text-center'
    }
  ];

  if (canEdit) {
    columns.push({
      data: 'action',
      name: 'action',
      orderable: false,
      searchable: false,
      width: '150px',
      className: 'text-center'
    });
  }

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
          d.lecture_id = userId;
        }
      },
      columns: columns
    });

    window.addEventListener('refreshDatatable', () => {
      dataTable.ajax.reload();
    });
  }
});