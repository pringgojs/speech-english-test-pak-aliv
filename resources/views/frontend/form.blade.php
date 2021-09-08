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
                        <h6 class="panel-title txt-dark mb-15">{{$question->question}}</h6>
                        @if($question->image)
                        <img src="{{asset($question->image)}}" width="auto" height="150" alt="">
                        @endif
                        <ul class="list-icons hidden" id="msg-done">
                            <li class="mb-10"><i class="fa fa-check text-danger mr-5"></i>You have done recording. Click the submit button</li>
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
// remove note
localStorage.removeItem('note');

try {
  var SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
  var recognition = new SpeechRecognition();
}
catch(e) {
  console.error(e);
  $('.no-browser-support').show();
  $('.app').hide();
}


var noteContent = '';

/*-----------------------------
      Voice Recognition 
------------------------------*/

// If false, the recording will stop after a few seconds of silence.
// When true, the silence period is longer (about 15 seconds),
// allowing us to keep recording even when the user pauses. 
recognition.continuous = true;

// This block is called every time the Speech APi captures a line. 
recognition.onresult = function(event) {

  // event is a SpeechRecognitionEvent object.
  // It holds all the lines we have captured so far. 
  // We only need the current one.
  var current = event.resultIndex;

  // Get a transcript of what was said.
  var transcript = event.results[current][0].transcript;

  // Add the current transcript to the contents of our Note.
  // There is a weird bug on mobile, where everything is repeated twice.
  // There is no official solution so far so we have to handle an edge case.
  var mobileRepeatBug = (current == 1 && transcript == event.results[0][0].transcript);

  if(!mobileRepeatBug) {
    noteContent += transcript;
    localStorage.setItem('note', noteContent);
  }
};

recognition.onstart = function() { 
    console.log('Voice recognition activated. Try speaking into the microphone.');
}

recognition.onspeechend = function() {
  console.log('You were quiet for a while so voice recognition turned itself off.');
  console.log('noteContent: ' + noteContent);

}

recognition.onerror = function(event) {
  if(event.error == 'no-speech') {
    console.log('No speech was detected. Try again.');  
  };
}



/*-----------------------------
      App buttons and input 
------------------------------*/
function startSpeech() {
    $("#voice-img").attr("src","{{asset('voice.gif')}}");
    $('#btn-start').addClass('hidden');
    $('#btn-stop').removeClass('hidden');
    if (noteContent.length) {
        noteContent += ' ';
    }
    recognition.start();
}

function stopSpeech() {
    $("#voice-img").attr("src","{{asset('bg-default.png')}}");
    $('#btn-stop').addClass('hidden');
    $('#msg-done').removeClass('hidden');
    $('#btn-submit').removeClass('hidden');
    recognition.stop();
}

function submitForm() {
    var note = localStorage.getItem('note');
    $.ajax({
        url: '{{url("front/store")}}',
        type: 'post',
        data: {
            token: '{{$token}}',
            answer: note,
            question_id: '{{$question->id}}'
        },
        success: function (res) {
            console.log(res);
            window.location = '{{url("front/form/".$token)}}/?from=formujian';
        }, error: function (res) {
            console.log(res);
            notification('Error', 'Something went wrong');
        }
    })
    console.log(note);
}
 
</script>
@stop