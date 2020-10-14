<?php

namespace App\Orbscope\Controllers;

use App\Orbscope\Models\Branch;
use App\Orbscope\Models\BranchHistoric;
use App\Orbscope\Models\City;
use App\Orbscope\Models\Depart_Historic;
use App\Orbscope\Models\Department;
use App\Orbscope\Models\Employee;
use App\Orbscope\Models\Position;
use App\Orbscope\Models\PostionHistoric;
use App\Orbscope\Models\Salary;
use App\Orbscope\Models\Stay;
use App\Orbscope\Models\Subtract;
use App\Orbscope\Models\Vacation;
use App\User;
use Carbon\Carbon;
use ParagonIE\Sodium\Core\Poly1305\State;
use PDF;
use Validator;
use Illuminate\Http\Request;
use App\Orbscope\DataTables\AgentsDataTable;
use Logs;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use File;
use Intervention\Image\ImageManager;
use App\Orbscope\Controllers\UploadFiles as Upload;
use Session;
use App\Authorizable;

class AgentsController extends Controller
{
    use Authorizable;
    /**
     * @param AgentsDataTable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(AgentsDataTable $dataTable)
    {
        return $dataTable->render('admin.agents.index',['title' => trans('orbscope.show-all').' '.trans('orbscope.agents')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $roles = Role::get();
        $depart=Department::where('status','active')->get();
        $city=City::where('status','active')->get();
        $branch=Branch::where('status','active')->get();
        $position=Position::where('status','active')->get();
        return view('admin.agents.create',compact('city','position','depart','branch'),['title'=> trans('orbscope.add').' '.trans('orbscope.agents'), 'roles' => $roles]);
    }


    public function salarys(){
        //$sub=Subtract::whereYear('date', Carbon::now()->year) ->whereMonth('date', Carbon::now()->month)->get();

       // dd($sub);
         $depart=Department::where('status','active')->get();
         $branch=Branch::where('status','active')->get();
        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $agents=Employee::where('status','active')->get();

        return view('admin.salarys.index',compact('agents','year','month','branch','depart'),['title'=>trans('orbscope.salarys')]);
    }

    public function branch_historical($id){
      $agent=Employee::find($id);
        $branchs=Branch::where('status','active')->get();
     return view('admin.agents.branch_historical',compact('agent','branchs'),['title'=>trans('orbscope.branch_historical').' '.VarByLang($agent->name,GetLanguage())]);
    }

    public function vacations($id){
        $agent=Employee::find($id);
        return view('admin.agents.vacations',compact('agent'),['title'=>trans('orbscope.vacations').' '.VarByLang($agent->name,GetLanguage())]);
    }

    public function stay($id){
        $agent=Employee::find($id);
        return view('admin.agents.stay',compact('agent'),['title'=>trans('orbscope.stay').' '.VarByLang($agent->name,GetLanguage())]);
    }

    public function depart_historical($id){
        $agent=Employee::find($id);
        $branchs=Department::where('status','active')->get();
        return view('admin.agents.depart_historical',compact('agent','branchs'),['title'=>trans('orbscope.depart_historical').' '.VarByLang($agent->name,GetLanguage())]);
    }


    public function branch_uplode(Request $request){

        foreach ($request->uplode_id as $k=>$v){
            $bhistoric =BranchHistoric::find($request->uplode_id[$k]);
            $bhistoric->branch_id =$request->branch_id[$k];
            $bhistoric->date =$request->date[$k];
            $bhistoric->save();

        }
        session()->flash('success',trans('orbscope.success'));
        return redirect()->back();

    }

    public function add_vications(Request $request,$id){
        $rules = [
            'total_hours'         => 'required',
            'start_date'     => 'required',
            'end_date'     => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'total_hours'       =>trans('orbscope.total_hours'),
            'start_date'      =>trans('orbscope.start_date'),
            'end_date'      =>trans('orbscope.end_date'),

        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $bhistoric=new  Vacation();
        $bhistoric->employee_id =$id;
        $bhistoric->totla_hours =$request->total_hours;
        $bhistoric->start_date =$request->start_date;
        $bhistoric->end_date =$request->end_date;
        $bhistoric->save();

        session()->flash('success',trans('orbscope.success'));
        return redirect()->back();

    }
    public function add_stay(Request $request,$id){
        $rules = [
            'return'         => 'required',
            'stay'     => 'required',
            'date'     => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'return'       =>trans('orbscope.return'),
            'stay'      =>trans('orbscope.stay'),
            'date'      =>trans('orbscope.date'),

        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $bhistoric=new  Stay();
        $bhistoric->employee_id =$id;
        $bhistoric->return =$request->return;
        $bhistoric->stay =$request->stay;
        $bhistoric->date =$request->date;
        $bhistoric->save();

        session()->flash('success',trans('orbscope.success'));
        return redirect()->back();

    }

    public function depart_historical_update(Request $request){

        foreach ($request->uplode_id as $k=>$v){
            $bhistoric =Depart_Historic::find($request->uplode_id[$k]);
            $bhistoric->depart_id =$request->depart_id[$k];
            $bhistoric->date =$request->date[$k];
            $bhistoric->save();

        }
        session()->flash('success',trans('orbscope.success'));
        return redirect()->back();

    }

    public function position_uplode(Request $request){

        foreach ($request->uplode_id as $k=>$v){
            $bhistoric =PostionHistoric::find($request->uplode_id[$k]);
            $bhistoric->position_id =$request->position_id[$k];
            $bhistoric->date =$request->date[$k];
            $bhistoric->save();

        }
        session()->flash('success',trans('orbscope.success'));
        return redirect()->back();
    }

    public function update_vacations(Request $request){
        foreach ($request->vacation_id as $k=>$v){
            $salary =Vacation::find($request->vacation_id[$k]);
            $salary->totla_hours =$request->total_hours[$k];
            $salary->start_date =$request->start_date[$k];
            $salary->end_date =$request->end_date[$k];
            if(isset($request->status[$k])){
                $salary->status ='active';
            }else{
                $salary->status ='inactive';
            }
            $salary->save();

        }
        session()->flash('success',trans('orbscope.success'));
        return redirect()->back();
    }

    public function update_stay(Request $request){
        foreach ($request->stay_id as $k=>$v){
            $salary =Stay::find($request->stay_id[$k]);
            $salary->return =$request->return[$k];
            $salary->stay =$request->stay[$k];
            $salary->date =$request->date[$k];
            if(isset($request->status[$k])){
                $salary->status ='active';
            }else{
                $salary->status ='inactive';
            }
            $salary->save();

        }
        session()->flash('success',trans('orbscope.success'));
        return redirect()->back();
    }

    public function add_files(Request $request,$id){

    $agent=Employee::find($id);

    $oldImages = $request->input('oldpdf');
    if ($request->has('oldpdf')) {
        $deletedImages = array_diff(explode('|',$agent->files),$oldImages);
    }else{
        $deletedImages = explode('|',$agent->files);
    }
    if (is_array($deletedImages)) {
        foreach ($deletedImages as $img) {
            @unlink('uploads/'.$img);
        }
    }
    if($request->hasFile('pdfs')){
        $pdfs = $request->file('pdfs');
        foreach ($pdfs as $img){
            $uploadedImages[]     = Upload::uploadImages('employees', $img,'allowExtFiles','false');
        }
    }else{
        $uploadedImages = [];
    }
    if (is_array($oldImages)) {
        $allImages = array_merge($uploadedImages,$oldImages);
    }else{
        $allImages = $uploadedImages;
    }
    $project_imgs = implode('|', $allImages);
    if($uploadedImages == 'false'){
        return back()->withInput();
    }else{
        $agent->files       = $project_imgs;
    }
    $agent->save();
    session()->flash('success',trans('orbscope.success'));
    return redirect()->back();
}

    public function addBH_historical(Request $request,$id){

        $rules = [
            'date'         => 'required',
            'branch_id'     => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'date'       =>trans('orbscope.date'),
            'position_id'      =>trans('orbscope.branch'),

        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $bhistoric=new  BranchHistoric();

        $bhistoric->employee_id =$id;
        $bhistoric->branch_id =$request->branch_id;
        $bhistoric->date =$request->date;
        $bhistoric->save();

        $employe=Employee::find($id);
        $employe->branch_id =$request->branch_id;
        $employe->save();

        session()->flash('success',trans('orbscope.success'));
        return redirect()->back();
    }

    public function addPostion_historical(Request $request,$id)
    {
        $rules = [
            'date'         => 'required',
            'position_id'     => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'date'       =>trans('orbscope.date'),
            'position_id'      =>trans('orbscope.postion'),

        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $bhistoric=new  PostionHistoric();

        $bhistoric->employee_id =$id;
        $bhistoric->position_id =$request->position_id;
        $bhistoric->date =$request->date;
        $bhistoric->save();

        $employe=Employee::find($id);
        $employe->postion_id =$request->position_id;
        $employe->save();

        session()->flash('success',trans('orbscope.success'));
        return redirect()->back();
    }

    public function add_depart_historic(Request $request,$id){
        $rules = [
            'date'         => 'required',
            'depart_id'     => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        $validator->SetAttributeNames([
            'date'       =>trans('orbscope.date'),
            'depart_id'      =>trans('orbscope.postion'),

        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }


        $bhistoric=new  Depart_Historic();

        $bhistoric->employee_id =$id;
        $bhistoric->depart_id =$request->depart_id;
        $bhistoric->date =$request->date;
        $bhistoric->save();

        $employe=Employee::find($id);
        $employe->depart_id =$request->depart_id;
        $employe->save();

        session()->flash('success',trans('orbscope.success'));
        return redirect()->back();
    }
    public function postion_historical($id){
        $agent=Employee::find($id);
        $postions=Position::where('status','active')->get();
        return view('admin.agents.postion_historic',compact('agent','postions'),['title'=>trans('orbscope.postion_historical').' '.     VarByLang($agent->name,GetLanguage())]);
    }

    public function depart_branch(Request $request){
        $depart=Department::where('status','active')->get();
        $branch=Branch::where('status','active')->get();
        $agents =Employee::query()->where(function($q){
            if(request()->has('branch_id') && request('branch_id') != null)
            {
                return $q->where('employees.branch_id',request()->input('branch_id'));
            }})
            ->where(function($q){
                if(request()->has('depart_id') && request('depart_id') != null){
                    return $q->where('employees.depart_id',request()->input('depart_id'));
                }})
            ->get();
        $year=Carbon::now()->year;
        $month=Carbon::now()->month;
        return view('admin.salarys.index',compact('agents','year','month','branch','depart'),['title'=>trans('orbscope.salarys')]);

    }

    public function date_salarys(Request $request){
        $depart=Department::where('status','active')->get();
        $branch=Branch::where('status','active')->get();
        $salarys=Salary::whereBetween('salaries.date',[request()->get('from_date'),request()->get('to_date')])->get();
        return view('admin.salarys.index_date',compact('salarys','branch','depart'),['title'=>trans('orbscope.salarys')]);

    }

    public function get_pdf($id,$year,$month){
        //dd($id,$year,$moth);
        $agent=Employee::find($id);
        $pdf = PDF::loadView('pdf',compact('month','year','agent'));
       // return view('pdf',compact('month','year','agent'));


        return $pdf->download('salary.pdf');
    }



    public function get_salary($id){


        $salary=Salary::where('employee_id',$id)->orderBy('date','desc')->get();
        $emloye=Employee::find($id);
        return view('admin.salarys.single',compact('salary','emloye'),['title'=>trans('orbscope.salary').' '.VarByLang($emloye->name,GetLanguage())]);


    }

    public function subtract($id){


        $sub=Subtract::where('employee_id',$id)->orderBy('date','desc')->get();
        $emloye=Employee::find($id);
        return view('admin.salarys.subtract',compact('sub','emloye'),['title'=>trans('orbscope.subtract_added').' '.VarByLang($emloye->name,GetLanguage())]);


    }

    public function update_salary(Request $request){

        foreach ($request->salary_id as $k=>$v){
            $salary =Salary::find($request->salary_id[$k]);
            $salary->date =$request->date[$k];
            $salary->id_office =$request->officer_id[$k];
            $salary->salary =$request->salary[$k];
            $salary->note =$request->note[$k];
            if(isset($request->status[$k])){
                $salary->status ='active';
            }else{
                $salary->status ='inactive';
            }
            $salary->save();

        }
        session()->flash('success',trans('orbscope.success'));
        return redirect()->back();
    }

    public function update_subtract(Request $request){

        foreach ($request->sub_id as $k=>$v){
            $salary =Subtract::find($request->sub_id[$k]);
            $salary->name =$request->name[$k];
            $salary->date =$request->date[$k];
            $salary->amount =$request->salary[$k];
            if(isset($request->subtract[$k])){
                $salary->type ='sub';
            }else{
                $salary->type ='reward';
            }
            $salary->note =$request->note[$k];
            $salary->save();

        }
        session()->flash('success',trans('orbscope.success'));
        return redirect()->back();
    }

    public function add_salary($id,Request $request){

       //$date= \Carbon\Carbon::parse($request->date)->format('Y-m-d H:i:s');
        $salary=new Salary();
        $salary->employee_id =$id;
        $salary->date =$request->date;
        $salary->salary =$request->salary;
        $salary->id_office =$request->officer_id;
        $salary->note =$request->note;
        $salary->save();
        session()->flash('success',trans('orbscope.success'));
        return redirect()->back();

    }

    public function add_subtract($id,Request $request){

        //$date= \Carbon\Carbon::parse($request->date)->format('Y-m-d H:i:s');
        $salary=new Subtract();
        $salary->employee_id =$id;
        $salary->name =$request->name;
        $salary->date =$request->date;
        $salary->amount =$request->salary;
        if(isset($request->subtract)){
            $salary->type ='sub';
        }else{
            $salary->type ='reward';
        }
        $salary->note =$request->note;
        $salary->save();
        session()->flash('success',trans('orbscope.success'));
        return redirect()->back();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->password==null  && $request->email==null){
           $rules = [
               'ar_name'    => 'required',
               'en_name'    => 'required',
               'branch'     => 'required',
               'start_date'        => 'required',
               'position_id'        => 'required',
           ];
           $validator = Validator::make($request->all(),$rules);
           $validator->SetAttributeNames([
               'ar_name'  =>trans('orbscope.ar-name'),
               'en_name'  =>trans('orbscope.en-name'),
               'branch'      =>trans('orbscope.branch'),
               'start_date'   =>trans('orbscope.start_date'),
               'position_id'   =>trans('orbscope.postion'),
           ]);
       }else{
           $rules = [
               'ar_name'    => 'required',
               'en_name'    => 'required',
               'branch'     => 'required',
               'start_date'        => 'required',
               'email'        => 'required|unique:users',
               'password'        => 'required',
               'roles'        => 'required',
           ];
           $validator = Validator::make($request->all(),$rules);
           $validator->SetAttributeNames([
               'ar_name'  =>trans('orbscope.ar-name'),
               'en_name'  =>trans('orbscope.en-name'),
               'branch'      =>trans('orbscope.branch'),
               'start_date'   =>trans('orbscope.start_date'),
           ]);

       }
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $agents                 = new Employee();
            $name = array('ar'=>$request->input('ar_name'),'en'=>$request->input('en_name'));
            $names = json_encode($name);
            $agents->name           = $names;
            $agents->address           = $request->input('address');
            $agents->work_mobile           = $request->input('work_mobile');
            $agents->postion_id           = $request->input('position_id');
            $agents->personal_mobile           = $request->input('personal_mobile');
            $agents->code           = $request->input('code');
            $agents->depart_id           = $request->input('department');
            $agents->start_date           = $request->input('start_date');
            $agents->end_date           = $request->input('end_date');
            $agents->email          = $request->input('user_email');
            $agents->city_id          = $request->input('city');
            $agents->birth_date          = $request->input('birth_date');
            $agents->branch_id          = $request->input('branch');
            $agents->notes          = $request->input('notes');
            $files                      = $request->file('pdf');
            if(!empty($files ) && $files != ''){
                foreach ($files as $img){
                    $uploadedImages[]     = Upload::uploadImages('employees', $img,'allowExtFiles','false');
                }
                if($uploadedImages == 'false'){
                    return back()->withInput();
                }else{
                    $tcl = implode('|', $uploadedImages);
                    $agents->files       = $tcl;
                }
            }
            $agents->save();

            $postion=new PostionHistoric();
            $postion->employee_id =$agents->id;
            $postion->position_id =$request->position_id;
            $postion->date =$request->postion_date;
            $postion->save();

            $branch=new BranchHistoric();
            $branch->employee_id =$agents->id;
            $branch->branch_id =$request->input('branch');
            $branch->date =$request->branch_date;
            $branch->save();

            $branch=new Depart_Historic();
            $branch->employee_id =$agents->id;
            $branch->depart_id =$request->input('department');
            $branch->date =$request->depart_date;
            $branch->save();

            //depart_date

            if ($request->password !=null &&!empty($request->roles) && $request->email !=null){


                $user =new User();
                $user->name          =$request->en_name;
                $user->email          =$request->email;
                $user->password       = bcrypt($request->input('password'));
                $user->type           = 'agent';
                $roles = $request['roles']; //Retrieving the roles field
                //Checking if a role was selected
                if (isset($roles)) {
                    foreach ($roles as $role) {
                        $role_r = Role::where('id', '=', $role)->firstOrFail();
                        $user->assignRole($role_r); //Assigning role to user
                    }
                }

                $user->save();


            }


            Logs::SaveLog(
                [
                    'action' =>LogAction('add',$request->input('ar_name'),$request->input('en_name')),
                    'type'   =>'add',
                    'table'  =>'agents',
                    'route'  =>LogRoute('agents'),
                    'data'   =>'log.add_record'.' | '.'orbscope.agents'.' | '.' log.record_number '.' | '.$agents->id ,
                ]
            );
            session()->flash('success',trans('orbscope.success'));

            return redirect(AdminPath().'/agents');
        }
    }

    public function emloyee_status($id,$status){
        $user=Employee::find($id);
        $user->status=$status;
        $user->save();
        session()->flash('success',trans('orbscope.success'));
        return redirect()->back();

    }

    public function files($id){


        $show=Employee::find($id);

        return view('admin.agents.show',compact('show'),['title'=>trans('orbscope.files').' '.VarByLang($show->name,GetLanguage())]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $agent = Employee::find($id);

        if ($agent) {
            $depart=Department::where('status','active')->get();
            $position=Position::where('status','active')->get();
            $city=City::where('status','active')->get();
            $branch=Branch::where('status','active')->get();
            return view('admin.agents.edit',compact('depart','position','city','branch'),[
                'title'=> trans('orbscope.edit').' '.trans('orbscope.agent'),
                'edit' => $agent,

            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $agents = Employee::find($id);
        if ($agents) {
            $rules = [
                'ar_name'    => 'required',
                'en_name'    => 'required',
                'start_date'        => 'required'
            ];
            $validator = Validator::make($request->all(),$rules);
            $validator->SetAttributeNames([
                'ar_name'  =>trans('orbscope.ar-name'),
                'en_name'  =>trans('orbscope.en-name'),
                'start_date'   =>trans('orbscope.start_date'),
            ]);
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator);
            }
            $name = array('ar'=>$request->input('ar_name'),'en'=>$request->input('en_name'));
            $names = json_encode($name);
            $agents->name           = $names;
            $agents->address           = $request->input('address');
            $agents->work_mobile           = $request->input('work_mobile');
            $agents->personal_mobile           = $request->input('personal_mobile');
            $agents->code           = $request->input('code');
            $agents->postion_id           = $request->input('position_id');
            $agents->depart_id           = $request->input('department');
            $agents->start_date           = $request->input('start_date');
            $agents->end_date           = $request->input('end_date');
            $agents->email          = $request->input('email');
            $agents->city_id          = $request->input('city');
            $agents->birth_date          = $request->input('birth_date');
            $agents->notes          = $request->input('notes');
            $agents->save();



            Logs::SaveLog([
                'action' =>LogAction('edit',$request->input('ar_name'),$request->input('en_name')),
                'type'   =>'edit',
                'table'  =>'agents',
                'route'  =>LogRoute('agents'),
                'data'   =>'log.add_record'.' | '.'orbscope.agents'.' | '.' log.record_number '.' | '.$agents->id ,
            ]);
            session()->flash('success',trans('orbscope.success'));
            return redirect()->back();

        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $agents = Employee::find($id);
        $agents->soft_delete ='yes';
        $agents->save();
        Logs::SaveLog([
            'action' =>LogAction('delete',VarByLang($agents->name,GetLanguage())),
            'type'   =>'delete',
            'table'  =>'agents',
            'record_id'  =>$agents->id,
            'route'  =>LogRoute('agents'),
            'data'   =>'log.delete_record'.' | '.'orbscope.agents'.' | '.' log.record_number '.' | '.$agents->id ,
        ]);
        session()->flash('success', trans('orbscope.deleted-message'));
        return redirect(AdminPath() . '/agents');
    }

    public function salary_files($id){
        $show=Employee::find($id);
        $title=trans('orbscope.files').' '.trans('orbscope.salary').' '.VarByLang($show->name,GetLanguage());
        return view('admin.salarys.files',compact('show','title'));

    }


    public function multi_delete(Request $request) {
        $data = $request->input('selected_data');
        if(is_array($data)){

            foreach ($data as $record){
                $record->soft_delete='yes';
                $record->save();
                Logs::SaveLog([
                    'action' =>LogAction('delete',$record),
                    'type'   =>'delete',
                    'table'  =>'agents',
                    'route'  =>LogRoute('agents'),
                    'data'   =>'log.delete_record'.' | '.'orbscope.agents'.' | '.' log.record_number '.' | '.$record ,
                ]);
            }
            //Employee::destroy($data);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/agents');
        }
        else {
            $agents = Employee::find($data);
            $agents->soft_delete ='yes';
            $agents->save();
            //$agents->delete();
            Logs::SaveLog([
                'action' =>LogAction('delete',$data),
                'type'   =>'delete',
                'table'  =>'agents',
                'route'  =>LogRoute('agents'),
                'data'   =>'log.delete_record'.' | '.'orbscope.agents'.' | '.' log.record_number '.' | '.$data ,
            ]);
            session()->flash('success', trans('orbscope.deleted-message'));
            return redirect(AdminPath() . '/agents');
        }
    }

    public function add_salary_files(Request $request,$id){

        $agent=Employee::find($id);

        $oldImages = $request->input('oldpdf');
        if ($request->has('oldpdf')) {
            $deletedImages = array_diff(explode('|',$agent->salary_files),$oldImages);
        }else{
            $deletedImages = explode('|',$agent->salary_files);
        }
        if (is_array($deletedImages)) {
            foreach ($deletedImages as $img) {
                @unlink('uploads/'.$img);
            }
        }
        if($request->hasFile('pdfs')){
            $pdfs = $request->file('pdfs');
            foreach ($pdfs as $img){
                $uploadedImages[]     = Upload::uploadImages('salary', $img,'allowExtFiles','false');
            }
        }else{
            $uploadedImages = [];
        }
        if (is_array($oldImages)) {
            $allImages = array_merge($uploadedImages,$oldImages);
        }else{
            $allImages = $uploadedImages;
        }
        $project_imgs = implode('|', $allImages);
        if($uploadedImages == 'false'){
            return back()->withInput();
        }else{
            $agent->salary_files       = $project_imgs;
        }
        $agent->save();
        session()->flash('success',trans('orbscope.success'));
        return redirect()->back();
    }

    public function download($id){
        $file_path = public_path('uploads').'/employees/'.$id;
        return response()->download($file_path);
    }

    public function download_salary($id){
        $file_path = public_path('uploads').'/salary/'.$id;
        return response()->download($file_path);
    }



    // start sections

}
