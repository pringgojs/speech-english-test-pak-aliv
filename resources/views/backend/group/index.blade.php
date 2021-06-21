@extends('layouts.app')

@section('content')
    <!-- Title -->
    @include('backend._bread-crumb', [
        'title' => 'Group',
        'breadcrumbs' => [
            0 => [
                'link' => url('/'),
                'label' => 'dashboard'
            ],
            1 => [
                'link' => '#',
                'label' => 'Group'
            ],
        ]
    ])
    
    <!-- /Title -->
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        
                        <h6 class="panel-title txt-dark">Group</h6>
                    </div>
                    <div class="pull-right">
                        @if(access_is_allowed_to_view('create.group'))
                        <a class="btn btn-sm btn-primary " href="{{url('group/create')}}">Create new</a>
                        @endif
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
                                            <th>Topic</th>
                                            <th>Student</th>
                                            <th>Created At</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($groups as $row => $group)
                                        <tr id="tr-{{$group->id}}">
                                            <td>{{$row + 1}}</td>
                                            <td>{{$group->name}}</td>
                                            <td>{{$group->topic->count()}}</td>
                                            <td>{{$group->student->count()}}</td>
                                            <td>{{date_format_view($group->created_at)}}</td>
                                            <td>
                                                <a onclick="showDetail('{{url("group/".$group->id)}}')" data-toggle="modal" data-target=".detail-modal" data-toggle="tooltip" data-toggle="tooltip" data-original-title="Detail">
                                                    <button class="btn btn-primary btn-icon-anim btn-square btn-sm"><i class="fa fa-eye"></i></button>
                                                </a>
                                                @if(access_is_allowed_to_view('update.group'))
                                                <a href="{{url('group/'.$group->id.'/edit')}}" data-toggle="tooltip" data-original-title="Edit">
                                                    <button class="btn btn-default btn-icon-anim btn-square btn-sm"><i class="fa fa-pencil"></i></button>
                                                </a>
                                                @endif
                                                @if(access_is_allowed_to_view('delete.group'))
                                                <a onclick="secureDelete('{{url('group/'.$group->id)}}', '#tr-{{$group->id}}')" onclick="document.getElementById('form-delete-{{$group->id}}').submit();"  data-toggle="tooltip" data-original-title="Close">
                                                    <button class="btn btn-info btn-icon-anim btn-square  btn-sm"><i class="icon-trash"></i></button>                                                    
                                                </a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach

                                        @if ($groups->count() == 0)
                                        <tr><td colspan="4">no data can be displayed
                                        </td></tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            {{$groups->links()}}
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
    // initDatatable('#datatable');
</script>
@stop