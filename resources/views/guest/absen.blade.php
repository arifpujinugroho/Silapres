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
                        <div class="form-group">
                          <select class="form-control" id="tipeabsen">
                            <option value="in">{{trans('app.come')}}</option>
                            <option value="out">{{ trans('app.out') }}</option>
                          </select>
                        </div>
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

        </dic>
        <!-- statstic card end -->


        <div class="col-md-8 col-xl-8 col-sm-12">
            <div class="col-md-12">
                <div class="card card-contact-box ">
                    <div class="card-block ">
                        <div class="card-contain text-center">
                            <h6 class="f-w-400 f-20 text-uppercase p-b-5 m-0 p-t-15 " id="presensiName">#{{ trans('app.full_name') }}</h6>
                            <a href="#!" id="presensiIdentity">{{ trans('app.identity') }}</a>
                            <p class="text-muted p-b-25 m-0 p-t-5 " id="presensiInstution">{{ trans('app.institution') }}</p>
                            <div class="contain-card p-t-30 p-b-10 ">
                            </div>
                        </div>
                    </div>
                    <div class="b-t-default">
                        <div class="row m-0">
                            <h5 class="col-6  text-center text-primary b-r-default p-t-15 p-b-15 ">
                                <i class="icofont icofont-sign-in m-r-10 "></i>{{trans('app.come')}} :
                                <p class=" m-0 d-inline-block" id="presensiDatang">#{{ trans('app.time') }}</p>
                            </h5>
                            <h5 class="col-6 text-center text-primary p-t-15 p-b-15 ">
                                <i class="icofont icofont-sign-out m-r-10 "></i> {{ trans('app.out') }} :
                                <p class="m-0 d-inline-block " id="presensiPulang"># {{ trans('app.time') }}</p>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('end')

<!-- Modal -->
<div class="modal fade" id="modelLoading" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body text-center text-primary">
                <strong><h1 class=" display-1"><i class="fa fa-refresh rotate-refresh"></i>
                </h1>Loading..</strong>
            </div>
        </div>
    </div>
</div>
@endsection
