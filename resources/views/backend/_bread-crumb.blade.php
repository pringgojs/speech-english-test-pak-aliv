<div class="row heading-bg">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h5 class="txt-dark">{{$title}}</h5>
    </div>
    <!-- Breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            @for($i=0; $i<count($breadcrumbs); $i++)
                <li><a href="{{$breadcrumbs[$i]['link']}}" @if($i == count($breadcrumbs))  class="active"  @endif>{{$breadcrumbs[$i]['label']}}</a></li>
            @endfor
        </ol>
    </div>
    <!-- /Breadcrumb -->
</div>