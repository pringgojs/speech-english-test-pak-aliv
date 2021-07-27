@extends('layouts.app-front')

@section('content')
    <!-- Title -->
    @include('backend._bread-crumb', [
        'title' => '',
        'breadcrumbs' => [
            0 => [
                'link' => '#',
                'label' => ''
            ]
        ]
    ])

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default border-panel card-view" style="background: #f1f1f1">
            <div class="panel-heading">
                <div class="pull-left">
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body text-center" style="background: #f1f1f1">
                    <div class="sm-data-box-4 with-icon">
                        <h6 class="panel-title txt-dark mb-15">Tell me about yourself</h6>
                        <ul class="list-icons hidden" id="msg-done">
                            <li class="mb-10"><i class="fa fa-check text-danger mr-5"></i>We have recorded your answer</li>
                        </ul>

                        <div class="relative mb-15">
                            <img src="{{asset('bg-default.png')}}" id="voice-img" width="250px" height="auto" alt="">
                        </div>
                        <button onclick="startSpeech()" id="btn-start" class="btn btn-danger btn-icon-anim btn-circle btn-lg"><i class=" glyphicon glyphicon-play"></i></button>
                        <button onclick="stopSpeech()" id="btn-stop" class="btn btn-danger btn-icon-anim btn-circle btn-lg hidden"><i class=" glyphicon glyphicon-stop"></i></button>
                        <button onclick="submitForm()" id="btn-submit" class="btn btn-primary btn-rounded hidden"><span>submit answer</span></button>
                    </div>
                </div>	
            </div>
        </div>
    </div>
</div>

@stop

@section('scripts')
<script>
    function startSpeech() {
        $("#voice-img").attr("src","{{asset('voice.gif')}}");
        $('#btn-start').addClass('hidden');
        $('#btn-stop').removeClass('hidden');
    }

    function stopSpeech() {
        $("#voice-img").attr("src","{{asset('bg-default.png')}}");
        $('#btn-stop').addClass('hidden');
        $('#msg-done').removeClass('hidden');
        $('#btn-submit').removeClass('hidden');
    }
</script>
@stop