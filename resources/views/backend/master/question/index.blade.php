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
@stop

@section('scripts')
<script>
    // initDatatable('#datatable');
</script>
@stop