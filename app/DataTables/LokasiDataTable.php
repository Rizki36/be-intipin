<?php

namespace App\DataTables;

use App\Models\Lokasi;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LokasiDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        // client side
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Lokasi $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $lokasi = Lokasi::select();

        return $this->applyScopes($lokasi);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('datatable')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->parameters([
                'dom'          => 'Bfrtip',
                'buttons'      => ['excel', 'reload'],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('nama'),
            Column::make('tipe'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(120)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Lokasi_' . date('YmdHis');
    }

    public function ajax()
    {
        return datatables()
            ->eloquent($this->query())
            ->addColumn('action', function ($lokasi) {
                return view('admin.lokasi._action', $lokasi);
            })
            ->make(true);
    }
}
