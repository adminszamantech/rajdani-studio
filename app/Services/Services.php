<?php

namespace App\Services;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use File;

class Services{
    public function imageUpload($file,$folder,$width,$height){
         try {
            if(!Storage::disk('public')->exists($folder)){
                Storage::disk('public')->makeDirectory($folder);
            }
            $imageName = rand(1000, 9999) . time() . "." . strtolower($file->getClientOriginalExtension());
            $image = Image::make($file->getContent());
            $image->resize($width,$height);
            Storage::disk('public')->put($folder . $imageName, $image->encode());
            return $imageName;
         } catch (\Throwable $th) {
            return $th->getMessage();
         }
    }

    public function pdfUpload($file,$folder){
         try {
            if(!Storage::disk('public')->exists($folder)){
                Storage::disk('public')->makeDirectory($folder);
            }
            $fileName = rand(1000, 9999) . time() . "." . strtolower($file->getClientOriginalExtension());
            Storage::disk('public')->put($folder . $fileName, file_get_contents($file));
            return $fileName;
         } catch (\Throwable $th) {
            return $th->getMessage();
         }
    }

    public function videoUpload($file,$folder){
        try {
            if(!Storage::disk('public')->exists($folder)){
                Storage::disk('public')->makeDirectory($folder);
            }
            $videoName = rand(1000, 9999) . time() . "." . strtolower($file->getClientOriginalExtension());
            Storage::disk('public')->put($folder . $videoName, File::get($file));
            return $videoName;
         } catch (\Throwable $th) {
            return $th->getMessage();
         }
    }

    public function imageDestroy($modelData,$folder){
        try{
            $old_file = $folder.$modelData;
            if (Storage::disk('public')->exists($old_file)) {
                Storage::disk('public')->delete($old_file);
            }
            return true;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
