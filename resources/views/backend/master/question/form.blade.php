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
                'link' => url('question'),
                'label' => 'Question'
            ],
            2 => [
                'link' => '#',
                'label' => $question->id ? 'Update': 'Create new'
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
                            <form method="post" action="{{url('master/question')}}">
                                {!! csrf_field() !!}
                                <input type="hidden" name="id" value="{{$question->id}}">
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">Topic*</label>
                                    <select name="topic_id" placeholder="" class="form-control">
                                        @foreach ($topics as $item)
                                        <option value="{{$item->id}}" @if($item->id == $question->topic_id) selected @endif>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">Question*</label>
                                    <input type="text" name="question" value="{{$question->question}}" class="form-control" placeholder="" required>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">Serial number*</label>
                                    <input type="number" name="serial_number" value="{{$question->serial_number}}" class="form-control" placeholder="" required>
                                </div>

                                {{-- Option answer --}}
                                <div class="seprator-block"></div>
                                <h6 class="txt-dark capitalize-font"><i class="fa fa-check mr-10"></i>Option Answer</h6>
                                <hr class="light-grey-hr">

                                {{-- Default answer --}}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12 ">
                                                    <table id="document" class="table table-responsive table-border" cellspacing="0" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Answer</th>
                                                                <th>Score</th>
                                                                <th style="width:5%"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if ($question->answers)
                                                                @foreach ($question->answers as $item)
                                                                    <tr>
                                                                        <td><input type="text" name="answers[]" class="form-control" value="{{$item->answer}}" placeholder="...."></td>
                                                                        <td><input type="number" name="scores[]" class="form-control" value="{{$item->score}}" placeholder="...."></td>
                                                                        <td><a href="javascript:void(0)" class="remove-row"> <button type="button" class="btn btn-info btn-icon-anim btn-square"><i class="icon-trash"></i></button></a><td>
                                                                        <td></td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                    <table class="table table-responsive table-border" cellspacing="0" width="100%">
                                                        <tfoot>
                                                            <tr>
                                                                <td class="text-right pull-right" colspan="3">
                                                                    <div class="btn btn-sm btn-primary btn-lable-wrap left-label" onclick="addRow()"
                                                                        id="addRow">
                                                                        <span class="btn-label"><i class="fa fa-plus"></i> </span>
                                                                        <span class="btn-text">Add Column</span>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- @if (!$question->id)
                                @for ($i = 0; $i < 4; $i++)
                                <input type="text" name="answer[]" value="" class="form-control" placeholder="write down the answer choices"> <br>
                                @endfor
                                @endif --}}
                                
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-success btn-anim"><i class="icon-rocket"></i><span class="btn-text">submit</span></button>
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
    initFormatNumber();
    </script>

<script>
    /* Add document */
    var tb_document = $('#document').DataTable({
        bSort: false,
        bPaginate: false,
        bInfo: false,
        bFilter: false,
        bScrollCollapse: false
    });
    counter = 0;
    function addRow() {
        tb_document.row.add( [
            `<input type="text" name="answers[]" class="form-control" value="" placeholder="....">`,
            `<input type="number" name="scores[]" class="form-control" value="1" placeholder="....">`,
            `<a href="javascript:void(0)" class="remove-row"> <button type="button" class="btn btn-info btn-icon-anim btn-square"><i class="icon-trash"></i></button></a>`,
        ] ).draw( false );
        $('select').select2();
        counter++;
    }
    
    $('#document tbody').on('click', '.remove-row', function () {
        tb_document.row($(this).parents('tr')).remove().draw();
    });

</script>
@endsection