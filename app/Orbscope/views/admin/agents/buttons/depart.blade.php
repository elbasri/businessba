@php
    $name = @App\Orbscope\Models\Department::find($depart_id)->name;

    if(!empty($name)){
       echo VarByLang($name,GetLanguage());
    }else{
        echo "No depart_id Found";
    }
@endphp