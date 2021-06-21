<?php

namespace App\Http\Controllers\Backend;

use App\Constants;
use App\Models\Temp;
use App\Models\Group;
use App\Models\Topic;
use App\Helpers\FileHelper;
use App\Helpers\AdminHelper;
use App\Helpers\ExcelHelper;
use Illuminate\Http\Request;
use App\Helpers\TempDataHelper;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    public function index()
    {
        access_is_allowed('read.group');

        $view = view('backend.group.index');
        $view->groups =  Group::with(['student', 'topic'])->orderBy('created_at')->paginate(100);
        
        return $view;
    }

    public function create()
    {
        access_is_allowed('create.group');

        $view = view('backend.group.form');
        $view->group = new Group;
        return $view;
    }

    public function store(Request $request)
    {
        access_is_allowed('create.group');

        $group = AdminHelper::createGroup($request);
        toaster_success(Constants::$SAVE_SUCCESS_MESSAGE);
        return redirect('group/create-step-2/'.$group->id);
    }

    public function createStep2($id)
    {
        $view = view('backend.group.create-step-2');
        $view->group = Group::find($id);
        $view->topics = Topic::orderBy('name')->get();
        return $view;
    }

    public function storeStep2(Request $request)
    {
        $group_student = AdminHelper::createGroupStudent($request);
        toaster_success(Constants::$SAVE_SUCCESS_MESSAGE);
        return redirect('group/create-step-3/'.$request->group_id);
    }

    public function createStep3($id)
    {
        $view = view('backend.group.create-step-3');
        $view->group = Group::find($id);
        $view->topics = Topic::orderBy('name')->get();
        return $view;
    }

    public function storeStep3(Request $request)
    {
        $group_student = AdminHelper::createGroupTopic($request);
        toaster_success(Constants::$SAVE_SUCCESS_MESSAGE);
        return redirect('group');
    }

    public function edit($id)
    {
        access_is_allowed('update.group');

        $view = view('backend.group.form');
        $view->group = Group::findOrFail($id);
        return $view;
    }

    public function update(Request $request)
    {
        access_is_allowed('update.group');

        AdminHelper::createGroup($request);
        toaster_success(Constants::$UPDATE_SUCCESS_MESSAGE);
        return redirect('group');
    }

    public function destroy($id)
    {
        access_is_allowed('delete.group');

        $model = Group::findOrFail($id);
        $delete = AdminHelper::delete($model);
        
        toaster_success(Constants::$DELETE_SUCCESS_MESSAGE);
        return redirect('group');
    }

    public function tempAddStudent(Request $request)
    {
        $temp_name = 'group.student.'.$request->group_id;
        $search = TempDataHelper::searchKeyValue($temp_name, auth()->user()->id, ['group_id', 'student_id'], $value = [$request->group_id, $request->student_id]);
        if (!$search) {
            $temp = new Temp;
            $temp->user_id = auth()->user()->id;
            $temp->name = $temp_name;
            $temp->keys = serialize($request->all());
            $temp->save();
        }
        $data = TempDataHelper::get($temp_name, auth()->user()->id);
        return response()->json($data);
    }
}
