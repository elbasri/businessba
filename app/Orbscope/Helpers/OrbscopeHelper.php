<?php
    use App\Orbscope\Controllers\SettingsController;
    use App\Orbscope\Controllers\LogsController as Log;
    use Illuminate\Support\Facades\Lang;

    // Get Website Settings
    function GetSettings()
    {
        // New Object From Setting Controller
        $settingsController = new SettingsController;
        //Get Setting
        $settings = $settingsController->GetSetting();
        return $settings;
    }

    // Return Data By Language
    function SettingsByLang($var, $lang)
    {
        $data = json_decode(GetSettings()->$var)->$lang;
        return $data;
    }

    // Get Language
    function GetLanguage()
    {
        // New Object From Setting Controller
        $languageValue = new SettingsController;

        //Get Current Language
        $language = $languageValue->GetLanguage();
        return $language;

    }

    // Get Language Direction
    function GetDirection()
    {
        if(GetLanguage() == 'ar')
        {
            $dir = 'rtl';
        }
        else
        {
            $dir = 'ltr';
        }
        return $dir;
    }

    // Get Language adds style
    function GetLangAdds()
    {
        if(GetLanguage() == 'ar')
        {
            $adds = '-rtl';
        }
        else
        {
            $adds = '';
        }
        return $adds;
    }

    function month_ar($month){

        if ($month=='1'){

            return'كانون الثاني';
        }elseif ($month=='2'){

            return'شباط';
        }elseif ($month=='3'){
            return 'آذار';
        }elseif ($month=='4'){
            return 'نيسان';
        }elseif ($month=='5'){
            return 'أيار';
        }elseif ($month=='6'){
            return 'حزيران';
        }elseif ($month=='7'){
            return 'تموز';
        }elseif ($month=='8'){
            return 'آب';
        }elseif ($month=='9'){
            return 'أيلول';
        }elseif ($month=='10'){
            return 'تشرين الأول';
        }elseif ($month=='11'){
            return 'تشرين الثاني';
        }elseif ($month=='12'){
            return 'كانون الأول';
        }else{
            return $month;
        }


    }

    // Get Images Path
    function GetImage($val=null)
    {
        if(!empty($val) and file_exists(base_path('uploads/'.$val)))
        {
            return url('uploads/'.$val);
        }else{
            return url(url('/').'/orbscope/orbscope.png');
        }
    }

    // Get Images Path
    function ShowImage($val=null)
    {
        if(!empty($val) and file_exists(base_path('public/uploads/'.$val)))
        {
            return url('uploads/'.$val);
        }else{
            return url(url('/').'/orbscope/orbscope.png');
        }
    }

    // Get Admin Path
    function AdminPath()
    {
        // New Object From Setting Controller
        $settingsController = new SettingsController;
        //Get Setting
        $AdminPath = $settingsController->GetSetting()->admin_path;
        return $AdminPath;
    }

    // Return Variable By Language
    function VarByLang($var, $lang)
    {
        if(!empty($var) && $var != ''){
            $data = json_decode($var)->$lang;
        }else{
            $data = '';
        }
        return $data;
    }

    // Get Active Admin Link
    function ActiveAdminLink($name)
    {
        return Active::checkRoute($name);
    }

    // Get Active Admin Menu
    function ActiveAdminMenu($name)
    {
        return Active::check(AdminUrl($name),true);
    }

    // Json Encoding Variable
    function EncodeVar($var)
    {
        return json_encode($var,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    }

    // Replace Array Keys Of another Array values
    function ReplaceArrayKeys($data,$fields)
    {
        foreach ($data as $array){
            for($i=0; $i < count($array); $i++){
                $new_key = $fields[$i];
                $array[$new_key] = $array[$i];
                unset($array[$i]);
            }

            $insert[] = $array;
        }
       return $insert;
    }

    // Get Action Log Message
    function LogAction($type,$id = null,$en=null)
    {
        if($type == 'add'){
            $ar_action = 'تم اضافة بيان جديد =>'.' '.$id;
            if ($en==null){
                $en=$id;
            }
            $en_action = 'Added Record .'.' '.$en;
            $action = $name = array('ar'=>$ar_action,'en'=>$en_action);
            $message = EncodeVar($action);
        }elseif($type == 'edit'){
            $ar_action = 'تم تعديل البيان =>'.' '.$id;
            $en_action = 'Updated Record No.'.' '.$en;
            $action = $name = array('ar'=>$ar_action,'en'=>$en_action);
            $message = EncodeVar($action);
        }elseif($type=='delete'){
            $ar_action = 'تم حذف البيان'.' '.$id;
            $en_action = 'Deleted Record No.'.' '.$en;
            $action = $name = array('ar'=>$ar_action,'en'=>$en_action);
            $message = EncodeVar($action);
        }
        return $message;
    }

    // Get Route Log
    function LogRoute($route)
    {
        $ar_route   = Lang::get('orbscope.'.$route, array(), 'ar');
        $en_route   = Lang::get('orbscope.'.$route, array(), 'en');
        $route_name = array('ar'=>$ar_route,'en'=>$en_route);
        return $message = EncodeVar($route_name);
    }

    /*
     *  Save Log
     */
    function SaveLog($type,$id = null,$route){
       $log =  Log::SaveLog(
            [
                'action' =>LogAction($type,$id),
                'type'   =>$type,
                'table'  =>$route,
                'route'  =>LogRoute($route),
                'data'   =>'',
            ]
        );
       return $log;
    }

    // Check If Key In Array
    function InArray($key,$array,$return = null,$checkValues = null){
      if(empty($checkValues)) {
          if (array_key_exists($key, $array)) {
             return $data[] = $array[$key];
          } else {
             return $data[] = $return;
          }
      }else{
          if (array_key_exists($key, $array)) {
             return CheckValue($array[$key], $checkValues, $return);
          }else{
              return $data[] = $return;
          }
      }
    }

    // Check If Array Value In Array Of Values
    function CheckValue($array,$values,$return){
        if(!empty($array))
        {
            foreach ($values as $value){
            if($array == $value){
                return $array;
            }else{
                  $array =  $return;
                 return $array;
            }
            }
        }else{
            return $return;
        }
    }
