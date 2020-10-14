<?php
namespace App\Orbscope\DataTables;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use Yajra\DataTables\Services\DataTable;


class UserRolesDataTable extends DataTable
{


    protected $roleName;


    public function dataTable($query)
    {


        return datatables($query)->setRowId('id')
        ->addColumn('checkbox','<input type="checkbox" class="selected_data" name="selected_data[]" value="{{ $id }}">')
        ->addColumn('show','admin.agents.buttons.show')
        ->addColumn('edit','admin.agents.buttons.edit')
        ->addColumn('delete','admin.agents.buttons.delete')
        ->rawColumns(['checkbox','show','edit', 'delete'])
        ;
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return mixed
     */
    public function query()
    {
        $query = User::query()->role($this->roleName);
        $query->select('users.*');
        return $this->applyScopes($query);
    }

    public function GetRoleName($name) {
        $this->roleName = $name;
        return $this;
    }

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
                [
                    'text' => '<i class="fa fa-trash"></i> '.trans('orbscope.delete'),
                    'className'    => 'btn btn-danger deleteBtn',
                ],
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
                'title'   => trans('orbscope.agents'),
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
                'name' => 'show',
                'data' => 'show',
                'title' => trans('orbscope.show'),
                'exportable' => false,
                'printable'  => false,
                'searchable' => false,
                'orderable'  => false,
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
        return 'UsersDataTable_' . time();
    }
}
