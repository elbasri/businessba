<?php

namespace App\Orbscope\DataTables;
use App\Orbscope\Models\Customer;
use Yajra\DataTables\Services\DataTable;
class CustomerDataTable extends DataTable
{
    public function dataTable($query)
    {


        return datatables($query)->setRowId('id')
            ->addColumn('status','admin.Customer.buttons.status')
            ->addColumn('cities','admin.Customer.buttons.cities')
            ->addColumn('type','admin.Customer.buttons.type')
            ->addColumn('employee','admin.Customer.buttons.employee')
            ->addColumn('ar_name','admin.branches.buttons.name')
            ->addColumn('edit','admin.Customer.buttons.edit')
            ->addColumn('attachment','admin.Customer.buttons.files')
            ->addColumn('invoices','admin.Customer.buttons.invoices')
            ->addColumn('delete','admin.Customer.buttons.delete')
            ->rawColumns(['status','edit','cities','delete','employee','type','invoices','attachment'])
            ;
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return mixed
     */
    public function query()
    {
        $query = Customer::query()->where('soft_delete','no');
        $query->select('customers.*');
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
                "scrollX" => true,
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
                'name' => "customers.name",
                'data'    => 'ar_name',
                'title'   => trans('orbscope.'.GetLanguage().'-name'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => "code",
                'data'    => 'code',
                'title'   => trans('orbscope.code'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => "cities.name",
                'data'    => 'cities',
                'title'   => trans('orbscope.city'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => "type.name",
                'data'    => 'type',
                'title'   => trans('orbscope.customer_type'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => "employee.name",
                'data'    => 'employee',
                'title'   => trans('orbscope.representor'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => 'attachment',
                'data' => 'attachment',
                'title' => trans('orbscope.files'),
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
                'name' => "invoices",
                'data'    => 'invoices',
                'title'   => trans('orbscope.invoices'),
                'searchable' => true,
                'orderable'  => true,
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
