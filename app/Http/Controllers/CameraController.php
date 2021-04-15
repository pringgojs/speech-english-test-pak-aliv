<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use Illuminate\Http\Request;

class CameraController extends Controller
{
    public function camera()
    {
        return view('backend.include._camera');
    }

    public function store(Request $request)
    {
        $file = $request->file('webcam');

        return FileHelper::upload($file, 'public/uploads/camera/');
    }

    public function manualUpload(Request $request)
    {
        $file = $request->file('file');

        return FileHelper::upload($file, 'public/uploads/camera/');
    }

    public function renderJS()
    {
        $counter = \Input::get('counter');
        $img = \Input::get('img');
        $link = \Input::get('link');
        return open_camera($img.$counter, $link.$counter);
    }
}
