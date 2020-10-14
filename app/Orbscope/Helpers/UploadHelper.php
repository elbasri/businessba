<?php

    // CSV Type Extensions
    function allowExtFilesCSV(){
        return [
            'csv'
        ];
    }

    // Image Extensions
    function allowExtFilesImage(){
        return [
            'png',
            'jpg',
            'jpeg',
            'gif',
            'bmp'
        ];
    }

    // PDF Extensions
    function allowExtPDF(){
        return [
            'pdf'
        ];
    }

    // Allow Files
    function allowExtFiles(){
        return [
            'png',
            'jpg',
            'jpeg',
            'gif',
            'bmp',
            'pdf',
            'csv',
            'doc',
            'docx',
            'xls',
            'ppt',
            'pptx'
        ];
    }

    // Get File Extension
    function getEx($fileName){
        $fileName = trim($fileName);
        $fileName = explode('.' , $fileName);
        return end($fileName);
    }

    // Check If File is CSV
    function checkFiles($fileName , $file = true){
        if($file){
            $allowEx = allowExtFilesCSV();
        }else{
            $allowEx = allowExtFilesCSV();
        }

        $ex = getEx($fileName);
        if(in_array($ex , $allowEx)){
            return true;
        }
        return false;
    }

    // Check If File Is Image
    function checkImages($fileName, $file = true){
        if($file){
            $allowEx = allowExtFilesImage();
        }else{
            $allowEx = allowExtFilesImage();
        }

        $ex = getEx($fileName);
        if(in_array($ex , $allowEx)){
            return true;
        }
        session()->flash('error',trans('orbscope.select_file') ." " .trans('orbscope.type_image'));
        return false;
    }

    // Check If File Is PDF
    function checkPDF($fileName, $file = true){
        if($file){
            $allowEx = allowExtPDF();
        }else{
            $allowEx = allowExtPDF();
        }

        $ex = getEx($fileName);
        if(in_array($ex , $allowEx)){
            return true;
        }
        session()->flash('error',trans('orbscope.select_file') ." " .trans('orbscope.pdf'));
        return false;
    }

    // Get Original Image name
    function getOriginalName($file){
        return $file->getClientOriginalName();
    }

    // Get File Extension Name
    function fileTypeName(){
            return [
                'pdf'  => 'Adobe Acrobat',
                'doc'  => 'Microsoft Word',
                'docx' => 'Microsoft Word',
                'xls'  => 'Microsoft Excel',
                'xlsx' => 'Microsoft Excel',
                'zip'  => 'Archive',
                'gif'  => 'GIF Image',
                'jpg'  => 'JPEG Image',
                'jpeg' => 'JPEG Image',
                'png'  => 'PNG Image',
                'ppt'  => 'Microsoft PowerPoint',
                'pptx' => 'Microsoft PowerPoint',
            ];
    }

    // Get File Extension Icon
    function fileIcon(){
        return [
            'pdf'  => 'fa-file-pdf-o',
            'doc'  => 'fa-file-word-o',
            'docx' => 'fa-file-word-o',
            'xls'  => 'fa-file-excel-o',
            'xlsx' => 'fa-file-excel-o',
            'zip'  => 'fa-file-archive-o',
            'gif'  => 'fa-file-image-o',
            'jpg'  => 'fa-file-image-o',
            'jpeg' => 'fa-file-image-o',
            'png'  => 'fa-file-image-o',
            'ppt'  => 'fa-file-powerpoint-o',
            'pptx' => 'fa-file-powerpoint-o',
        ];
    }

    // Get Ex of File Name & Icon
    function getTypeFile($ex,$fileIcon = null,$fileType = null){
        if(array_key_exists($ex, fileIcon()) == true && array_key_exists($ex, fileTypeName()) == true){
            $fileIcon =  fileIcon()[$ex];
            $fileType =  fileTypeName()[$ex];
        }
        return ['fileIcon' => $fileIcon , 'fileType' => $fileType];
    }

   function checklist($fileName, $file = true){
    if($file){
        $allowEx = allowExtFilesImage();
    }else{
        $allowEx = allowExtFilesImage();
    }

    $ex = getEx($fileName);
    if(in_array($ex , $allowEx)){
        return true;
    }
    return false;
   }
