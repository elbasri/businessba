@php
    $name = @App\Orbscope\Models\Category::find($cat_id)->name;

    if(!empty($name)){
       echo VarByLang($name,GetLanguage());
    }else{
        echo "No shop Found";
    }
@endphp
