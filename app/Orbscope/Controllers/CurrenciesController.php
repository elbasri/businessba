<?php

namespace App\Orbscope\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Orbscope\Models\Currency;
use App\Orbscope\DataTables\CurrenciesDataTable;
use Validator;
use App\Orbscope\Controllers\UploadFiles as Upload;
use Logs;
class CurrenciesController extends Controller
{
    protected $status = ['active', 'inactive'];

    public function index(CurrenciesDataTable $dataTable)
    {
        return $dataTable->render('admin.currencies.index',['title' => trans('orbscope.show-all').' '.trans('orbscope.currencies')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.currencies.create',['title'=> trans('orbscope.add').' '.trans('orbscope.currencies')]);
    }

    public function addNewCurerencyForm()
    {
        return view('admin.currencies.newForm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $rules = [
            'name'        => 'required|unique:currencies',

        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'name'  => trans('orbscope.name'),

        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $currency = new Currency();
            $currency->name          = $request->input('name');
            $currency->status        = $request->status;
            $currency->symbol        = $request->symbol;
            $currency->save();

            Logs::SaveLog([
                'action' =>LogAction('add',$request->input('name')),
                'type'   =>'add',
                'table'  =>'currencies',
                'route'  =>LogRoute('currencies'),
                'data'   =>'log.add_record'.' | '.'orbscope.currencies'.' | '.' log.record_number '.' | '.$currency->id ,
            ]);
            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/currencies');
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $currencies = Currency::find($id);
        return view('admin.currencies.edit',['edit'=>$currencies,'title'=>trans('orbscope.edit').' '.trans('orbscope.currencies').' : '.$currencies->name ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $currency = Currency::find($id);

        if (!$currency) {
            return redirect()->back();
        }

        $rules = [

            'name'   => 'required|unique:currencies,name,'.$id,

        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'name'  =>trans('orbscope.name'),

        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $currency = Currency::find($id);


            $currency->name          = $request->input('name');
            $currency->status        = $request->status;
            $currency->symbol        = $request->symbol;
            $currency->save();

            Logs::SaveLog([
                'action' =>LogAction('edit',$currency->id),
                'type'   =>'edit',
                'table'  =>'currencies',
                'route'  =>LogRoute('currencies'),
                'data'   =>'log.add_record'.' | '.'orbscope.currencies'.' | '.' log.record_number '.' | '.$currency->id ,
            ]);
            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/currencies');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $currencies = Currency::find($id);

        if ($currencies) {
            //$currencies->delete();
            $currencies->soft_delete='yes';
            $currencies->save();
        }

        Logs::SaveLog([
            'action' =>LogAction('delete',$currencies->name),
            'type'   =>'delete',
            'table'  =>'currencies',
            'route'  =>LogRoute('currencies'),
            'data'   =>'log.delete_record'.' | '.'orbscope.currencies'.' | '.' log.record_number '.' | '.$currencies->id ,
        ]);
        session()->flash('success', trans('orbscope.deleted-message'));
        return redirect(AdminPath() . '/currencies');
    }


    public function multi_delete(Request $request) {
        $data = $request->input('selected_data');
        if(is_array($data)){
            foreach ($data as $k=>$record){
                $record=InvoiceType::find($record[$k]);
                $record->soft_delete='yes';
                $record->save();
                //$currencies = Currency::find($record);

                Logs::SaveLog([
                    'action' =>LogAction('delete',$record),
                    'type'   =>'delete',
                    'table'  =>'currencies',
                    'route'  =>LogRoute('currencies'),
                    'data'   =>'log.delete_record'.' | '.'orbscope.currencies'.' | '.' log.record_number '.' | '.$record ,
                ]);
            }
            Currency::destroy($data);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/currencies');
        } else {
            $currencies = Currency::find($data);
            $currencies->soft_delete='yes';
            $currencies->save();
            Logs::SaveLog([
                'action' =>LogAction('delete',$data),
                'type'   =>'delete',
                'table'  =>'currencies',
                'route'  =>LogRoute('currencies'),
                'data'   =>'log.delete_record'.' | '.'orbscope.currencies'.' | '.' log.record_number '.' | '.$data ,
            ]);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/currencies');
        }
    }


}
