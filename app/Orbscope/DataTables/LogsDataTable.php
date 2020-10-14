<?php

namespace App\Orbscope\DataTables;
use App\Orbscope\Models\Log;
use Yajra\DataTables\Services\DataTable;

class LogsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @return \Yajra\Datatables\Engines\BaseEngine
     */
    public function dataTable($query)
    {


        return datatables($query)->setRowId('id')
            ->addColumn('show_action','admin.logs.buttons.action')
            ->addColumn('user','admin.logs.buttons.user_id')
            ->addColumn('route_name','admin.logs.buttons.route')
            ->addColumn('date','admin.logs.buttons.date')
            ->addColumn('checkbox','<input type="checkbox" class="selected_data" name="selected_data[]" value="{{ $id }}">')
            ->addColumn('show','admin.logs.buttons.show')
            //->addColumn('delete','admin.logs.buttons.delete')
            ->rawColumns(['checkbox','show_action','show','edit','user','date'])
            ;
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return mixed
     */
    public function query()
    {
        $query = Log::query()->with('user_log')->OrderBy('created_at','desc');
        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        $html =  $this->builder()
            ->columns($this->getColumns())
            ->ajax('')
            ->parameters([
                'dom' => 'Blfrtip',
                "lengthMenu" => [[10, 25, 50, -1], [10, 25, 50, trans('orbscope.all_records')]],
                'buttons' => [
                    ['extend' => 'print', 'className' => 'btn default', 'text' => '<i class="fa fa-print"></i> '.trans('orbscope.print') ,'exportOptions' => ['columns'=> '.print-col:visible'] ],
                    ['extend' => 'excel', 'className' => 'btn  default', 'text' => '<i class="fa fa-file-excel-o"> </i> '.trans('orbscope.export_excel')],
                    ['extend' => 'csv', 'className' => 'btn  default', 'text' => '<i class="fa fa-file-excel-o"> </i> '.trans('orbscope.export_csv')],
                    ['extend' => 'reload', 'className' => 'btn default', 'text' => '<i class="fa fa fa-refresh"></i> '.trans('orbscope.reload')],
                    ['extend' => 'colvis','className' => 'btn default','columns' => ':not(.noVis)'],
                    [
                        'text' => '<i class="fa fa-trash"></i> '.trans('orbscope.delete'),
                        'className'    => 'btn btn-danger deleteBtn',
                    ],
                ],
                'columnDefs' => [
        'targets'=> '-1',
            'visible'=> false],
                'initComplete' => "function () {
                this.api().columns([1,2,3,4]).every(function () {
                var column = this;
                var input = document.createElement(\"input\");
                $(input).attr( 'style', 'width: 100%');
                $(input).attr( 'class', 'form-control');
                $(input).appendTo($(column.footer()).empty())
                .on('keyup', function () {
                    column.search($(this).val()).draw();
                });
            });
            }",
                'order' => [[1, 'asc']]
            ]);
        if(GetLanguage() == 'ar'){
            $html = $html->parameters([
                'language' => [
                    'url' => url('/vendor/datatables/arabic.json')
                ]
            ]);
        }
        return $html;

    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                'name' => 'checkbox',
                'data' => 'checkbox',
                'title' => '<input type="checkbox" class="select-all" onclick="select_all()">',
                'orderable'      => false,
                'searchable'     => false,
                'exportable'     => false,
                'printable'      => false,
                'width'          => '10px',
                'aaSorting'      => 'none'
            ],
            [
                'name' => "action",
                'data'    => 'show_action',
                'title'   => trans('log.action'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => "route",
                'data'    => 'route_name',
                'title'   => trans('log.route'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => "user_log.name",
                'data'    => 'user_log.name',
                'title'   => trans('log.user_id'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => "updated_at",
                'data'    => 'date',
                'title'   => trans('log.updated_at'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => 'show',
                'data' => 'show',
                'title' => trans('orbscope.show'),
                'exportable' => false,
                'printable'  => false,
                'searchable' => false,
                'orderable'  => false,
            ],


        ];




    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'LogsDataTable_' . time();
    }
}
