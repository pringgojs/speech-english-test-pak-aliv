<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" >{{$report->student->name}}</h4>
        </div>
        <form id="form-file" enctype="multipart/form-data">
            <div class="col-lg-12" id="form-item">
                <p>
                    <b>Q: </b>{{$report->question->question}} <br> 
                    <b>A: </b>{!! $report->answerRender() !!} <br> 
                </p>

                <br>
                {!! $report->renderCorrectCategory() !!}
            </div>
            <div class="modal-footer">
                <div class="button-list">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
</script>