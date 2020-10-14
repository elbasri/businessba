<?php

namespace App\Orbscope\DataTables;
use App\Orbscope\Models\Employee;
use App\User;
use Yajra\DataTables\Services\DataTable;
class AgentsDataTable extends DataTable
{




    public function dataTable($query)
    {


        return datatables($query)->setRowId('id')
            ->addColumn('checkbox','<input type="checkbox" class="selected_data" name="selected_data[]" value="{{ $id }}">')
            ->addColumn('city','admin.agents.buttons.city')
            ->addColumn('attachment','admin.agents.buttons.files')
            ->addColumn('branch','admin.agents.buttons.branch')
            ->addColumn('depart','admin.agents.buttons.depart')
            ->addColumn('poisition','admin.agents.buttons.poisition')
            ->addColumn('ar_name','admin.branches.buttons.name')
            ->addColumn('status','admin.agents.buttons.status')
            ->addColumn('edit','admin.agents.buttons.edit')
            ->addColumn('delete','admin.agents.buttons.delete')
            ->rawColumns(['checkbox','city','status','edit', 'delete','ar_name','branch','depart','position','attachment'])
            ;
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return mixed
     */
    public function query()
    {
        $query = Employee::query()->where('soft_delete','no');

        $query->select('employees.*');
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
                    [
                        'text' => '<i class="fa fa-trash"></i> '.trans('orbscope.delete'),
                        'className'    => 'btn btn-danger deleteBtn',
                    ],
                ],
                "scrollX" => true,
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
                'name' => "code",
                'data'    => 'code',
                'title'   => trans('orbscope.code'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => "employees.name",
                'data'    => 'ar_name',
                'title'   => trans('orbscope.'.GetLanguage().'-name'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => "branch",
                'data'    => 'branch',
                'title'   => trans('orbscope.branch'),
                'searchable' => true,
                'orderable'  => true,
                'width'      => '90px',
            ],
            [
                'name' => "depart",
                'data'    => 'depart',
                'title'   => trans('orbscope.department'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => "poisition",
                'data'    => 'poisition',
                'title'   => trans('orbscope.position'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => "city",
                'data'    => 'city',
                'title'   => trans('orbscope.city'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => "work_mobile",
                'data'    => 'work_mobile',
                'title'   => trans('orbscope.work_mobile'),
                'searchable' => true,
                'orderable'  => true,
                'width'      => '70px',
            ],
            [
                'name' => "personal_mobile",
                'data'    => 'personal_mobile',
                'title'   => trans('orbscope.personal_mobile'),
                'searchable' => true,
                'orderable'  => true,
                'width'      => '70px',
            ],
            [
                'name' => "birth_date",
                'data'    => 'birth_date',
                'title'   => trans('orbscope.birth_date'),
                'searchable' => true,
                'orderable'  => true,
                'width'      => '70px',
            ],
            [
                'name' => "email",
                'data'    => 'email',
                'title'   => trans('orbscope.email'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => "start_date",
                'data'    => 'start_date',
                'title'   => trans('orbscope.start_date'),
                'searchable' => true,
                'orderable'  => true,
                'width'      => '70px',
            ],
            [
                'name' => "status",
                'data'    => 'status',
                'title'   => trans('orbscope.status'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => "attachment",
                'data'    => 'attachment',
                'title'   => trans('orbscope.files'),
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
        return 'LeadsDataTable_' . time();
    }
}
