@extends('layouts.app')

@section('content')
    <!-- Title -->
    @include('backend._bread-crumb', [
        'title' => 'Question',
        'breadcrumbs' => [
            0 => [
                'link' => url('/'),
                'label' => 'dashboard'
            ],
            1 => [
                'link' => '#',
                'label' => 'Question'
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
                        @if(access_is_allowed_to_view('create.master.question'))
                        <div class="dt-buttons">
                            <a class="dt-button buttons-copy buttons-html5" tabindex="0" aria-controls="example" href="{{url('master/question/create')}}"><i class="fa fa-plus"></i> <span>Create new</span></a>
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
                                            <th>Question</th>
                                            <th>Topic</th>
                                            <th>Created At</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($questions as $row => $question)
                                        @php if(!$question->topic) continue; @endphp
                                        <tr id="tr-{{$question->id}}">
                                            <td>{{$row + 1}}</td>
                                            <td>{{$question->question}}</td>
                                            <td>{{$question->topic->name}}</td>
                                            <td>{{date_format_view($question->created_at)}}</td>
                                            <td>
                                                <a href="#" onclick="dataQuestion({{$question}})" data-original-title="Detail" data-toggle="modal" data-target="#myModal">
                                                    <button class="btn btn-warning btn-icon-anim btn-square btn-sm"><i class="fa fa-ellipsis-v"></i></button>
                                                </a>
                                                @if(access_is_allowed_to_view('update.master.question'))
                                                <a href="{{url('master/question/'.$question->id.'/edit')}}" data-toggle="tooltip" data-original-title="Edit">
                                                    <button class="btn btn-default btn-icon-anim btn-square btn-sm"><i class="fa fa-pencil"></i></button>
                                                </a>
                                                @endif
                                                @if(access_is_allowed_to_view('delete.master.question'))
                                                <a onclick="secureDelete('{{url('master/question/'.$question->id)}}', '#tr-{{$question->id}}')" onclick="document.getElementById('form-delete-{{$question->id}}').submit();"  data-toggle="tooltip" data-original-title="Close">
                                                    <button class="btn btn-info btn-icon-anim btn-square  btn-sm"><i class="icon-trash"></i></button>                                                    
                                                </a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach

                                        @if ($questions->count() == 0)
                                        <tr><td colspan="4">No data available in table
                                        </td></tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            {{$questions->links()}}
                        </div>
                    </div>
                </div>
            </div>	
        </div>
    </div>
    <!-- /Row -->

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="text-question"></h4>
                    <span class="label label-primary" id="text-topic"></span>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Answer item</th>
                                <th>Score</th>
                            </tr>
                        </thead>
                        <tbody class="table-answer"></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
<script>
    // initDatatable('#datatable');
    function dataQuestion(data) {
        $('.table-answer').html('');
        $('#text-question').html(data.question);
        $('#text-topic').html(data.topic.name);
        data.answers.forEach(renderAnswer);
    }

    function renderAnswer(item, index) {
        var html = `<tr><td>`+item.answer+`</td> <td>`+item.score+`</td></tr>`;
        $('.table-answer').append(html);
    }
</script>
@stop