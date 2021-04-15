@if ($total > 0)
  <a href="#" class="dropdown-toggle" id="notif-total" total="{{$total}}" data-toggle="dropdown" aria-expanded="true"><i
    class="zmdi zmdi-notifications top-nav-icon"></i><span class="top-nav-icon-badge">{{$total}}</span></a>
  <ul class="dropdown-menu alert-dropdown" data-dropdown-in="bounceIn" data-dropdown-out="bounceOut">
    <li>
      <div class="notification-box-head-wrap">
        <span class="notification-box-head pull-left inline-block">notifications</span>
        <a class="txt-danger pull-right clear-notifications inline-block" href="javascript:void(0)"> 
        </a>
        <div class="clearfix"></div>
        <hr class="light-grey-hr ma-0">
      </div>
    </li>
    <li>
      <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 229px;">
        <div class="streamline message-nicescroll-bar" style="overflow: hidden; width: auto; height: 229px;">
          <?php $i=0;?>
          @foreach ($list_notification as $bunker_fee)
            
          <div class="sl-item">
            <a href="{{url('notification/all')}}">
              <div class="icon bg-green">
                <i class="zmdi zmdi-flag"></i>
              </div>
              <div class="sl-content">
                <span class="inline-block capitalize-font  pull-left truncate head-notifications">
                  {{$bunker_fee->user->name ?? '-'}} - {{date_format_view($bunker_fee->updated_at)}}</span>
                {{-- <span class="inline-block font-11  pull-right notifications-time">2pm</span> --}}
                <div class="clearfix"></div>
                <p class="truncate"> Bunker fee tanggal pelaksaan  {{date_format_view($bunker_fee->tanggal_pelaksanaan)}}</p>
              </div>
            </a>
          </div>
          @if ($i>0)
            <hr class="light-grey-hr ma-0">
          @endif
          <?php $i++;?>
          @endforeach
        </div>
        <div class="slimScrollBar"
          style="background: rgb(135, 135, 135); width: 4px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 0px; z-index: 99; right: 1px; height: 181.457px;">
        </div>
        <div class="slimScrollRail"
          style="width: 4px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;">
        </div>
      </div>
    </li>
    <li>
      <div class="notification-box-bottom-wrap">
        <hr class="light-grey-hr ma-0">
        <a class="block text-center read-all" href="{{url('notification/all')}}"> read all </a>
        <div class="clearfix"></div>
      </div>
    </li>
  </ul>

@else

<a href="#" class="dropdown-toggle" id="notif-total" total="0" data-toggle="dropdown" aria-expanded="true"><i
  class="zmdi zmdi-notifications top-nav-icon"></i></a>
<ul class="dropdown-menu alert-dropdown" data-dropdown-in="bounceIn" data-dropdown-out="bounceOut">
  <li>
    <div class="notification-box-head-wrap">
      <span class="notification-box-head pull-left inline-block">notifications</span>
      <a class="txt-danger pull-right clear-notifications inline-block" href="javascript:void(0)"> 
      </a>
      <div class="clearfix"></div>
      <hr class="light-grey-hr ma-0">
    </div>
  </li>
  <li>
    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 59px;">
      <div class="streamline message-nicescroll-bar" style="overflow: hidden; width: auto; height: 59px;">
        <div class="alert alert-info">Tidak ada notifikasi</div>
      </div>
    </div>
  </li>
</ul>
@endif