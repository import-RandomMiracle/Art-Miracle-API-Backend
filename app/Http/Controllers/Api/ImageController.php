<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
     * @param \App\Models\Image $image
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Models\Image $image)
    {
        $image_path = [
            "path" => $image->resize_path,
        ];
        return json_encode($image_path);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Image $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(\App\Models\Image $image)
    {
        $this->deleteImage($image->real_path);
        $this->deleteImage($image->resize_path);
        return $image->delete();
    }

    public function download(Request $request)
    {
        $artwork = Artwork::find($request->artwork_id);
        $image = \App\Models\Image::find($artwork->image_id);
        $image_path = explode('/', $image->real_path, 3);
        return Storage::download('public/' . $image_path[2]);
    }

    public function deleteImage($path)
    {
        $image_path = explode('/', $path, 3);
        return Storage::delete('public/' . $image_path[2]);

    }

    private function resizeImage($image, $key, $ext, $fileName)
    {
        $image = Image::make($image);

        $image->resize(500, 500)->encode($ext);

        if ($key == 'artwork') {
            Storage::put('public/' . $key . '/resize/' . $fileName, $image->__toString());
            return Storage::url($key . '/resize/' . $fileName);
        }

        Storage::put('public/' . $key . '/' . $fileName, $image->__toString());
        return Storage::url($key . '/' . $fileName);
    }
}
