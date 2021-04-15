<style>
.progress { display: none; }
</style>
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" >Unggah Foto</h4>
            <p class="text-muted">Silahkan menggunkan camera ataupun unggah langsung dari file yang sudah ada</p>
        </div>
        <div class="col-lg-12">
            <div class="panel-body">
                <div class="tab-struct vertical-tab custom-tab-1 mt-40">
                    <ul role="tablist" class="nav nav-tabs ver-nav-tab" id="myTabs_8" style="min-height: 170px;">
                        <li class="active" role="presentation"><a aria-expanded="true" data-toggle="tab" role="tab" id="home_tab_8" href="#panel-camera">Camera</a></li>
                        <li role="presentation" class=""><a data-toggle="tab" id="profile_tab_8" role="tab" href="#panel-upload" aria-expanded="false">Local Disk</a></li>
                    </ul>
                    <div class="tab-content" id="myTabContent_8" style="min-height: 170px;">
                        <div id="panel-camera" class="tab-pane fade active in" role="tabpanel">
                            <div class="row">
                                <div class="col-md-6" id="my_camera" style="padding-left:5px"></div>
                                <div class="col-md-6" id="results"></div>
                            </div>
                            <br>
                            <input type="button" class="btn btn-sm btn-primary" value="Capture" onClick="takeSnapshot()">
                            <input type="button" class="btn btn-sm btn-info hidden" id="save-snapshot" value="Unggah Foto" onClick="saveSnapshot()">

                            <button type="button" class="btn btn-success btn-sm hidden pull-right" style="margin-right:90px" id="use-this" onclick="useThis()"><i class="fa fa-check"></i> Gunakan ini</button>
                        </div>
                        <div id="panel-upload" class="tab-pane fade" role="tabpanel">
                            <form id="form-upload-camera" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label mb-10">Pilih sebuah gambar dari Local Disk</label>
                                            <input type="file" name="file" value="" class="form-control">
                                        </div>
                                        <progress class="progress" value="0" max="100"></progress>
                                        <input type="submit" class="btn btn-info btn-sm" value="Unggah Foto" />
                                        <button type="button" class="btn btn-success btn-sm hidden pull-right" id="use-this-manual" onclick="useThisManual()"><i class="fa fa-check"></i> Gunakan ini</button>
                                        
                                    </div>
                                    <div class="col-md-6">
                                        <img style="width:150px; height:150px" src="" id="result-img-upload" alt="">
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <div class="button-list">
                <button type="button" class="btn btn-success bt-store hidden pull-right" onclick="store()">Simpan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Configure a few settings and attach camera -->
<script language="JavaScript">
    var link_after_upload = '';
    Webcam.set({
        width: 320,
        height: 240,
        image_format: 'jpeg',
        jpeg_quality: 90
    });

    Webcam.attach( '#my_camera' );

    function takeSnapshot() {
        // take snapshot and get image data
        Webcam.snap( function(data_uri) {
            // display results in page
            document.getElementById('results').innerHTML = '<img id="imageprev" src="'+data_uri+'"/>';
        });

        $('#save-snapshot').removeClass('hidden');
    }

    function saveSnapshot() {
        // Get base64 value from <img id='imageprev'> source
        var base64image = document.getElementById("imageprev").src;

        Webcam.upload( base64image, '{{url("camera")}}', function(code, text) {
            link_after_upload = text;
        });

        $('#use-this').removeClass('hidden');
    }

    function useThis() {
        // get data callback from layout
        var img_target_callback = $('#img-target').val();
		var link_target_callback = $('#input-link').val();

        // set link img to input target
        $('#'+link_target_callback).val(link_after_upload);
        
        // set img to callback
        $('#'+img_target_callback).attr('src', '{{url("/")}}/'+link_after_upload);
    }

</script>

{{-- Handle Upload Manual --}}
<script>
    $("#form-upload-camera").on('submit', (function(ev) {
        ev.preventDefault();
        $.ajax({
            xhr: function() {
                var progress = $('.progress'),
                    xhr = $.ajaxSettings.xhr();

                progress.show();

                xhr.upload.onprogress = function(ev) {
                    if (ev.lengthComputable) {
                        var percentComplete = parseInt((ev.loaded / ev.total) * 100);
                        progress.val(percentComplete);
                        if (percentComplete === 100) {
                            progress.hide().val(0);
                        }
                    }
                };

                return xhr;
            },
            url: '{{url("manual-upload")}}',
            type: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data, status, xhr) {
                $('#use-this-manual').removeClass('hidden');
                link_after_upload = data;
                $("#result-img-upload").attr('src', '{{url("/")}}/'+link_after_upload);
            },
            error: function(xhr, status, error) {
                alert('Please, try again!');
            }
        });
    }));

    function useThisManual() {
        // get data callback from layout
        var img_target_callback = $('#img-target').val();
		var link_target_callback = $('#input-link').val();

        // set link img to input target
        $('#'+link_target_callback).val(link_after_upload);
        
        // set img to callback
        $('#'+img_target_callback).attr('src', '{{url("/")}}/'+link_after_upload);
    }

</script>