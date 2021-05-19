<?php

namespace App\Http\Controllers\Backend\Master;

use App\Models\Topic;
use App\Helpers\AdminHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TopicController extends Controller
{
    public function index()
    {
        access_is_allowed('read.master.topic');

        $view = view('backend.master.topic.index');
        $view->topics =  Topic::orderBy('created_at')->paginate(100);
        return $view;
    }

    public function create()
    {
        access_is_allowed('create.master.topic');

        $view = view('backend.master.topic.form');
        $view->topic = new Topic;
        return $view;
    }

    public function store(Request $request)
    {
        access_is_allowed('create.master.topic');

        AdminHelper::createTopic($request);
        toaster_success('create form success');
        return redirect('master/topic');
    }

    public function edit($id)
    {
        access_is_allowed('update.master.topic');

        $view = view('backend.master.topic.form');
        $view->topic = Topic::findOrFail($id);
        return $view;
    }

    public function update(Request $request)
    {
        access_is_allowed('update.master.topic');

        AdminHelper::createTopic($request);
        toaster_success('create form success');
        return redirect('master/topic');
    }

    public function destroy($id)
    {
        access_is_allowed('delete.master.topic');

        $model = Topic::findOrFail($id);
        $delete = AdminHelper::delete($model);
        
        toaster_success('delete form success');
        return redirect('master/topic');
    }
}
