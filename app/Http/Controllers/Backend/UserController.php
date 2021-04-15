<?php

namespace App\Http\Controllers\Backend;

use App\User;
use App\Helpers\AdminHelper;
use App\Helpers\FileHelper;
use Bican\Roles\Models\Role;
use Illuminate\Http\Request;
use App\Models\PermissionUser;
use App\Exceptions\AppException;
use Bican\Roles\Models\Permission;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $view = view('backend.user.index');
        $view->users =  User::all();
        return $view;
    }

    public function create()
    {
        $view = view('backend.user.create');
        $view->roles =  Role::all();
        $view->permissions =  Permission::where('permissions.action', '!=', 'Access Menu' )
            ->groupBy('type')
            ->orderBy('type')
            ->get();
        return $view;
    }

    public function store(Request $request)
    {
        \DB::beginTransaction();
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->username = $request->username;
        // $user->position = $request->position;
        $file = $request->file('file');
        if (isset($file)) {
            $user->photo = FileHelper::upload($file, 'uploads/users/');
        }
        
        try{
            $user->save();
        }catch (\Exception $e){
            throw new AppException("Failed to save data", 503);
        }

        $user->attachRole($request->role_id);
        $role = Role::find($request->role_id);

        // Role is administrator, so set permission
        if ($role->id == 1) {
            $permissions = $request->permission_id ? : [];
            for ($i=0; $i<count($permissions); $i++) {
                $permission = Permission::findOrFail($permissions[$i]);
                $role->attachPermission($permission);
                $user->attachPermission($permission);
            }
        }

        \DB::commit();
        toaster_success('create form success');
        return redirect('user');
    }

    public function edit($id)
    {
        $view = view('backend.user.edit');
        $view->user = User::findOrFail($id);
        $view->roles =  Role::all();
        $view->permissions =  Permission::where('permissions.action', '!=', 'Access Menu' )
            ->groupBy('type')
            ->orderBy('type')
            ->get();
        return $view;
    }

    public function update(Request $request, $id)
    {
        \DB::beginTransaction();
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        // $user->position = $request->position;
        $file = $request->file('file');
        if (isset($file)) {
            $user->photo = FileHelper::upload($file, 'uploads/users/');
        }

        if ($request->password) {
            $user->password = bcrypt($request->password);
        } 
        try{
            $user->save();
        }catch (\Exception $e){
            throw new AppException("Failed to save data", 503);
        }

        $user->detachAllRoles();
        $user->attachRole($request->role_id);
        $role = Role::find($request->role_id);

        $user->detachAllPermissions();
        // Role is administrator, so set permission
        if ($role->id == 1) {
            $permissions = $request->permission_id ? : [];
            for ($i=0; $i<count($permissions); $i++) {
                $permission = Permission::findOrFail($permissions[$i]);
                $role->attachPermission($permission);
                $user->attachPermission($permission);
            }
        }

        \DB::commit();
        toaster_success('create form success');
        return redirect('user');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $delete = AdminHelper::delete($user);
        
        toaster_success('delete form success');
        return redirect('user');
    }

    public function permission($user_id, $role_id)
    {
        $view = view('backend.user.permission');
        $view->user =  User::findOrFail($user_id);
        $view->role =  Role::findOrFail($role_id);
        $view->permissions = $role_id == 1 ? 
            $view->permissions =  Permission::where('permissions.action', '!=', 'Access Menu' )
                ->groupBy('type')
                ->orderBy('type')
                ->get()
            :
            [];
        return $view;
    }

    public function setPermission(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $permission = Permission::find($request->permission_id);
        if (PermissionUser::check($user->id, $permission->id)) {
            $user->detachPermission($permission);
            return 'true';
        }

        $user->userPermissions()->attach($permission);
        
        return 'true';
    }

    public function profile()
    {
        $view = view('backend.user.profile');
        $view->user = auth()->user();
        return $view;
    }

    public function updateProfile(Request $request)
    {
        $user = User::findOrFail(auth()->user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $file = $request->file('file');
        if (isset($file)) {
            $user->photo = FileHelper::upload($file, 'uploads/users/');
        }

        if ($request->password) {
            $user->password = bcrypt($request->password);
        } 
        try{
            $user->save();
        }catch (\Exception $e){
            throw new AppException("Failed to save data", 503);
        }

        toaster_success('update form success');
        return redirect('profile');

    }

    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->status_approval = 1; //approve
        $user->save();

        if ($user->email) {
            \Mail::send('backend.user.email', ['user' => $user],
                function ($message) use ($user) {
                    $message->to($user->email)->subject('User Bunker Fee Sudah Di SETUJUI');
                }
            );
        }

        toaster_success('approve user success');
        return redirect()->back();
    }

    public function reject($id)
    {
        $user = User::findOrFail($id);
        $user->status_approval = 2; //reject
        $user->save();
        
        if ($user->email) {
            \Mail::send('backend.user.email', ['user' => $user],
                function ($message) use ($user) {
                    $message->to($user->email)->subject('User Bunker Fee Di TOLAK');
                }
            );
        }

        toaster_success('reject user success');
        return redirect()->back();
    }
}
