@php
    $name = @App\Orbscope\Models\Employee::find($employee_id)->name;

    if(!empty($name)){
       echo VarByLang($name,GetLanguage());
    }else{
        echo "No employee Found";
    }
@endphp
