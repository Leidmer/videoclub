<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;

class ImageController extends Controller
{
    public function imageIndex(){
        return view('image');
    }

    public function imageStore(Request $request){
        $image = new Image();
        
        $image->imageName = $request->input('imageName');

        if($request->hasfile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move('uploads/image/', $filename);
            $image->image = $filename;
        } else {
            return $request;
            $image->image = '';
        }

        $image->save();

        return view('image')->with('image',$image);
    }
}
