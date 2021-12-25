<?php

use Illuminate\Support\Facades\File;

function saveImage($file , $path){
        $filename = time().$file->getClientOriginalName();
        $file->move($path, $filename);
        return $filename ;
    }

function removeImage($file , $path){
        if(File::exists(public_path($path.$file))){
            File::Delete(public_path($path.$file));
        }
    }
