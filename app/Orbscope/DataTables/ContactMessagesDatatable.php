<?php

namespace App\Orbscope\DataTables;
use App\Orbscope\Models\ContactUs;
use Yajra\DataTables\Services\DataTable;

class ContactMessagesDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @return \Yajra\Datatables\Engines\BaseEngine
     */
    public function dataTable($query)
    {


        return datatables($query)->setRowId('id')
            ->addColumn('checkbox','<input type="checkbox" class="selected_data" name="selected_data[]" value="{{ $id }}">')
            ->addColumn('show','admin.contact_us.buttons.show')
            ->addColumn('delete','admin.contact_us.buttons.delete')
            ->rawColumns(['checkbox', 'show', 'delete'])
            ;
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return mixed
     */
    public function query()
    {
        $query = ContactUs::query()->select('contact_us.*');
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
                    this.api().columns([1,2]).every(function () {
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
                'name' => "contact_us.email",
                'data'    => 'email',
                'title'   => trans('orbscope.email'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => "contact_us.subject",
                'data'    => 'subject',
                'title'   => trans('orbscope.subject'),
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
            [
                'name' => 'delete',
                'data' => 'delete',
                'title' => trans('orbscope.delete'),
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
        return 'ContactMessagesDatatable_' . time();
    }
}
