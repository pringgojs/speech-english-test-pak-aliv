@extends('layouts.app-front')

@section('content')
    <!-- Title -->
    @include('backend._bread-crumb', [
        'title' => 'Result',
        'breadcrumbs' => [
            0 => [
                'link' => '#',
                'label' => ''
            ]
        ]
    ])
    
    <!-- /Title -->

    <!-- Row -->
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                {{-- daftar kuis --}}
                <div class="col-sm-12 col-xs-12">
                    <div class="panel panel-default border-panel card-view">
                        <div class="panel-heading">
                            <div class="pull-left auto-width">
                                <h6 class="panel-title txt-dark">Your Result about "Introduction"</h6>
                            </div>
                            <div class="pull-right txt-primary">Total Score: 90</div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body pa-0 row">
                                
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table class="table table-hover mt-15 mb-0">
                                        <thead>
                                            <tr>
                                            <th>#</th>
                                            <th>Question</th>
                                            <th>Your Answer</th>
                                            <th>Score</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Tell me about yourself</td>
                                                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad sapiente maxime vitae libero odio commodi, vel, enim omnis, corrupti suscipit qui adipisci repellat consequuntur vero nemo reprehenderit totam voluptas tenetur.</td>
                                                <td>3</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Tell me about yourself</td>
                                                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad sapiente maxime vitae libero odio commodi, vel, enim omnis, corrupti suscipit qui adipisci repellat consequuntur vero nemo reprehenderit totam voluptas tenetur.</td>
                                                <td>3</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Tell me about yourself</td>
                                                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad sapiente maxime vitae libero odio commodi, vel, enim omnis, corrupti suscipit qui adipisci repellat consequuntur vero nemo reprehenderit totam voluptas tenetur.</td>
                                                <td>3</td>
                                            </tr>
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
    </div>
@stop

@section('scripts')
@stop