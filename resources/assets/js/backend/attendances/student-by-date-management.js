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
      data: 'student',
      name: 'student'
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
      name: 'status'
    },
    {
      data: 'action',
      name: 'action',
      orderable: false,
      searchable: false,
      width: '150px',
      className: 'text-center'
    }
  ];
  columns.unshift({
    data: 'id',
    render: function (data, type, row) {
      return (
        `<input type='checkbox' style='border: 1px solid #8f8f8f;' ` +
        `class='form-check-input student-by-date-checkbox' value='${data}'>`
      );
    },
    orderable: false,
    searchable: false,
    width: '15px'
  });
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

  // Get the 'select all' checkbox
  let selectAllCheckbox = document.getElementById('select-all-checkbox');

  // Only add the event listener if the checkbox actually exists
  if (selectAllCheckbox) {
    selectAllCheckbox.addEventListener('click', function (event) {
      // Get all the checkboxes with the class 'group-checkbox'
      let checkboxes = document.getElementsByClassName('student-by-date-checkbox');

      // Set their checked property to the same as the 'select all' checkbox
      Array.from(checkboxes).forEach(checkbox => (checkbox.checked = event.target.checked));
    });
  }
});
