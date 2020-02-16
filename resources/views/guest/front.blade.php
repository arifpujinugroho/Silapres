@extends('layout.master')

@section('title')
{{ trans('app.front_page') }}
@stop

@section('header')
<link rel="stylesheet" type="text/css" href="{{url('assets/css/simple-line-icons.cs')}}s">
<link rel="stylesheet" type="text/css" href="{{url('assets/css/ionicons.css')}}">
@endsection

@section('content')

@if (session('register') == "success")
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    <strong>Success</strong> Silakan cek email student anda untuk aktivasi Akun.
</div>
@endif
<!-- Page-header start -->
<div class="page-header card">
    <div class="row align-items-end">
        <div class="col-lg-10">
            <div class="">
                <h2 class="">{{ trans('app.attendance') }}</h2>
            </div>
        </div>
    </div>
</div>
<!-- Page-header end -->
<div class="row">
        <!-- Client Map Start -->
        <div class="col-lg-6 offset-lg-3 offset-sm-12 col-sm-10 offset-sm-1 col-xs-12">
            <div class="card client-map">
                <div class="card-block">
                    <h5>{{ trans('auth.login') }}</h5>
                    <hr>
                    <form action="{{url('/authlogin')}}" method="post">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="username" id="username" class="form-control"
                                placeholder="{{ trans('auth.email') }}" value="{{request('username')}}" autofocus
                                required>
                        </div>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control"
                                value="{{request('password')}}" placeholder="{{ trans('auth.password') }}" required>
                        </div>
                        <button type="submit"
                            class="btn btn-sm btn-success btn-block">{{ trans('auth.login') }}</button>
                    </form> <br>
                    <a href="{{url('/loginsso')}}"><button type="button" class="btn btn-primary btn-block"><i
                                class="fa fa-user"></i>&nbsp; {{ trans('auth.login_sso') }}</button></a>
                </div>
            </div>
        </div>

        <!-- <div class="col-md-4">
        <div class="card client-map">
            <div class="card-block">
                <h5>Status Aktif PKM</h5>
                <br>
                <table class="table">
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card client-map">
            <div class="card-block">
                <h5>Tutorial Registrasi dan Unggah Proposal</h5>
                <hr>
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/AkvCPVWeVrQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <br><br>
                <h5>AFTERMOVIE PIMNAS 32</h5>
                <hr>
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/CnJzRut-I_0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div> -->

        <!-- Modal -->
        <div class="modal fade" id="pengumumanModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    {{--<div class="modal-header bg-danger">
                <h5 class="modal-title">Pengumuman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>--}}
                    <div class="modal-body">
                        <!--img src="{{url('assets/images/pengumuman_intenal.png')}}" alt="Pengumuman" class="img-fluid rounded"-->
                    </div>
                    {{--<div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
            </div>--}}
                </div>
            </div>
        </div>
        @endsection

        @section('footer')
        <script>
            $(document).ready(function () {
                //$("#pengumumanModal").modal('show');
            });

        </script>
        @endsection
