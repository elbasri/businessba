@php
    $name = @App\Orbscope\Models\Customer::find($customer_id)->name;

    if(!empty($name)){
       echo VarByLang($name,GetLanguage());
    }else{
        echo "No customer Found";
    }
@endphp
