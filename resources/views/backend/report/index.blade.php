@extends('layouts.app')

@section('content')
    <!-- Title -->
    @include('backend._bread-crumb', [
        'title' => 'Report',
        'breadcrumbs' => [
            0 => [
                'link' => url('/'),
                'label' => 'dashboard'
            ],
            1 => [
                'link' => '#',
                'label' => 'Report'
            ],
        ]
    ])
    
    <!-- /Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <form method="get" action="{{url('report')}}">
                        {!! csrf_field() !!}
                        <?php 
                            $topic_id = \Input::get('topic_id');
                            $group_id = \Input::get('group_id');
                            $search = \Input::get('search');
                        ?>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="control-label mb-10 text-left">Search (Optional)</label>
                                <input type="text" class="form-control" value="{{$search}}" name="search" placeholder="Student">
                            </div>

                            <div class="col-md-3">
                                <label class="control-label mb-10 text-left">Topic</label>
                                <select name="topic_id" placeholder="" class="form-control" id="agen-ownuse-id">
                                    <option value="">All</option>
                                    @foreach ($topics as $topic)
                                    <option value="{{$topic->id}}" @if($topic_id == $topic->id ) selected @endif>{{$topic->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- <div class="col-md-3">
                                <label class="control-label mb-10 text-left">Jenis Kapal</label>
                                <select name="jenis_kapal_id" placeholder="" class="form-control" id="jenis-ownuse-id">
                                    <option value="">Semua</option>
                                    @foreach ($list_jenis_kapal as $kategori)
                                    <option value="{{$kategori->id}}" @if($jenis_kapal_id == $kategori->id ) selected @endif>{{$kategori->nama}}
                                    </option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <div class="col-md-3">
                                <label class="control-label mb-10 text-left">Group</label>
                                <select name="group_id" placeholder="" class="form-control" id="jenis-ownuse-id">
                                    <option value="">All</option>
                                    @foreach ($groups as $group)
                                    <option value="{{$group->id}}" @if($group_id == $group->id ) selected @endif>{{$group->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
    
                        <div class="row mt-10">
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-success btn-sm btn-anim">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <div class="dt-buttons">
                        </div>
                        <h6 class="panel-title txt-dark"></h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-hover display  pb-30" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Group</th>
                                            <th>Topic</th>
                                            <th>Question / Answer</th>
                                            <th>Score</th>
                                            <th>Created At</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($reports as $row => $report)
                                        <tr id="tr-{{$report->id}}">
                                            <td>{{$row + 1}}</td>
                                            <td>{{$report->student->name}}</td>
                                            <td>{{$report->group->name}}</td>
                                            <td>{{$report->topic->name}}</td>
                                            <td>
                                                <b>Q: </b>{{$report->question->question}} <br> 
                                                <b>A: </b>{!! $report->answerRender() !!} <br> 
                                            </td>
                                                
                                            <td>{{format_quantity($report->score)}}</td>
                                            <td>{{date_format_view($report->created_at)}}</td>
                                            <td>
                                                <a onclick="showDetail('{{url("report/detail/".$report->id)}}')" data-toggle="modal" data-target=".detail-modal"
                                                    data-toggle="tooltip" data-toggle="tooltip" data-original-title="Detail">
                                                    <button class="btn btn-dropbox btn-icon-anim btn-square btn-sm"><i class="fa fa-ellipsis-v"></i></button>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach

                                        @if ($reports->count() == 0)
                                        <tr><td colspan="4">no data can be displayed
                                        </td></tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            {{$reports->appends(['topic_id' => $topic_id, 'group_id' => $group_id, 'search' => $search])->links()}}
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
    $('select').select2();
</script>
@stop