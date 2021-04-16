<?php

namespace App\Http\Controllers\Backend;

use App\User;
use Carbon\Carbon;
use App\Models\Setting;
use App\Helpers\FileHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function index()
    {
        $view = view('backend.setting.index');
        $view->settings = Setting::all();
        return $view;
    }

    public function edit($id)
    {
        $view = view('backend.setting.edit');
        $view->setting = Setting::findOrFail($id);
        $view->users = User::all();
        return $view;
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $setting = Setting::findOrFail($id);
        $value = $request->value;
        if ($setting->input_type == 'time') {
            $date = date('Y-m-d') . ' ' .$value;
            $date = Carbon::createFromFormat('Y-m-d g:i A', $date);
            $value = $date->format('H:i');
        }

        if ($setting->input_type == 'file') {
            $value = FileHelper::upload($request->value, 'uploads/config/');
        }
        
        $setting->value = $value;
        $setting->save();
        DB::commit();
        
        toaster_success('create form success');
        return redirect('setting');
    }
}
