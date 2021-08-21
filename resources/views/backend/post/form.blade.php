@extends('layouts.app')
@section('styles')
    <script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
@endsection
@section('content')
    <!-- Title -->
    @include('backend._bread-crumb', [
        'title' => 'post',
        'breadcrumbs' => [
            0 => [
                'link' => url('/'),
                'label' => 'dashboard'
            ],
            1 => [
                'link' => '#',
                'label' => 'post'
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
                            <form method="post" action="{{url('post')}}" enctype="multipart/form-data">
                                {!! csrf_field() !!}
                                @if(\Request::segment(3) != 'copy')
                                <input type="hidden" name="id" value="{{$post ? $post->id : ''}}">
                                @else
                                <input type="hidden" name="id" value="">
                                @endif
                                <h6 class="txt-dark capitalize-font"><i class="fa fa-file mr-10"></i>Post</h6>
                                <hr class="light-grey-hr" />
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label mb-10 text-left">Title</label>
                                            <input type="text" name="title" class="form-control" value="{{$post ? $post->title : ''}}" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label mb-10 text-left">Content</label>
                                            <textarea class="ckeditor" name="content">{{$post ? $post->content : ''}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label mb-10 text-left">Cover (opsional)</label>
                                            <input type="file" name="file" class="form-control">
                                            @if ($post->cover)
                                                <img src="{{asset($post->cover)}}" width="300px" height="auto" alt="">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-success btn-anim"><i class="icon-rocket"></i><span class="btn-text">simpan</span></button>
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
    $(".ckeditor").each(function () {
        CKEDITOR.replace( $(this).attr("name"), {
            filebrowserUploadUrl: "{{route('ckeditor-upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    });
</script>
@stop