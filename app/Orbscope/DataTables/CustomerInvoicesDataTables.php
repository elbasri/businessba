<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 10/2/17
 * Time: 12:55
 */

namespace App\Orbscope\DataTables;
use App\Orbscope\Models\Invoice;
use Yajra\DataTables\Services\DataTable;


class CustomerInvoicesDataTables extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @return \Yajra\Datatables\Engines\BaseEngine
     */

    protected $lead_id;

    public function LeadID($id)
    {
        $this->lead_id = $id;
        return $this;
    }

    public function dataTable($query)
    {


        return datatables($query)->setRowId('id')
            ->addColumn('checkbox','<input type="checkbox" class="selected_data" name="selected_data[]" value="{{ $id }}">')
            ->addColumn('edit','admin.Invoice.buttons.edit')
            ->addColumn('code','admin.Invoice.buttons.code')
            ->addColumn('payments','admin.Invoice.buttons.payments')
            ->addColumn('customer','admin.Invoice.buttons.customer')
            ->addColumn('type','admin.Invoice.buttons.type')
            ->addColumn('delete','admin.Invoice.buttons.delete')
            ->rawColumns(['checkbox','payments','delete','edit','type','customer','code'])
            ;
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return mixed
     */
    public function query()
    {
        $query = Invoice::query()->where('customer_id',$this->lead_id)->where('softing_delete','no')->with('customer')->with('type')->with('currency');
        $query->select('invoices.*');
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
            }"
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
                'name' => "invoice_number",
                'data'    => 'code',
                'title'   => trans('orbscope.code'),
                'searchable' => true,
                'orderable'  => true,
                'width'          => '100px',

            ],
            [
                'name' => "customer.name",
                'data'    => 'customer',
                'title'   => trans('orbscope.Customer'),
                'searchable' => true,
                'orderable'  => true,
                'width'          => '150px',
            ],
            [
                'name' => "type.name",
                'data'    => 'type',
                'title'   => trans('orbscope.invoice_type'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => "amount",
                'data'    => 'amount',
                'title'   => trans('orbscope.amount_money'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => "currency.name",
                'data'    => 'currency.name',
                'title'   => trans('orbscope.currency'),
                'searchable' => true,
                'orderable'  => true,
            ],
            [
                'name' => "date",
                'data'    => 'date',
                'title'   => trans('orbscope.date'),
                'searchable' => true,
                'orderable'  => true,
                'width'          => '100px',
            ],
            [
                'name' => 'payments',
                'data' => 'payments',
                'title' => trans('orbscope.payments'),
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
        return 'invoice_' . time();
    }
}