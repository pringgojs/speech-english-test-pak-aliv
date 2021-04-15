@extends('layouts.app')

@section('content')
    <!-- Title -->
    @include('backend._bread-crumb', [
        'title' => 'Pengguna',
        'breadcrumbs' => [
            0 => [
                'link' => url('dashboard'),
                'label' => 'dashboard'
            ],
            1 => [
                'link' => '#',
                'label' => 'Tambah Pengguna'
            ],
        ]
    ])
    
    <!-- /Title -->
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            <form method="post" action="{{url('user')}}" enctype="multipart/form-data">
                                {!! csrf_field() !!}
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">Name</label>
                                    <input type="text" class="form-control" value="" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">Email</label>
                                    <input type="email" class="form-control" value="" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">Username</label>
                                    <input type="text" class="form-control" value="" name="username" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">Password</label>
                                    <input type="password" class="form-control" value="" name="password" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-10">{!! label('Foto', 'Images') !!}</label>
                                    <input type="file" name="file" id="file">
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">Role</label>
                                    @foreach ($roles as $role)
                                        <div class="radio radio-info">
                                            <input type="radio" name="role_id" onclick="openPermission(this.value)" id="role-{{$role->id}}" value="{{$role->id}}" checked="">
                                            <label for="role-{{$role->id}}">
                                                {{$role->name}}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="form-group" id="permission">
                                    <label class="control-label mb-10 text-left">Permission for Administrator</label>
                                    
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
            
                                                            <td>
                                                                <div class="checkbox checkbox-primary">
                                                                    <input id="permission-{{$permission_group->id}}" value="{{$permission_group->id}}" name="permission_id[]" type="checkbox" >
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
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-success btn-anim"><i class="icon-rocket"></i><span class="btn-text">submit</span></button>
                                </div>
                            </form>
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
    function openPermission(value) {
        if (value == 1) {
            $('#permission').removeClass('hidden');
            return true;
        }
        $('#permission').addClass('hidden');
        
    }
</script>
@stop