@extends('layout.master')

@section('title')
{{ $e->nama_event }}
@stop

@section('footer')
@include('guest.absen_footer')
@endsection

@section('header')
<link rel="stylesheet" type="text/css" href="{{url('assets/css/simple-line-icons.cs')}}s">
<link rel="stylesheet" type="text/css" href="{{url('assets/css/ionicons.css')}}">
@endsection

@section('content')
<div class="page-body">
    <div class="row">
    <!-- statstic card start -->
        <dic class="col-md-4 col-xl-4 col-sm-12">
            <div class="col-md-12">
                <div class="card widget-statstic-card">
                    <div class="card-header">
                        <div class="card-header-left">
                            <h5>{{ trans('app.event') }}</h5>
                            <p class="p-t-10 m-b-0 text-c-blue">{{ $e->nama_event }}</p>
                        </div>
                    </div>
                    <div class="card-block">
                        <i class="icofont  icofont-presentation-alt st-icon bg-c-blue"></i>
                        <input type="text" class="form-control" id="identitas"  placeholder="{{ trans('app.identity_number') }} / {{ trans('auth.email') }}">
                    </div>
                </div>
            </div>
            <!-- statstic card start -->
            <div class="col-md-12">
                <div class="card widget-statstic-card">
                    <div class="card-header">
                        <div class="card-header-left">
                            <h5>{{ trans('app.audience') }}</h5>
                            <p class="p-t-10 m-b-0 text-c-pink">#N/A {{ trans('app.audience') }}</p>
                        </div>
                    </div>
                    <div class="card-block">
                        <i class="icofont icofont-users-social st-icon bg-c-pink txt-lite-color"></i>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-12">
                <div class="card widget-statstic-card">
                    <div class="card-header">
                        <div class="card-header-left">
                            <h5>{{ trans('app.time') }}</h5>
                            <p class="p-t-10 m-b-0 text-c-yellow" id="timeServer"></p>
                        </div>
                    </div>
                    <div class="card-block">
                        <i class="icofont icofont-chart-line st-icon bg-c-yellow"></i>
                    </div>
                </div>
            </div> -->

        </dic>
        <!-- statstic card end -->


        <div class="col-md-8 col-xl-8 col-sm-12">
            <div class="col-md-12">
                <div class="card card-contact-box ">
                    <div class="card-block ">
                        <div class="card-contain text-center">
                            <h6 class="f-w-400 f-20 text-uppercase p-b-5 m-0 p-t-15 ">#{{ trans('app.full_name') }}</h6>
                            <a href="#!">{{ trans('app.identity') }}</a>
                            <p class="text-muted p-b-25 m-0 p-t-5 ">{{ trans('app.institution') }}</p>
                            <div class="contain-card p-t-30 p-b-10 ">
                            </div>
                        </div>
                    </div>
                    <div class="b-t-default">
                        <div class="row m-0">
                            <div class="col-6  text-center b-r-default p-t-15 p-b-15 ">
                                <i class="icofont icofont-ui-clock text-muted m-r-10 "></i>
                                <p class="text-muted m-0 text-uppercase d-inline-block ">#{{ trans('app.time') }}</p>
                            </div>
                            <div class="col-6 text-center p-t-15 p-b-15 ">
                                <i class="icofont icofont-ui-calendar text-muted m-r-10 "></i>
                                <p class="text-muted m-0 d-inline-block ">
                                @if(Lang::locale() == "en")
                                {{ date('F dS, Y') }}
                                @elseif(Lang::locale() == "jp")
                                {{ date('Y') }}年 {{date('m')}}月 {{date('d')}}日
                                @elseif(Lang::locale() == "kr")
                                {{ date('Y') }}년 {{date('m')}}월 {{date('d')}}일
                                @elseif(Lang::locale() == "id")
                                {{ tglIndo(date('Y-m-d'), false) }}
                                @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
@endsection
