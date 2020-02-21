@extends('layout.master')

@section('title')
{{ trans('app.choose_year') }}
@endsection

@section('content')
    <!-- Page-header start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="icofont icofont-layout bg-c-blue"></i>
                    <div class="d-inline">
                        <h4>{{ trans('app.choose_year') }}</h4>
                        <span>{{ trans('app.event_list') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{url('/')}}">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                <li class="breadcrumb-item"><a href="#!">{{ trans('app.choose_year') }}</a>
                </li>
            </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page-header end -->




    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <!-- Search result card start -->
                <div class="card">
                <div class="card-block  panels-wells">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3">
                            <p class="txt-highlight text-center m-t-20">{{ trans('app.detail_choose_year') }}</p>
                        </div>
                    </div>
                    <div class="row seacrh-header">
                        <div class="col-lg-6 offset-lg-3 offset-sm-6 col-sm-6 offset-sm-1 col-xs-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading bg-primary">
                                    {{ trans('app.choose_year') }}
                                </div>
                                <div class="panel-body">
                                            <p>{{ trans('app.detail_choose_year') }}</p>
                                            <div class="form-group">
                                                <select id="tahun" name="tahunpkm" class="form-control">
                                                    @foreach ($thn as $d)
                                                    <option value="{{ $d->id }}">{{ $d->tahun }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="panel-footer text-primary">
                                            <button id="goLink" type="submit" class="btn btn-sm btn-primary">{{ trans('app.search') }}</button>
                                        </div>
                                    </form>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Search result card end -->

        </div>
    </div>
</div>
@endsection

@section('footer')
<script>
$('#goLink').click(function(){
 var thn = $('#tahun').val();
 window.open('{{url("event")}}?tahun='+thn,'_self');
});
</script>
@endsection
