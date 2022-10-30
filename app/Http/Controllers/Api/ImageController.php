<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index()
    {

    }

    public function store(Request $request)
    {
//        $request->validate([
//            'file' => 'required|mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf|max:2048'
//        ]);

        if($request->hasFile('avatar')){
            $image      = $request->file('avatar');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('avatar',$fileName,'public');
        }

        return $fileName;
    }

    public function download(){
        return Storage::download('public/nanashi-mumei.gif');
    }

    public function delete(){
        return Storage::delete('public/image/OsDOp5damDFQK2D0B5NZalTAd6sGTe60Rdr6M3R8.jpg');
    }

    public function edit(Request $request){
        $path = $request->file('avatar')->storeAs('image','test.jpg', 'public');
    }
}
