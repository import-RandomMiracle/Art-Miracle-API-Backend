<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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

        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $ext = $image->getClientOriginalExtension();
            $fileName = time() . '.' . $ext;

            $path = $image->storeAs('avatar',$fileName,'public');


            $image = Image::make($image);

            $image->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->encode($ext);

//            $hash = md5($image->__toString()) . $ext;

            Storage::put('public/avatar_resize/' . 'resize_' . $fileName,$image->__toString());
        }

        return $fileName;
    }

    public function download()
    {
        return Storage::download('public/nanashi-mumei.gif');
    }

    public function delete()
    {
        return Storage::delete('public/image/OsDOp5damDFQK2D0B5NZalTAd6sGTe60Rdr6M3R8.jpg');
    }

    public function edit(Request $request)
    {
        $path = $request->file('avatar')->storeAs('image', 'test.jpg', 'public');
    }

    public function getRealImage(Request $request) {
        $artwork = Artwork::find($request->id);
        return $artwork->path;
    }

    public function getShowImage(Request $request) {
        $artwork = Artwork::find($request->id);
        return $artwork->path;
    }
}
