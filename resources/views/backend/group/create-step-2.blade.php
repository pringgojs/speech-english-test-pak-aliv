@extends('layouts.app')

@section('content')
    <!-- Title -->
    @include('backend._bread-crumb', [
        'title' => 'Group',
        'breadcrumbs' => [
            0 => [
                'link' => url('/'),
                'label' => 'dashboard'
            ],
            1 => [
                'link' => url('group'),
                'label' => 'Group'
            ],
            2 => [
                'link' => '#',
                'label' => $group->id ? 'Update': 'Create new'
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
                        @include('backend.group._wizard', ['from' => 'step-2'])
                        <br><br>
                        <div class="form-wrap">
                            <form method="post" action="{{url('group/create-step-2')}}">
                                {!! csrf_field() !!}
                                <input type="hidden" name="group_id" value="{{$group->id}}">
                                <div class="form-group">
                                    <select class="form-control select2" name="student" onchange="addStudent(this.value)">
                                    </select>
                                </div>

                                <table id="document" class="table table-responsive table-border" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Data Mahasiswa</th>
                                            <th style="width:5%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $counter = 0;?>
                                        @foreach ($group->student as $item)
                                            <tr>
                                                <td><input type="hidden" name="student_id[]" value="{{$item->student_id}}"> <input type="text" name="student_name[]" value="{{$item->student->identity_number . ' - '.$item->student->name}}" required class="form-control mhs-name-{{$counter}}" /></td>
                                                <td><a href="javascript:void(0)" class="remove-row" title="Hapus"> <button type="button" class="btn btn-info btn-icon-anim btn-square"><i class="icon-trash"></i></button></a></td>
                                            </tr>
                                        <?php $counter++;?>
                                        @endforeach
                                    </tbody>
                                </table>
                                <br>
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-success btn-anim"><i class="icon-rocket"></i><span class="btn-text">submit and next step</span></button>
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
        initItemSelect2('.select2', '{{url("api/student")}}');

        
        /* Add document */
        var tb_document = $('#document').DataTable({
            bSort: false,
            bPaginate: false,
            bInfo: false,
            bFilter: false,
            bScrollCollapse: false
        });
        counter = {{$counter}};

        function addStudent(id) {
            var textarea = $('#student-id').val();
            var name = $('.select2 option:selected').text();
            var array_student_id = $("input[name='student_id[]']").map(function(){return $(this).val();}).get();
            if (array_student_id.includes(id)) {
                notification('Error','Data sudah ada didaftar');
            } else {
                addRowStudent(id, name);
            }
        }

        function addRowStudent(id, name) {
            tb_document.row.add( [
                `<input type="hidden" name="student_id[]" value="`+id+`"> <input type="text" name="student_name[]" value="`+name+`" required class="form-control mhs-name-`+counter+`" />`,
                `<a href="javascript:void(0)" class="remove-row" title="Hapus"> <button type="button" class="btn btn-info btn-icon-anim btn-square"><i class="icon-trash"></i></button></a>`,
            ] ).draw( false );
            counter++;
        }

        $('#document tbody').on('click', '.remove-row', function () {
            tb_document.row($(this).parents('tr')).remove().draw();
        });

        /**
        function addStudent(data) {
            var group_id = $('#group_id').val();
            var student_id = data.value;
            $.ajax({
                url: '{{url("group/temp-add-student")}}',
                type: 'post',
                data: {student_id: student_id, group_id: group_id},
                success: function (res) {
                    console.log(res);
                },
                error: function (res) {
                    console.log(res);
                    swal('Woop, Error');
                }
            })
        }

        */
    </script>
@endsection