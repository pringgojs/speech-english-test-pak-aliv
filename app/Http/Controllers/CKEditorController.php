<?php

namespace App\Http\Controllers;

use App\Models\FileAsset;
use App\Helpers\FileHelper;
use Illuminate\Http\Request;

class CKEditorController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $ck_editor_func_num = $request->input('CKEditorFuncNum');

            $filenamewithextension = $request->file('upload')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
    
            /** store in DB */
            $file_asset = new FileAsset;
            $file_asset->name = $filename;
            $file_asset->extension = $extension;
            $file_asset->path = FileHelper::upload($request->file('upload'), 'uploads/ck-editor/');
            $file_asset->save();
            
            /** render to CKEditor */
            $url = asset($file_asset->path);
            $msg = 'File berhasil diunggah'; 
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($ck_editor_func_num, '$url', '$msg')</script>";
            @header('Content-type: text/html; charset=utf-8'); 
            echo $re;
        }
    }

    public function uploadDrag(Request $request)
    {
        info("log");
        if ($request->hasFile('upload')) {
            $ck_editor_func_num = $request->input('CKEditorFuncNum');

            $filenamewithextension = $request->file('upload')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();

            /** store in DB */
            $file_asset = new FileAsset;
            $file_asset->name = $filename;
            $file_asset->extension = $extension;
            $file_asset->path = FileHelper::upload($request->file('upload'), 'uploads/ck-editor/');
            $file_asset->save();
            info($file_asset);

            $data = [
                "uploaded" => 1,
                "fileName" => $file_asset->name,
                "url" => asset($file_asset->path)
            ];
            
            return json_encode($data);
        }

        $data = [
            "uploaded" => 0,
            "error" => [
                "message" => "Failed to save.",
            ]
        ];
    }
}
