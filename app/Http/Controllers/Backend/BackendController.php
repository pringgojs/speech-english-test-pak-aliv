<?php

namespace App\Http\Controllers\Backend;

use App\User;
use Carbon\Carbon;
use App\Models\Ownuse;
use App\Models\BunkerUmum;
use App\Models\LoadingPln;
use App\Models\LoadingApms;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BackendController extends Controller
{
    public function index(Request $request)
    {
        $now = new Carbon;
        $view = view('backend.dashboard.index');
        $view->total_ownuse = 12;
        $view->total_loading_pln = 12;
        $view->total_bunker_umum = 12;
        $view->total_loading_apms = 100;
        $view->list_user_pending = 12;
        return $view;
    }

    /**
     * Show form reject for all Form {Checklist, History, Sumission, etc}
     */
    public function rejectForm()
    {
        
        $data = [
            'model' => \Input::get('model'),
            'id' => \Input::get('id'),
            'approval_to_field' => \Input::get('approval_to_field'),
            'status_approval_field' => \Input::get('status_approval_field'),
            'notes_approval_field' => \Input::get('notes_approval_field'),
            'approval_at' => \Input::get('approval_at'),
            'url_callback' => \Input::get('url_callback'),
        ];

        $view = view('backend._reject-form');
        $view->data = $data;

        return $view;
    }

    /**
     * Process reject form
     */
    public function reject(Request $request)
    {
        $model = $request->model;
        $id = $request->id;
        $approval_to_field = $request->approval_to_field;
        $status_approval_field = $request->status_approval_field;
        $notes_approval_field = $request->notes_approval_field;
        $approval_at_field = $request->approval_at_field;
        
        $namespace = 'App\\Models\\'.$model;
        $model = $namespace::findOrFail($id);
        $model->$status_approval_field =  2; // reject
        $model->$notes_approval_field =  $request->approval_notes;
        $model->$approval_at_field =  Carbon::now();
        $model->save();

        return $request->url_callback;
    }
}
