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
                'link' => url('user'),
                'label' => 'Pengguna'
            ]
        ]
    ])
    
    <!-- /Title -->

    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        @if(access_is_allowed_to_view('create.user'))
                        <div class="dt-buttons">
                            <a class="dt-button buttons-copy buttons-html5" tabindex="0" aria-controls="example" href="{{url('user/create')}}"><i class="fa fa-plus"></i> <span>Buat baru</span></a>
                        </div>
                        @endif
                        <h6 class="panel-title txt-dark"></h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-hover display  pb-30" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $row => $user)
                                        <tr id="tr-{{$user->id}}">
                                            <td>{{$row + 1}}</td>
                                            <td><a href="{{url('user/'.$user->id.'/'.$user->roleUser->role_id)}}">{{$user->name}}</a></td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->roleUser->role->name}}</td>
                                            <td>
                                                @if(access_is_allowed_to_view('permission.user'))
                                                <a href="{{url('user/'.$user->id.'/'.$user->roleUser->role_id)}}" data-toggle="tooltip" data-original-title="Edit">
                                                    <button class="btn btn-primary btn-icon-anim btn-square btn-sm"><i class="fa fa-lock"></i></button>
                                                </a>
                                                @endif
                                                @if(access_is_allowed_to_view('update.user'))
                                                <a href="{{url('user/'.$user->id.'/edit')}}" data-toggle="tooltip" data-original-title="Edit">
                                                    <button class="btn btn-default btn-icon-anim btn-square btn-sm"><i class="fa fa-pencil"></i></button>
                                                </a>
                                                @endif
                                                @if(access_is_allowed_to_view('delete.user'))
                                                <a onclick="secureDelete('{{url('user/'.$user->id)}}', '#tr-{{$user->id}}')" onclick="document.getElementById('form-delete-{{$user->id}}').submit();"  data-toggle="tooltip" data-original-title="Close">
                                                    <button class="btn btn-info btn-icon-anim btn-square  btn-sm"><i class="icon-trash"></i></button>                                                    
                                                </a>
                                                @endif
                                            </td>
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
    initDatatable('#datatable');
</script>
@stop