<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Helpers\FileHelper;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Crypt;

class EmailApproveController extends Controller
{
    public function approve($status, $param)
    {
        $decrypted = Crypt::decryptString($param);
        $data = explode('.', $decrypted);

        $namespace = $data[0];
        $id = $data[1];
        $approval_at_field = $data[2];
        $status_approval_field = $data[3];

        $model = $namespace::findOrFail($id);
        $model->$status_approval_field =  $status;
        $model->$approval_at_field =  Carbon::now();
        $model->save();

        $view = view('layouts.approve');
        $view->data = $model;
        $view->status = $status;
        $view->approval_at_field = $approval_at_field;
        $view->status_approval_field = $status_approval_field;
        return $view;
    }
}