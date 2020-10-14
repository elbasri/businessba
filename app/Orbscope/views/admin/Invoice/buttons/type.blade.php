@php
    $name = @App\Orbscope\Models\InvoiceType::find($invoice_type)->name;

    if(!empty($name)){
       echo VarByLang($name,GetLanguage());
    }else{
        echo "No type Found";
    }
@endphp
