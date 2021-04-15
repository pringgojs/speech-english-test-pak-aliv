    <div class="modal fade kategori-modal-form" id="kategori-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg" id="modal-detail">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="myLargeModalLabel">Create New Category</h5>
                </div>
                <form method="post" id="form-kategori">
                <div class="modal-body">
                    
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label class="control-label mb-10 text-left">{!! label('nama', 'name') !!} <span class="help"> e.g. "PT. Pertamina"</span></label>
                        <input type="text" class="form-control" value="" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label mb-10 text-left">{!! label('alamat', 'address') !!}</label>
                        <textarea name="address" class="form-control" id="address" cols="5" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-anim" onclick="store()"><i class="icon-rocket"></i><span class="btn-text">submit</span></button>
                    <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <script>
    function store() {
        var data = $( '#form-kategori' ).serialize();
        $.ajax({
            url: '{{url("master/kategori")}}',
            method: 'POST',
            data: data,
            success: function(res) {
                notification('Success', 'Creat form success');
                populateOption('#kategori-id', res);
                $("#kategori-modal").removeClass("in");
                $(".modal-backdrop").remove();
                $('body').removeClass('modal-open');
                $("#kategori-modal").hide();
                $("#name").val("");
                $("#address").val("");
            },
            error: function(res) {
                notification('Failed', 'Something went wrong');
            },
        })
    }

    function populateOption(target, json) {
        var $select = $(target);
        $select.empty();
        $.each(json, function(i, val){
            $select.append($('<option />', { value: val.id, text: val.name }));
        });
    }
    </script>