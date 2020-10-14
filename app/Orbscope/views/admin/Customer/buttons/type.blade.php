@php
    $name = @App\Orbscope\Models\CustomerType::find($type_id)->name;

    if(!empty($name)){
       echo VarByLang($name,GetLanguage());
    }else{
        echo "No type Found";
    }
@endphp