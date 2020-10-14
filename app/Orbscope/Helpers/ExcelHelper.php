<?php
use Maatwebsite\Excel\Facades\Excel as Excel;

// Get Excel Headers
function GetExcelHeader($file,$delimiter,$encoding,$header)
{
    Config::set('excel.csv.delimiter', $delimiter);
    if($header == 'on'){
        Config::set('excel.import.startRow', '1');
        return Excel::load($file,$encoding)->all()->first()->keys()->toArray();
    }else{
        Config::set('excel.import.startRow', '0');
        return Excel::load($file,$encoding)->all()->first()->toArray();
    }


}

// Get first Row Of Data After Header
function GetExcelFirst($file,$delimiter,$encoding)
{
    Config::set('excel.csv.delimiter', $delimiter);
    $array = Excel::load($file,$encoding)->takeRows(1)->all()->toArray();
    return array_values($array[0]);
}

// Get Excel Data
function GetExcelData($file,$delimiter,$encoding,$header,$duplicate)
{
    Config::set('excel.csv.delimiter', $delimiter);
    if($header == 'on'){
        Config::set('excel.import.startRow', '1');
        $array =  Excel::load($file,$encoding)->all()->toArray();
    }else{
        Config::set('excel.import.startRow', '0');
        $array = Excel::load($file,$encoding)->all()->toArray();
    }


    if($duplicate == 'on'){
        $array = array_map("unserialize", array_unique(array_map("serialize", $array)));
        $data_array = '';
        $moha       = [];
        foreach ($array as $ay){
            $moha[] = array_map("strtolower", $ay);
        }
        if(is_array($moha)){
            $data = array_map("unserialize", array_unique(array_map("serialize", $moha)));
            $data_array = array_values(array_map('array_values', $data));
            return $data_array;
        }else{
            return $data_array;
        }


    }
    return $array = array_values(array_map('array_values', $array));
}






