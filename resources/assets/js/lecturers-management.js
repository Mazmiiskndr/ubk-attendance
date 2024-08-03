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
      data: 'name',
      name: 'name'
    },
    {
      data: 'ident_number',
      name: 'ident_number'
    },
    {
      data: 'phone_number',
      name: 'phone_number'
    },
    {
      data: 'status',
      name: 'status',
      className: 'text-center'
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
        `class='form-check-input lecturers-checkbox' value='${data}'>`
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
      let checkboxes = document.getElementsByClassName('lecturers-checkbox');

      // Set their checked property to the same as the 'select all' checkbox
      Array.from(checkboxes).forEach(checkbox => (checkbox.checked = event.target.checked));
    });
  }
});
