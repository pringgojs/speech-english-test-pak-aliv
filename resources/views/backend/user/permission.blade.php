@extends('layouts.app')

@section('content')
    <!-- Title -->
    @include('backend._bread-crumb', [
        'title' => 'Setting Permission User',
        'breadcrumbs' => [
            0 => [
                'link' => url('dashboard'),
                'label' => 'dashboard'
            ],
            1 => [
                'link' => url('user'),
                'label' => 'Setting Permission User'
            ]
        ]
    ])
    
    <!-- /Title -->

    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <b style="font-weight:600">User: </b> {{$user->name}} <br>
                    <b style="font-weight:600">Role: </b> {{$role->name}}
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="datatable" class="table display  pb-30" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Group</th>
                                            <th>Permission</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($permissions as $row => $permission)
                                        <tr>
                                            <td style="background: grey; color:white">{{$row + 1}}</td>
                                            <td style="background: grey; color:white">{{strtoupper($permission->group)}}</td>

                                            <?php
                                            $permissions_in_group = \Bican\Roles\Models\Permission::where('type', $permission->type)->get();
                                            ?>
                                            @foreach ($permissions_in_group as $permission_group)
                                            <?php $check = \App\Models\PermissionUser::check($user->id, $permission_group->id);?>

                                            <td>
                                                <div class="checkbox checkbox-primary">
                                                    <input id="permission-{{$permission_group->id}}" onchange="setPermission({{$user->id}}, {{$permission_group->id}})" type="checkbox" {{$check ? 'checked':''}}>
                                                    <label for="permission-{{$permission_group->id}}">
                                                        {{strtoupper($permission_group->name)}}
                                                    </label>
                                                </div>
                                                    
                                            </td>
                                            @endforeach
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>	
        </div>
    </div>
    <!-- /Row -->
@stop

@section('scripts')
    <script>
    function setPermission(user_id, permission_id) {
        $.ajax({
            url: '{{url("user/set-permission")}}',
            data: {user_id: user_id, permission_id: permission_id},
            success: function(result) {
                console.log(result);
                notification('Success', 'Set user permission');
            }
        })
    }
    </script>
@stop
