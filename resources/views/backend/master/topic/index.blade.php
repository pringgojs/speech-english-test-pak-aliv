@extends('layouts.app')

@section('content')
    <!-- Title -->
    @include('backend._bread-crumb', [
        'title' => 'Topic',
        'breadcrumbs' => [
            0 => [
                'link' => url('/'),
                'label' => 'dashboard'
            ],
            1 => [
                'link' => '#',
                'label' => 'Topic'
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
                        @if(access_is_allowed_to_view('create.master.topic'))
                        <div class="dt-buttons">
                            <a class="dt-button buttons-copy buttons-html5" tabindex="0" aria-controls="example" href="{{url('master/topic/create')}}"><i class="fa fa-plus"></i> <span>Create new</span></a>
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
                                            <th>Cover</th>
                                            <th>Name</th>
                                            <th>Created At</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($topics as $row => $topic)
                                        <tr id="tr-{{$topic->id}}">
                                            <td>{{$row + 1}}</td>
                                            <td>@if ($topic->image)
                                                    <img src="{{asset($topic->image)}}" width="100px" height="auto" alt="">
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{$topic->name}}</td>
                                            <td>{{date_format_view($topic->created_at)}}</td>
                                            <td>
                                                @if(access_is_allowed_to_view('update.master.topic'))
                                                <a href="{{url('master/topic/'.$topic->id.'/edit')}}" data-toggle="tooltip" data-original-title="Edit">
                                                    <button class="btn btn-default btn-icon-anim btn-square btn-sm"><i class="fa fa-pencil"></i></button>
                                                </a>
                                                @endif
                                                @if(access_is_allowed_to_view('delete.master.topic'))
                                                <a onclick="secureDelete('{{url('master/topic/'.$topic->id)}}', '#tr-{{$topic->id}}')" onclick="document.getElementById('form-delete-{{$topic->id}}').submit();"  data-toggle="tooltip" data-original-title="Close">
                                                    <button class="btn btn-info btn-icon-anim btn-square  btn-sm"><i class="icon-trash"></i></button>                                                    
                                                </a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach

                                        @if ($topics->count() == 0)
                                        <tr><td colspan="4">no data can be displayed
                                        </td></tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            {{$topics->links()}}
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