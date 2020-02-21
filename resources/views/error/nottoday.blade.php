<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$p->nama_event}} || SILAPRES</title>
    <meta property="og:description" content="{{$p->nama_event}} (@if(Lang::locale() == 'en'){{ date('F dS, Y', strtotime($p->tgl_event)) }} @elseif(Lang::locale() == 'jp'){{ date('Y', strtotime($p->tgl_event)) }}年 {{date('m', strtotime($p->tgl_event))}}月 {{date('d', strtotime($p->tgl_event))}}日 @elseif(Lang::locale() == 'kr') {{ date('Y', strtotime($p->tgl_event)) }}년 {{date('m', strtotime($p->tgl_event))}}월 {{date('d', strtotime($p->tgl_event))}}일 @elseif(Lang::locale() == 'id') {{ tglIndo($p->tgl_event, false) }} @endif)">
    <meta property="og:url" content="{{ url('/') }}">
    <?php
    date_default_timezone_set("Asia/Jakarta");
    $b = time();
    $hour = date("G",$b);
    ?>
    @if ($hour >= 18 || $hour <= 6 )
    <link rel="stylesheet" type="text/css" href="{{ url('assets/custom/nightmode.css') }}">
     @else
    <link rel="stylesheet" type="text/css" href="{{ url('assets/custom/daymode.css') }}">
     @endif
</head>
<body>
<div class="container">
	<div class="forbidden-sign"></div>
	<h1>{{trans('notif.access_denied')}}</h1>
	<p><strong>{{trans('notif.event_expired')}}</strong> <br> <small>{{trans('app.event_date')}} :
    @if(Lang::locale() == "en")
    {{ date('F dS, Y', strtotime($p->tgl_event)) }}
    @elseif(Lang::locale() == "jp")
    {{ date('Y', strtotime($p->tgl_event)) }}年 {{date('m', strtotime($p->tgl_event))}}月 {{date('d', strtotime($p->tgl_event))}}日
    @elseif(Lang::locale() == "kr")
    {{ date('Y', strtotime($p->tgl_event)) }}년 {{date('m', strtotime($p->tgl_event))}}월 {{date('d', strtotime($p->tgl_event))}}일
    @elseif(Lang::locale() == "id")
    {{ tglIndo($p->tgl_event, false) }}
    @endif</small></p>
</div>
</body>
</html>
