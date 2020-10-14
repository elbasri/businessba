<?php

namespace App\Orbscope\Controllers;

use App\Orbscope\Models\Diploma;
use Validator;
use Illuminate\Http\Request;
use App\Orbscope\DataTables\ContactsDataTable;
use Logs;
use Illuminate\Http\File;
use App\Orbscope\Controllers\UploadFiles as Upload;
use Session;
use App\Orbscope\Models\Contact;
use App\Orbscope\Models\Branch;
use App\Orbscope\Models\Job;
use App\Authorizable;
class ContactsController extends Controller
{



    use Authorizable;

    public function index(ContactsDataTable $dataTable)
    {
        return $dataTable->render('admin.contacts.index', [
            'title' => trans('orbscope.show-all').' '.trans('orbscope.contacts')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($corporate_id = null)
    {
        $jobs = Job::all();
        $send = [
            'title'     => trans('orbscope.add').' '.trans('orbscope.contacts'),
            'jobs' => $jobs,
        ];

        return view('admin.contacts.create', $send);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name'                 => 'required|string',
            'phone'                => 'sometimes|nullable|numeric',
            'mobile'               => 'required|numeric',
            'email'                => 'sometimes|nullable|email',
            'birth_date'           => 'sometimes|nullable|date',
            'job_id'               => 'sometimes|nullable|numeric',
        ];

        if (isset($request->branch_id)) {
            if (!Branch::find($request->branch_id)) {
                return back()->withInput()->withErrors(['branch_id' => trans('orbscope.branch_error')]);
            }
        }

        $validator = Validator::make($request->all(), $rules);
        $validator->SetAttributeNames([
            'name'          => trans('orbscope.name'),
            'phone'         => trans('orbscope.phone'),
            'mobile'        => trans('orbscope.mobile'),
            'address'       => trans('orbscope.birth_date'),
            'email'         => trans('orbscope.email'),
            'birth_date'    => trans('orbscope.birth_date'),
            'job_id'        => trans('orbscope.jop'),
            'job_title'     => trans('orbscope.job_title'),
        ]);

        // dd($request->all());

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $contact = new Contact();
            $contact->name         = $request->name;
            $contact->phone        = $request->phone;
            $contact->mobile       = $request->mobile;
            $contact->address      = $request->address;
            $contact->email        = $request->email;
            $contact->birth_date   = $request->birth_date;
            $contact->job_id       = $request->job_id;
            $contact->job_title    = $request->job_title;
            if (isset($request->branch_id)) {
                $contact->branch_id    = $request->branch_id;
            }else {
                $contact->branch_id    = null;
            }

            $contact->save();

            Logs::SaveLog(
                [
                    'action' => LogAction('add',$contact->id),
                    'type'   => 'add',
                    'table'  => 'contacts',
                    'route'  => LogRoute('contacts'),
                    'data'   =>
                    ' log.add_record'.' | '.'orbscope.contacts'.' | '.' log.record_number '.' | '.$contact->id ,
                ]
            );
        }
        session()->flash('success',trans('orbscope.success'));
        return redirect(AdminPath().'/contacts/' . $contact->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $contact        = Contact::find($id);
        return view('admin.contacts.show',[
            'contact'   => $contact,
            'title'     => trans('orbscope.show').' '.trans('orbscope.contact')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact      = Contact::find($id);
        $jobs           = Job::all();

        return view('admin.contacts.edit', [
            'edit' => $contact,
            'jobs' => $jobs,
            'title'   => trans('orbscope.edit') .' '. trans('orbscope.contact').' : '. $contact->name
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name'                 => 'required|string',
            'phone'                => 'sometimes|nullable|numeric',
            'mobile'               => 'required|numeric',
            'email'                => 'sometimes|nullable|email',
            'birth_date'           => 'sometimes|nullable|date',
            'job_id'               => 'sometimes|nullable|numeric',
        ];

        if (isset($request->branch_id)) {
            if (!Branch::find($request->branch_id)) {
                return back()->withInput()->withErrors(['branch_id' => trans('orbscope.branch_error')]);
            }
        }

        $validator = Validator::make($request->all(), $rules);
        $validator->SetAttributeNames([
            'name'          => trans('orbscope.name'),
            'phone'         => trans('orbscope.phone'),
            'mobile'        => trans('orbscope.mobile'),
            'address'       => trans('orbscope.birth_date'),
            'email'         => trans('orbscope.email'),
            'birth_date'    => trans('orbscope.birth_date'),
            'job_id'        => trans('orbscope.jop'),
            'job_title'     => trans('orbscope.job_title'),
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $contact = Contact::find($id);

            $name = [
                'ar' => $request->input('ar_name'),
                'en' => $request->input('en_name')
            ];

            $names = EncodeVar($name);

            $contact->name             = $names;
            $contact->name         = $request->name;
            $contact->phone        = $request->phone;
            $contact->mobile       = $request->mobile;
            $contact->address      = $request->address;
            $contact->email        = $request->email;
            $contact->birth_date   = $request->birth_date;
            $contact->job_id       = $request->job_id;
            $contact->job_title    = $request->job_title;
            if (isset($request->branch_id)) {
                $contact->branch_id    = $request->branch_id;
            }else {
                $contact->branch_id    = null;
            }

            $contact->save();

            Logs::SaveLog([
                'action' => LogAction('edit', $contact->id),
                'type'   => 'edit',
                'table'  => 'contacts',
                'route'  => LogRoute('contacts'),
                'data'   => ' log.edit_record'.' | '.'orbscope.contacts'.' | '.' log.record_number '.' | '.$contact->id ,
            ]);

            session()->flash('success',trans('orbscope.success'));
            return redirect(AdminPath().'/contacts/'.$id);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);
        $contact->delete();
        Logs::SaveLog([
            'action' => LogAction('delete', $contact->id),
            'type'   => 'delete',
            'table'  => 'contacts',
            'route'  => LogRoute('contacts'),
            'data'   => 'log.delete_record'.' | '.'orbscope.contacts'.' | '.' log.record_number '.' | '.$contact->id ,
        ]);
        session()->flash('success', trans('orbscope.deleted-message'));
        return redirect(AdminPath() . '/contacts');
    }


    public function multi_delete(Request $request)
    {
        $data = $request->input('selected_data');
        if(is_array($data)){

            foreach ($data as $record){
                $contacts = Contact::find($record);
                Logs::SaveLog([
                    'action' => LogAction('delete',$record),
                    'type'   => 'delete',
                    'table'  => 'contacts',
                    'route'  => LogRoute('contacts'),
                    'data'   => 'log.delete_record'.' | '.'orbscope.contacts'.' | '.' log.record_number '.' | '.$record ,
                ]);
            }
            Contact::destroy($data);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/contacts');
        }
        else {
            $contacts = Contact::find($data);
            $contacts->delete();
            Logs::SaveLog([
                'action' => LogAction('delete',$data),
                'type'   => 'delete',
                'table'  => 'contacts',
                'route'  => LogRoute('contacts'),
                'data'   => 'log.delete_record'.' | '.'orbscope.contacts'.' | '.' log.record_number '.' | '.$data ,
            ]);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/contacts');
        }
    }




    public function getBranches()
    {
        return view('admin.contacts.buttons.branches', [
            'branches' => Branch::all(),
        ]);
    }


    /**
     * Upload Excel File
     */
    public function upload()
    {
        return view('admin.contacts.upload',[
            'title'=> trans('orbscope.upload-file').' : '.trans('orbscope.contacts')
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * Select Options
     */
    public function upload_data(Request $request)
    {

        if($request->hasFile('import_file')){
            $path       = $request->file('import_file');
            $header     = $request->input('has_header');
            $encoding   = $request->input('encoding');
            $duplicate  = $request->input('duplicate_record');
            $delimiter  = $request->input('delimiter');

            // Check CSV Extention
            if(!checkFiles($path->getClientOriginalName())){
                session()->flash('error',trans('orbscope.select_file') ." " .trans('orbscope.type_csv'));
                return redirect()->back();
            }

            // Delimiter Value
            if(empty($delimiter)){
                $delimiter = ',';
            }else{
                $delimiter  = $request->input('delimiter');
            }


            // Get CSV Data
            $getData  = GetExcelData($path, $delimiter, $encoding, $header, $duplicate);


            // Check If File Have Data (With and Without Header)
            if(count($getData) > 0){
                $headers  = GetExcelHeader($path,$delimiter,$encoding,$header);
                $rows     = GetExcelFirst($path,$delimiter,$encoding);
                session()->forget('data');
                $fileData = Session::put('data', $getData);
                return view('admin.contacts.upload_data',[
                    'headers'           => $headers,
                    'has_header'        => $header,
                    'row'               => $rows,
                    'data'              => $fileData,
                    'title' => trans('orbscope.upload-file').' : '.trans('orbscope.contacts')
                ]);
            }else{
                return back()->with('error',trans('orbscope.nothing_data'));
            }
        }else{
            return back()->with('error',trans('orbscope.select-file-error'));
        }
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save_excel(Request $request)
    {

    }

}
