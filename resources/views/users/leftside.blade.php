<li class="{{ (Request::path() == '/') ? 'active' : '' }}">
    <a href="{{ url ('/')}}">
        <span class="pcoded-micon"><i class="ti-home"></i><b>H</b></span>
        <span class="pcoded-mtext" data-i18n="nav.dash.main">{{ trans('app.dashboard') }}</span>
        <span class="pcoded-mcaret"></span>
    </a>
</li>
<li class="{{ (Request::path() == 'anggota') ? 'active' : '' }}">
    <a href="{{ url ('/anggota')}}">
        <span class="pcoded-micon"><i class="ti-layout-media-right"></i><b>A</b></span>
        <span class="pcoded-mtext" data-i18n="nav.dash.main">{{ trans('app.event') }}</span>
        <span class="pcoded-mcaret"></span>
    </a>
</li>
