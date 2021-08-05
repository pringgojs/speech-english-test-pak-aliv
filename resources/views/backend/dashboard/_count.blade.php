
<div class="row">
    <a href="{{url('student')}}">
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view pa-0">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box bg-red">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                    <span class="txt-light block counter"><span class="counter-anim">{{format_quantity(\App\Models\Student::count())}}</span></span>
                                    <span class="weight-500 uppercase-font txt-light block font-13">Student</span>
                                </div>
                                <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                    <i class="fa fa-graduation-cap txt-light data-right-rep-icon"></i>
                                </div>
                            </div>	
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </a>
    <a href="{{url('topic')}}">
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view pa-0">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box bg-yellow">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                    <span class="txt-light block counter"><span class="counter-anim">{{format_quantity(\App\Models\Topic::count())}}</span></span>
                                    <span class="weight-500 uppercase-font txt-light block">Topic</span>
                                </div>
                                <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                    <i class="fa fa-file-o txt-light data-right-rep-icon"></i>
                                </div>
                            </div>	
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </a>

    <a href="{{url('question')}}">
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view pa-0">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box bg-green">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                    <span class="txt-light block counter"><span class="counter-anim">{{format_quantity(\App\Models\Question::count())}}</span></span>
                                    <span class="weight-500 uppercase-font txt-light block">Question</span>
                                </div>
                                <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                    <i class="fa fa-bullhorn txt-light data-right-rep-icon"></i>
                                </div>
                            </div>	
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </a>

    <a href="{{url('user')}}">
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view pa-0">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box bg-blue">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                    <span class="txt-light block counter"><span class="counter-anim">{{format_quantity(\App\User::count())}}</span></span>
                                    <span class="weight-500 uppercase-font txt-light block">User</span>
                                </div>
                                <div class="col-xs-6 text-center  pl-0 pr-0 pt-25  data-wrap-right">
                                    <i class="fa fa-user txt-light data-right-rep-icon"></i>
                                </div>
                            </div>	
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </a>
</div>
