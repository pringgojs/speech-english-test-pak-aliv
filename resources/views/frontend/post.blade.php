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
            @foreach ($posts as $item)
                
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">{{$item->title}}</h6>
                        <p class="subtitle">{{date_format_view($item->created_at)}}</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="row">
                            @if ($item->cover)
                            <div class="col-sm-3">
                                <img src="{{asset($item->cover)}}" class="img-fluid"  alt="">
                            </div>
                            <div class="col-sm-9">
                                <p class="muted">{{$item->desc(500)}}</p>
                                <a href="{{$item->generateLink()}}" class="btn btn-info btn-outline btn-0">Continue reading</a>
                            </div>
                                
                            @else
                            <div class="col-sm-12">
                                <p class="muted">{{$item->desc(500)}}</p>
                                <a href="{{$item->generateLink()}}" class="btn btn-info btn-outline btn-0">Continue reading</a>
                            </div>
                            @endif
                        </div>
                        
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
@stop

@section('scripts')
@stop