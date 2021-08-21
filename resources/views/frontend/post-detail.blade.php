@extends('layouts.app-front')

@section('content')
    <!-- Title -->
    @include('backend._bread-crumb', [
        'title' => 'News',
        'breadcrumbs' => [
            0 => [
                'link' => '#',
                'label' => ''
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
                        <h6 class="panel-title txt-dark">{{$post->title}}</h6>
                        <p class="subtitle">{{date_format_view($post->created_at)}}</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        @if ($post->cover)
                            <img src="{{asset($post->cover)}}" style="" width="300px" height="auto" alt="">
                        @endif
                            
                        {!! $post->content !!}
                        
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop

@section('scripts')
@stop