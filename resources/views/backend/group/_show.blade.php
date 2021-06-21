<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" >{{$model->name}}</h4>
            <p><i class="fa fa-calendar"></i> Created at: {{date_format_view($model->created_at)}}</p>
        </div>
        
        <div class="panel-body">
            <div class="tab-struct custom-tab-1 product-desc-tab">
                <ul role="tablist" class="nav nav-tabs nav-tabs-responsive" id="myTabs_7">
                    <li class="active" role="presentation"><a aria-expanded="true" data-toggle="tab" role="tab" id="register_tab" href="#data_student"><span>Data Student</span></a></li>
                    <li role="presentation" class=""><a data-toggle="tab" id="data-topic" role="tab" href="#data_topic" aria-expanded="false"><span>Data Topic</span></a></li>
                </ul>
                <div class="tab-content" id="myTabContent_7">
                    <div id="data_student" class="tab-pane fade pt-0 active in" role="tabpanel">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-hover display  pb-30" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Identity Number</th>
                                            <th>Account</th>
                                            <th>Created At</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($model->student as $row => $group_student)
                                        @php $student = $group_student->student;@endphp
                                        @php if(!$student) continue; @endphp
                                        <tr id="tr-{{$group_student->id}}">
                                            <td>{{$row + 1}}</td>
                                            <td>{{$student->name}}</td>
                                            <td>{{$student->identity_number}}</td>
                                            <td>Username: {{$student->user->username}} <br> password: {{$student->password}}</td>
                                            <td>{{date_format_view($student->created_at)}}</td>
                                            <td>
                                                <a onclick="secureDelete('{{url('group/delete-student/'.$group_student->id)}}', '#tr-{{$group_student->id}}')" onclick="document.getElementById('form-delete-{{$group_student->id}}').submit();"  data-toggle="tooltip" data-original-title="Close">
                                                    <button class="btn btn-info btn-icon-anim btn-square  btn-sm"><i class="icon-trash"></i></button>                                                    
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach

                                        @if ($model->student->count() == 0)
                                        <tr><td colspan="4">no data can be displayed
                                        </td></tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="data_topic" class="tab-pane fade pt-0" role="tabpanel">
                            <div class="table-wrap">
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-hover display  pb-30" >
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($model->topic as $row => $group_topic)
                                            @php $topic = $group_topic->topic;@endphp
    
                                            <tr id="tr-{{$group_topic->id}}">
                                                <td>{{$row + 1}}</td>
                                                <td>{{$topic->name}}</td>
                                                <td>
                                                    <a onclick="secureDelete('{{url('group/delete-topic/'.$group_topic->id)}}', '#tr-{{$group_topic->id}}')" onclick="document.getElementById('form-delete-{{$group_topic->id}}').submit();"  data-toggle="tooltip" data-original-title="Close">
                                                        <button class="btn btn-info btn-icon-anim btn-square  btn-sm"><i class="icon-trash"></i></button>                                                    
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
    
                                            @if ($model->topic->count() == 0)
                                            <tr><td colspan="4">no data can be displayed
                                            </td></tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        
        </div>
    </div>
</div>


<script>
function secureDelete(url) {
    swal({
        title: "Anda yakin ingin menghapus data?",
        text: "Data yang dihapus tidak bisa dikembalikan lagi",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#f2b701",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }, function () {
        deleteExec(url);
    });
}

function deleteExec(url) {
    $.ajax({
        url: url,
        type: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (res) {
            swal_success('Berhasil', 'data berhasil dihapus');
            $("#modal-detail").html(res);            
        },
        error: function (result) {
            swal("Failed something went wrong");
        }
    });
}

</script>