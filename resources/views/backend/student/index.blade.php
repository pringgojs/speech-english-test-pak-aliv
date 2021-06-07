@extends('layouts.app')

@section('content')
    <!-- Title -->
    @include('backend._bread-crumb', [
        'title' => 'Student',
        'breadcrumbs' => [
            0 => [
                'link' => url('/'),
                'label' => 'dashboard'
            ],
            1 => [
                'link' => '#',
                'label' => 'Student'
            ],
        ]
    ])
    
    <!-- /Title -->
    
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        
                        <h6 class="panel-title txt-dark">Student</h6>
                    </div>
                    <div class="pull-right">
                        @if(access_is_allowed_to_view('create.student'))
                        <a class="btn btn-sm btn-primary " href="{{url('student/create')}}">Buat baru</a>
                        <a class="btn btn-sm btn-default " href="{{url('student/import')}}">Import Data</a>
                        @endif
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
                                            <th>Identity Number</th>
                                            <th>Account</th>
                                            <th>Created At</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($students as $row => $student)
                                        <tr id="tr-{{$student->id}}">
                                            <td>{{$row + 1}}</td>
                                            <td>{{$student->name}}</td>
                                            <td>{{$student->identity_number}}</td>
                                            <td>Username: {{$student->user->username}} <br> password: {{$student->password}}</td>
                                            <td>{{date_format_view($student->created_at)}}</td>
                                            <td>
                                                @if(access_is_allowed_to_view('update.student'))
                                                <a href="{{url('student/'.$student->id.'/edit')}}" data-toggle="tooltip" data-original-title="Edit">
                                                    <button class="btn btn-default btn-icon-anim btn-square btn-sm"><i class="fa fa-pencil"></i></button>
                                                </a>
                                                @endif
                                                @if(access_is_allowed_to_view('delete.student'))
                                                <a onclick="secureDelete('{{url('student/'.$student->id)}}', '#tr-{{$student->id}}')" onclick="document.getElementById('form-delete-{{$student->id}}').submit();"  data-toggle="tooltip" data-original-title="Close">
                                                    <button class="btn btn-info btn-icon-anim btn-square  btn-sm"><i class="icon-trash"></i></button>                                                    
                                                </a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach

                                        @if ($students->count() == 0)
                                        <tr><td colspan="4">no data can be displayed
                                        </td></tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            {{$students->links()}}
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
    // initDatatable('#datatable');
</script>
@stop