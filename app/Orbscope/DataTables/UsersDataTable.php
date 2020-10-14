<?php

namespace App\Orbscope\DataTables;
use App\User;
use Yajra\DataTables\Services\DataTable;
class UsersDataTable extends DataTable
{
    public function dataTable($query)
    {


        return datatables($query)->setRowId('id')
            ->addColumn('checkbox','<input type="checkbox" class="selected_data" name="selected_data[]" value="{{ $id }}">')
            ->addColumn('status','admin.users.buttons.status')
            ->addColumn('edit','admin.users.buttons.edit')
            ->addColumn('employee','admin.users.buttons.employee')
            ->rawColumns(['checkbox','status','edit','employee'])
            ;
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return mixed
     */
    public function query()
    {
        $query = User::query();
        $query->select('users.*');
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
                    [
                        'text' => '<i class="fa fa-plus"></i> '.trans('orbscope.add'),
                        'className' => 'btn  default createBtn'
                    ],
                    ['extend' => 'print', 'className' => 'btn default', 'text' => '<i class="fa fa-print"></i> '.trans('orbscope.print')],
                    ['extend' => 'excel', 'className' => 'btn  default', 'text' => '<i class="fa fa-file-excel-o"> </i> '.trans('orbscope.export_excel')],
                    ['extend' => 'csv', 'className' => 'btn  default', 'text' => '<i class="fa fa-file-excel-o"> </i> '.trans('orbscope.export_csv')],
                    ['extend' => 'reload', 'className' => 'btn default', 'text' => '<i class="fa fa fa-refresh"></i> '.trans('orbscope.reload')],
                ],
                'initComplete' => "function () {
                this.api().columns([1,2,3]).every(function () {
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
                'name' => "users.name",
                'data'    => 'name',
                'title'   => trans('orbscope.users'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => "users.email",
                'data'    => 'email',
                'title'   => trans('orbscope.email'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => "users.type",
                'data'    => 'type',
                'title'   => trans('orbscope.type'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => "employee.name",
                'data'    => 'employee',
                'title'   => trans('orbscope.agent'),
                'searchable' => true,
                'orderable'  => true,
                'width'          => '150px',
            ],
            [
                'name' => "users.created_at",
                'data'    => 'created_at',
                'title'   => trans('orbscope.created_at'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => "users.active_date",
                'data'    => 'active_date',
                'title'   => trans('orbscope.Activate_date'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => "users.inactive_date",
                'data'    => 'inactive_date',
                'title'   => trans('orbscope.inactivate_date'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => 'edit',
                'data' => 'edit',
                'title' => trans('orbscope.edit'),
                'exportable' => false,
                'printable'  => false,
                'searchable' => false,
                'orderable'  => false,
            ],
            [
                'name' => "status",
                'data'    => 'status',
                'title'   => trans('orbscope.status'),
                'searchable' => true,
                'orderable'  => true,
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
        return 'LeadsDataTable_' . time();
    }
}
