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
        <div class="col-md-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">{{$question->question}}</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="panel-group accordion-struct accordion-style-1" id="accordion_2" role="tablist" aria-multiselectable="true">
                            @foreach ($question->answers as $question_answer)
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading_{{$question_answer->id}}">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion_2" href="#collapse_{{$question_answer->id}}" aria-expanded="false" class="collapsed"><div class="icon-ac-wrap pr-20"><span class="plus-ac"><i class="fa  fa-angle-double-down"></i></span><span class="minus-ac"><i class="fa  fa-angle-double-right"></i></span></div>{{$question_answer->answer}}</a> 
                                </div>
                                <div id="collapse_{{$question_answer->id}}" class="panel-collapse collapse" role="tabpanel" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body pa-15"> 
                                        <input type="text" class="form-control" id="input-{{$question_answer->id}}" placeholder="Answer variations">
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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