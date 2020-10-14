@php
    $name = @App\Orbscope\Models\Position::find($postion_id)->name;

    if(!empty($name)){
       echo VarByLang($name,GetLanguage());
    }else{
        echo "No poisition Found";
    }
@endphp