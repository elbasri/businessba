<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 8/27/17
 * Time: 16:45
 */

namespace App\Orbscope\DataTables;
use App\Orbscope\Models\SubCategory;
use Yajra\DataTables\Services\DataTable;

class SubCategoryDataTable extends DataTable
{

    protected $lead_id;

    public function LeadID($id)
    {
        $this->lead_id = $id;
        return $this;
    }
    public function dataTable($query)
    {


        return datatables($query)->setRowId('id')
            ->addColumn('ar_name','admin.sub_category.buttons.name')
            ->addColumn('checkbox','<input type="checkbox" class="selected_data" name="selected_data[]" value="{{ $id }}">')
            ->addColumn('show','admin.sub_category.buttons.show')
            ->addColumn('category','admin.sub_category.buttons.category')
            ->addColumn('edit','admin.sub_category.buttons.edit')
            ->addColumn('delete','admin.sub_category.buttons.delete')
            ->rawColumns(['checkbox','ar_name','category','show','edit', 'delete'])
            ;
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return mixed
     */
    public function query()
    {
        $query = SubCategory::query()->where('cat_id',$this->lead_id)->with('category')->select('sub_categories.*');
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
                    [
                        'text' => '<i class="fa fa-trash"></i> '.trans('orbscope.delete'),
                        'className'    => 'btn btn-danger deleteBtn',
                    ],
                ],
                "scrollX" => true,
                'initComplete' => "function () {
                this.api().columns([1]).every(function () {
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
                ,
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
                'name' => "name",
                'data'    => 'ar_name',
                'title'   => trans('orbscope.'.GetLanguage().'-name'),
                'searchable' => true,
                'width'          => '40%',
                'orderable'  => true,
            ],
            [
                'name' => "category.name",
                'data'    => 'category',
                'title'   => trans('orbscope.category'),
                'searchable' => true,
                'width'          => '40%',
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
        return 'CountriesDataTable_' . time();
    }
}