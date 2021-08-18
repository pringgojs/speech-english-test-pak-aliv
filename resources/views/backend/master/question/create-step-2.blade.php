@extends('layouts.app')

@section('content')
    <!-- Title -->
    @include('backend._bread-crumb', [
        'title' => 'Answer Variantions',
        'breadcrumbs' => [
            0 => [
                'link' => url('/'),
                'label' => 'dashboard'
            ],
            1 => [
                'link' => url('question'),
                'label' => 'Answer Variantions'
            ],
            2 => [
                'link' => '#',
                'label' => 'Create new'
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
                        @include('backend.master.question._wizard', ['from' => 'step-2'])
                        <br><br>
                        
                    </div>
                </div>
            </div>	
        </div>
    </div>

    <!-- /Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Form Answer Category</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            <form method="post" action="{{url('master/question/answer-category')}}" enctype="multipart/form-data">
                                {!! csrf_field() !!}
                                <input type="hidden" name="question_id" value="{{$question->id}}">
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">Name*</label>
                                    <input type="text" name="name" value="" class="form-control" placeholder="" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">Score*</label>
                                    <input type="number" name="score" value="" class="form-control" placeholder="" required>
                                </div>
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-primary btn-anim"><i class="icon-rocket"></i><span class="btn-text">submit</span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>	
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">{{$question->question}}</h6>
                    </div>
                    <div class="pull-right">
                        <a href="{{url('master/question')}}" class="btn btn-sm btn-warning">Back</a>
                    </div>
                    <div class="clearfix"></div>
                </div>

                {{-- <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="panel-group accordion-struct accordion-style-1" id="accordion_2" role="tablist" aria-multiselectable="true">
                            @foreach ($question->answers as $question_answer)
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading_{{$question_answer->id}}">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion_2" href="#collapse_{{$question_answer->id}}" aria-expanded="false" class="collapsed"><div class="icon-ac-wrap pr-20"><span class="plus-ac"><i class="fa  fa-angle-double-down"></i></span><span class="minus-ac"><i class="fa  fa-angle-double-right"></i></span></div>{{$question_answer->answer}}</a> 
                                </div>
                                <div id="collapse_{{$question_answer->id}}" class="panel-collapse collapse" role="tabpanel" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body pa-15"> 
                                        <input type="text" class="form-control" onkeydown="addItem(this, {{$question_answer->id}})" question-answer-id="{{$question_answer->id}}" id="input-{{$question_answer->id}}" placeholder="Answer variations">
                                        <ul class="list-group mt-10 list-group-{{$question_answer->id}}">
                                            @foreach ($question_answer->variants as $variant)
                                            @php
                                            $url_delete = url('master/question/delete-answer-variant/'.$variant->id);    
                                            @endphp
                                            <li class="list-group-item list-group-item-{{$variant->id}}"> <span class="badge" onclick="secureDelete('{{$url_delete}}', '.list-group-item-{{$variant->id}}')"><i class="fa fa-close text-danger"></i></span> {{$variant->answer}}</li>
                                            @endforeach
                                          </ul>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div> --}}

                @include('backend.master.question._answer-variant')
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
    initFormatNumber();
	
    </script>

@endsection