<?php

namespace App\Orbscope\Controllers;
use Image;

class UploadFiles extends Controller
{
    public static function uploadImages($dir,$image,$checkFunction,$watermark = null){

        $saveImage = '';
        // Check Dir Name (Create is not exist)
        if(!file_exists(base_path('public/uploads').'/'.$dir))
        {
            mkdir(base_path('public/uploads').'/'.$dir);
        }
        if(is_file($image)){
            $name = getOriginalName($image);
            if(!$checkFunction($name)){
                return false;
            }else{
                $imageName     = rand(0000,9999).time();
                $ext           = $image->getClientOriginalExtension();
                $fileName      = $imageName.'.'.$ext;
                if($watermark == 'true' && GetSettings()->enable_watermark == 'yes' && !empty(GetSettings()->watermark_image) ){
                    $image = Image::make($image->getRealPath());
                    if(empty(GetSettings()->watermark_offset)){
                        $offset = '0';
                    }else{
                        $offset = GetSettings()->watermark_offset;
                    }
                    $image = $image->insert(base_path('public/uploads/'.GetSettings()->watermark_image),GetSettings()->watermark_position,$offset);
                    $image->save(base_path('public/uploads/'.$dir.'/'.$fileName),'100');
                }else{
                    $image->move(base_path('public/uploads').'/'.$dir,$fileName);
                }
                $saveImage = $dir.'/'.$fileName;


            }
        }
        return $saveImage;
    }
}