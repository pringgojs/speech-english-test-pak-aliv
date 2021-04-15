<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Image;

class FileHelper
{
    public static function upload($file, $path)
    {
        if(\Input::file()) {
            $filename = date("YmdHis"). '-' . $file->getClientOriginalName();
            if($file->move($path, $filename)){
                return $path.$filename;
            }
            return null;
        }

        return null;
    }

    /**Create Img from base64 and save it to server */
    public static function createImg($base_64, $path)
    {
        if (!$base_64) return null;

        $image_name = Str::random(40).".png";
        $path = $path . $image_name;
        Image::make(file_get_contents($base_64))->save($path);  
        
        return $path;
    }
    
}
