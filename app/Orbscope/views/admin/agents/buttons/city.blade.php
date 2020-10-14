@php
    $name = @App\Orbscope\Models\City::find($city_id)->name;

    if(!empty($name)){
       echo VarByLang($name,GetLanguage());
    }else{
        echo "No city Found";
    }
@endphp