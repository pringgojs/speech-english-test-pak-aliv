<div class="panel-wrapper collapse in">
    <div class="panel-body">
        <div class="panel-group accordion-struct accordion-style-1" id="accordion_2" role="tablist" aria-multiselectable="true">
            @foreach ($question->answers as $question_answer)
            <div class="panel panel-default answer-category-{{$question_answer->id}}">
                <div class="panel-heading" role="tab" id="heading_{{$question_answer->id}}">
                    <a role="button" data-toggle="collapse" data-parent="#accordion_2" href="#collapse_{{$question_answer->id}}" aria-expanded="false" class="collapsed">
                        <div class="icon-ac-wrap pr-20">
                            <span class="plus-ac"><i class="fa  fa-angle-double-down"></i></span>
                            <span class="minus-ac"><i class="fa  fa-angle-double-right"></i></span>
                        </div>
                        {{$question_answer->answer}}
                        @php
                        $url_delete = url('master/question/delete-answer-category/'.$question_answer->id);    
                        @endphp
                        <button class="pull-right" onclick="secureDelete('{{$url_delete}}', '.answer-category-{{$question_answer->id}}')"><i class="fa fa-trash text-danger"></i></button> 
                    </a> 
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
</div>


<script>
    function addItem(elm, question_answer_id) {
        if(event.key === 'Enter') {
            var val = $('#input-'+question_answer_id).val();
            store(question_answer_id, val);
        }
    }

    function store(question_answer_id, val) {
        $.ajax({
            url: '{{url("master/question/create-step-2")}}',
            method: 'post',
            data: {question_answer_id: question_answer_id, value: val},
            success: function (res) {
                var url_delete = "{{url('master/question/delete-answer-variant')}}/"+res.id;
                var html = `<li class="list-group-item list-group-item-`+res.id+`"> <span class="badge" onclick="secureDelete('`+url_delete+`', '.list-group-item-`+res.id+`')"><i class="fa fa-close text-danger"></i></span> `+res.answer+`</li>`;
                $('.list-group-'+res.question_answer_id).append(html);
                notification('Success', 'Item added');
                $('#input-'+question_answer_id).val("");
            }, error: function (res) {
                notification('Error', 'Error');
            }
        })
    }
</script>