<?php

namespace App\Orbscope\DataTables;
use App\Orbscope\Models\Customer;
use Yajra\DataTables\Services\DataTable;
class ReportCustomerDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @return \Yajra\Datatables\Engines\BaseEngine
     */
    public function dataTable($query)
    {


        return datatables($query)->setRowId('id')
            ->addColumn('status','admin.Customer.buttons.status')
            ->addColumn('cities','admin.Customer.buttons.cities')
            ->addColumn('edit','admin.Customer.buttons.edit')
            ->addColumn('delete','admin.Customer.buttons.delete')
            ->rawColumns(['status','edit','cities','delete'])
            ;
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return mixed
     */
    public function query()
    {
        $query = Customer::query()->where(function($q){
            if(request()->has('type_id') && request('type_id')!= null) {

                return $q->where('customers.type_id',request()->input('type_id'));
            }
        });
        $query->where(function($q){
            if(request()->has('agent_id') && request('agent_id')!= null) {
                return $q->where('customers.employee_id',request()->input('agent_id'));
            }
        });

        $query->where(function($q){
            if(request()->has('city_id') && request('city_id')!= null) {
                return $q->where('customers.city_id',request()->input('city_id'));
            }
        });
        $query->where(function($q){
            if (request()->has('date_from') && request('date_from') != null && request('date_to')== null ) {
                $q->where('customers.created_at', '>=', request()->input('date_from'));
            }
            if (request()->has('date_to') && request('date_to') != null && request('date_from')== null ) {
                $q->where('customers.created_at', '<=', request()->input('created_at'));
            }
            if (request('date_to') != null && request('date_from')!= null ) {
                $q->whereBetween('customers.created_at', [request()->input('date_from'), request()->input('date_to')]);
            }
        });
        $query->with('type')->with('agent')->where('soft_delete','no')->select('customers.*');
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
                    ['extend' => 'print', 'className' => 'btn default', 'text' => '<i class="fa fa-print"></i> '.trans('orbscope.print')],
                    ['extend' => 'excel', 'className' => 'btn  default', 'text' => '<i class="fa fa-file-excel-o"> </i> '.trans('orbscope.export_excel')],
                    ['extend' => 'csv', 'className' => 'btn  default', 'text' => '<i class="fa fa-file-excel-o"> </i> '.trans('orbscope.export_csv')],
                    ['extend' => 'reload', 'className' => 'btn default', 'text' => '<i class="fa fa fa-refresh"></i> '.trans('orbscope.reload')],
                ],
                'initComplete' => "function () {
                this.api().columns([0,1,2,3,4]).every(function () {
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
                'order' => [[0, 'asc']]

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
                'name' => "name",
                'data'    => 'name',
                'title'   => trans('orbscope.Customer'),
                'searchable' => true,
                'orderable'  => true,
                'width'          => '150px',
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
                'data'    => 'type.name',
                'title'   => trans('orbscope.customer_type'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => "agent.name",
                'data'    => 'agent.name',
                'title'   => trans('orbscope.representor'),
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
        return 'CustomerDataTable_' . time();
    }
}
