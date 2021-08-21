@extends('layouts.app')

@section('content')
    <!-- Title -->
    @include('backend._bread-crumb', [
        'title' => 'Post',
        'breadcrumbs' => [
            0 => [
                'link' => url('/'),
                'label' => 'dashboard'
            ],
            1 => [
                'link' => '#',
                'label' => 'Post'
            ],
        ]
    ])
    
    <!-- /Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <form method="get" action="{{url('post')}}">
                        {!! csrf_field() !!}
                        <?php 
                            $search = \Input::get('search');
                        ?>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="control-label mb-10 text-left">Search</label>
                                <input type="text" class="form-control" value="{{$search}}" name="search" placeholder="Title">
                            </div>
                        </div>
    
                        <div class="row mt-10">
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-success btn-sm btn-anim">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <div class="dt-buttons">
                            <a class="dt-button buttons-copy buttons-html5" tabindex="0" aria-controls="example" href="{{url('post/create')}}"><i class="fa fa-plus"></i> <span>Buat baru</span></a>
                        </div>
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
                                            <th>Title</th>
                                            <th>Content</th>
                                            <th>Date Publish</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($posts as $row => $post)
                                        <tr id="tr-{{$post->id}}">
                                            <td>{{$row + 1}}</td>
                                            <td>{{$post->title}}</td>
                                            <td>{!! $post->desc(100) !!}</td>
                                            <td>{{date_format_view($post->created_at)}}</td>
                                            <td>
                                                <a href="{{url('post/'.$post->id.'/copy')}}" data-toggle="tooltip" title="Copy">
                                                    <button class="btn btn-warning btn-icon-anim btn-square btn-sm"><i class="fa fa-copy"></i></button>
                                                </a>
                                                <a href="{{url('post/'.$post->id.'/edit')}}" data-toggle="tooltip" title="Edit">
                                                    <button class="btn btn-default btn-icon-anim btn-square btn-sm"><i class="fa fa-pencil"></i></button>
                                                </a>
                                                <a onclick="secureDelete('{{url('post/'.$post->id)}}', '#tr-{{$post->id}}')" onclick="document.getElementById('form-delete-{{$post->id}}').submit();"  data-toggle="tooltip" title="Hapus">
                                                    <button class="btn btn-info btn-icon-anim btn-square  btn-sm"><i class="icon-trash"></i></button>                                                    
                                                </a>
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
    $('#agen-post-id').select2();
    $('#jenis-post-id').select2();
    // initDatatable('#datatable');
</script>
@stop