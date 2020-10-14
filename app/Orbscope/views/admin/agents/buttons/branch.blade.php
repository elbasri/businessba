@php
        $name = @App\Orbscope\Models\Branch::find($branch_id)->name;

    if(!empty($name)){
       echo VarByLang($name,GetLanguage());
    }else{
        echo "No branch Found";
    }
@endphp