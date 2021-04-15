
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" >Form Reject</h4>
        </div>
        <div class="col-lg-12" id="form-item">
            <form id="form-reject">
                {!! csrf_field() !!}
                <input type="hidden" id="id" name="id" value="{{$data['id']}}">
                <input type="hidden" id="model" name="model" value="{{$data['model']}}">
                <input type="hidden" id="approval_to_field" name="approval_to_field" value="{{$data['approval_to_field']}}">
                <input type="hidden" id="status_approval_field" name="status_approval_field" value="{{$data['status_approval_field']}}">
                <input type="hidden" id="notes_approval_field" name="notes_approval_field" value="{{$data['notes_approval_field']}}">
                <input type="hidden" id="approval_at_field" name="approval_at_field" value="{{$data['approval_at']}}">
                <input type="hidden" id="url_callback" name="url_callback" value="{{$data['url_callback']}}">

                <div class="form-group mt-20 ">
                    <label class="control-label mb-10">{!! label('Catatan penolakan', 'notes') !!}</label>
                    <textarea name="approval_notes" class="form-control" id="approval_notes" cols="30" rows="10"></textarea>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <div class="button-list">
                <button type="button" class="btn btn-success bt-store pull-right" onclick="store()">Simpan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>

    function store() {
        if ($('#approval_notes').val() == '') {
            notification('Error', 'Alasan penolakan wajib diisi');
            return;
        }
        var data = $( '#form-reject' ).serialize();
        $.ajax({
            url: '{{url("reject")}}',
            method: 'POST',
            data: data,
            success: function(res) {
                notification('Success', 'Form rejected')
                location.href='{{$data['url_callback']}}';
            },
            error: function(res) {
                swal('Opps, something went wrong. Please try again');
            },
        })
    }

</script>