<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $image = \App\Models\Image::find($id);
        $image_path = [
            "path" => $image->resize_path
        ];
        return json_encode($image_path);
    }

    public function download($id)
    {
        $image = \App\Models\Image::find($id);
        $image_path = explode ('/',$image->real_path,3);
        return Storage::download('public/' . $image_path[2]);
    }

    public function destroy($id)
    {
        $image = \App\Models\Image::find($id);

        $this->deleteImage($image->real_path);
        $this->deleteImage($image->resize_path);
        return $image->delete();
    }

    public function deleteImage($path){
        $image_path = explode ('/',$path,3);
        return Storage::delete('public/' . $image_path[2]);

    }

    private function resizeImage($image, $key, $ext, $fileName)
    {
        $image = Image::make($image);

        $image->resize(500, 500, function ($constraint) {
            $constraint->aspectRatio();
        })->encode($ext);

        if($key == 'artwork') {
            Storage::put('public/' . $key . '/resize/' . $fileName, $image->__toString());
            return Storage::url($key . '/resize/' . $fileName);
        }

        Storage::put('public/' . $key . '/' . $fileName, $image->__toString());
        return Storage::url($key . '/' . $fileName);
    }
}
