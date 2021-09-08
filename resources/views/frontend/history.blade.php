@extends('layouts.app-front')

@section('content')
    <!-- Title -->
    @include('backend._bread-crumb', [
        'title' => 'History ' .$topic->name,
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
        <div class="col-md-12">
            <div class="row">
                {{-- daftar kuis --}}
                <div class="col-sm-12 col-xs-12">
                    <div class="panel panel-default border-panel card-view">
                        <div class="panel-heading">
                            <div class="pull-left auto-width">
                                <h6 class="panel-title txt-dark">Histories</h6>
                            </div>
                            <div class="pull-right txt-primary">
                                <?php $trial = \App\Helpers\FrontHelper::getTrial($data['group_id'], $data['topic_id'], $data['student_id']);?>
                                <span class="head-font block txt-orange-light-1 font-16"><i class="fa fa-refresh txt-orange"></i> {{$trial}}/{{$topic->max_trial ?? '~'}}</span>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body pa-0 row">
                                
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table class="table table-hover mt-15 mb-0">
                                        <thead>
                                            <tr>
                                                <th>Trial</th>
                                                <th>Date</th>
                                                <th>Score</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($histories as $i => $item)
                                            <?php $score = \App\Helpers\FrontHelper::getTotalScore($item->group_id, $item->topic_id, $item->student_id, $item->trial);?>
                                            @php
                                            $token = encrypt($item->group_id.'.'.$item->topic_id .'.'. $item->student_id);    
                                            @endphp
                                                 <tr>
                                                    <td>{{$item->trial}}</td>
                                                    <td>{{date_format_view($item->created_at, true)}}</td>
                                                    <td>{{format_quantity($score)}}</td>
                                                    <td>
                                                        <a href="{{url('front/result/'.$token.'?trial='.$item->trial)}}" class="btn btn-primary btn-sm">View details</a>
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
        </div>
    </div>
    @if ($trial < $topic->max_trial)
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                {{-- daftar kuis --}}
                <div class="col-sm-12 col-xs-12">
                    @php 
                    $token = encrypt($data['group_id'].'.'.$data['topic_id'] .'.'. $data['student_id']);    
                    $url = url('front/form/'.$token); @endphp
                    <button class="btn btn-success btn-lg btn-block" onclick="swalConfirm('{{$url}}', 'Are you sure you want to continue?', 'your chances will decrease')">Try Again</button>
                </div>
            </div>
        </div>
    </div>
    @endif
@stop

@section('scripts')
@stop