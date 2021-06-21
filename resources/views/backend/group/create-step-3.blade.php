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
                        @include('backend.group._wizard', ['from' => 'step-3'])
                        <br><br>
                        <div class="form-wrap">
                            <form method="post" action="{{url('group/create-step-3')}}">
                                {!! csrf_field() !!}
                                <input type="hidden" name="group_id" value="{{$group->id}}">
                                <div class="form-group">
                                    <select class="form-control select2" name="topic" onchange="addTopic(this.value)">
                                    </select>
                                </div>

                                <table id="document" class="table table-responsive table-border" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Topic</th>
                                            <th style="width:5%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $counter = 0;?>
                                        @foreach ($group->topic as $item)
                                            <tr>
                                                <td><input type="hidden" name="topic_id[]" value="{{$item->topic_id}}"> <input type="text" name="topic_name[]" value="{{$item->topic->name}}" required class="form-control mhs-name-{{$counter}}" /></td>
                                                <td><a href="javascript:void(0)" class="remove-row" title="Hapus"> <button type="button" class="btn btn-info btn-icon-anim btn-square"><i class="icon-trash"></i></button></a></td>
                                            </tr>
                                        <?php $counter++;?>
                                        @endforeach
                                    </tbody>
                                </table>
                                <br>
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
        initItemSelect2('.select2', '{{url("api/topic")}}');

        var array_topic_id = [];
        /* Add document */
        var tb_document = $('#document').DataTable({
            bSort: false,
            bPaginate: false,
            bInfo: false,
            bFilter: false,
            bScrollCollapse: false
        });
        
        counter = {{$counter}};

        function addTopic(id) {
            var textarea = $('#topic-id').val();
            var name = $('.select2 option:selected').text();
            var array_topic_id = $("input[name='topic_id[]']").map(function(){return $(this).val();}).get();
            if (array_topic_id.includes(id)) {
                notification('Error','Data sudah ada didaftar');
            } else {
                addRowStudent(id, name);
            }
        }

        function addRowStudent(id, name) {
            tb_document.row.add( [
                `<input type="hidden" name="topic_id[]" value="`+id+`"> <input type="text" name="topic_name[]" value="`+name+`" required class="form-control mhs-name-`+counter+`" />`,
                `<a href="javascript:void(0)" class="remove-row" title="Hapus"> <button type="button" class="btn btn-info btn-icon-anim btn-square"><i class="icon-trash"></i></button></a>`,
            ] ).draw( false );
            counter++;
        }

        $('#document tbody').on('click', '.remove-row', function () {
            tb_document.row($(this).parents('tr')).remove().draw();
        });
    </script>
@endsection