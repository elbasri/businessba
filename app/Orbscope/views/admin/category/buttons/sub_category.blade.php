@php
    $name = @App\Orbscope\Models\SubCategory::find($subcat_id)->name;

    if(!empty($name)){
       echo VarByLang($name,GetLanguage());
    }else{
        echo "No shop Found";
    }
@endphp
