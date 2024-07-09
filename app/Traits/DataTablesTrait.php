<?php

namespace App\Traits;

use Yajra\DataTables\Facades\DataTables;

trait DataTablesTrait
{
    /**
     * Formats the response for DataTables plugin.
     * @param mixed $data
     * @param array $additionalColumns
     * @return \Illuminate\Http\JsonResponse
     */
    public function formatDataTablesResponse($data, $additionalColumns = [])
    {
        // Create a new DataTables instance and add an index column
        $dataTables = DataTables::of($data)->addIndexColumn();

        // Add additional columns to the DataTables instance
        foreach ($additionalColumns as $column => $content) {
            $dataTables->addColumn($column, $content);
        }

        // Set raw columns for the additional columns
        $dataTables->rawColumns(array_keys($additionalColumns));

        // Generate the final DataTables response
        return $dataTables->make(true);
    }

    /**
     * Refresh the DataTable.
     */
    public function refreshDataTable()
    {
        $this->dispatchBrowserEvent('refreshDatatable');
    }
}
