<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait UploadImageTrait
{
public function uploadImage(Request $request,$folderName){
    $img=$request->file('image')->getClientOriginalName();
    $path=$request->file('image')->storeAs('Category',$img,$folderName);
    return $path;
}
}
