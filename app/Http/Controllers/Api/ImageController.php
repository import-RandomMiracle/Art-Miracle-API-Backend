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
            $profile_image = $request->file('avatar');
            $key = 'avatar';
            $ext = $profile_image->getClientOriginalExtension();
            $fileName = hash('md5', time()) . '.' . $ext;

            $path = $this->resizeImage($profile_image, $key, $ext, $fileName);

            return $path;
        }

        if ($request->hasFile('artwork')) {
            $artwork_image = $request->file('artwork');
            $key = 'artwork';
            $ext = $artwork_image->getClientOriginalExtension();
            $fileName = hash('md5', time()) . '.' . $ext;

            $artwork_image->storeAs('artwork/real-size/', $fileName, 'public');

            $real_image_path = Storage::url('artwork/real-size/' . $fileName);

            $resize_image_path = $this->resizeImage($artwork_image, $key, $ext, $fileName);

            return [$real_image_path, $resize_image_path];
        }

        return "can not save image";
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

    public function getRealImage(Request $request)
    {
        $artwork = Artwork::find($request->id);
        return $artwork->path;
    }

    public function getShowImage(Request $request)
    {
        $artwork = Artwork::find($request->id);
        return $artwork->path;
    }

    private function resizeImage($image, $key, $ext, $fileName)
    {
        $image = Image::make($image);

        $image->resize(500, 500, function ($constraint) {
            $constraint->aspectRatio();
        })->encode($ext);

        Storage::put('public/' . $key . '/resize/' . $fileName, $image->__toString());

        return Storage::url($key . '/resize/' . $fileName);
    }
}
