@extends('layout.master')

@section('title')
{{Auth::user()->name}}
@endsection

@section('header')

@endsection

@section('content')
    <!-- Page-header start -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="icofont icofont-listine-dots bg-c-lite-green"></i>
                    <div class="d-inline">
                        <h4>{{ trans('app.identity') }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                     <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">{{ trans('app.identity') }}</a>
                </li>
            </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Page body start -->
    <div class="page-body">
            <div class="row">
                <div class="col-md-12">
                    <!-- Product detail page start -->
                    <div class="card product-detail-page">
                        <div class="card-block">
                            <div class="row">
                                <div class="col-lg-5 col-xs-12">
                                    <div class="port_details_all_img row">
                                        <div class="col-lg-12 m-b-15">
                                            <div id="big_banner">
                                                <div class="port_big_img">
                                                    <img class="img img-fluid" src="{{url('assets/uny.png')}}" alt="Foto {{Auth::user()->name}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-xs-12 product-detail">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="btn-group f-right">
                                            </div>
                                        </div>
                                        <div>
                                            <div class="col-lg-12">
                                                <h1 class="pro-desc f-w-300 text-capitalize"><strong> {{Auth::user()->name}} </strong></h1>
                                            </div>
                                        </div>
                                            <div class="col-lg-12">
                                                    <span class="text-primary product-price">{{Auth::user()->level}}</span>
                                                <br>
                                                <hr>
                                                <br>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="btn-group f-right">
                                                </div>
                                                <p><strong>{{ trans('auth.email') }} : </strong> {{Auth::user()->email}}</p>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product detail page end -->
                </div>
            </div>
        </div>
        <!-- Page body end -->
@endsection

@section('end')
<!-- Modal -->
<div class="modal fade" id="modalBukti" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form action="{{url('uploadbukti')}}" method="post" class="form-validation" id="number_form"  enctype="multipart/form-data">
            @csrf
            <div class="modal-body" id="bodyfile">
            </div>
            <div class="modal-body" id="bodybukti">
                <div class="form-group" id="filebukti">
                    <label for="formBukti">Foto Bukti Pembayaran</label>
                    <input type="file" class="form-control" name="formBukti" id="formBukti" placeholder="Foto Bukti Pembayaran">
                    <small id="fileHelpId" class="form-text text-danger">Max file 5MB dan berformat gambar</small>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btnSimpanBukti" class="btn btn-mini btn-success">Upload</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection


@section('footer')
    <script src="{{url('assets/custom/dashboard.js')}}"></script>


<script>
(function($) {
        $.fn.checkFileType = function(options) {
            var defaults = {
                allowedExtensions: [],
                success: function() {},
                error: function() {}
            };
            options = $.extend(defaults, options);

            return this.each(function() {

                $(this).on('change', function() {
                    var value = $(this).val(),
                        file = value.toLowerCase(),
                        extension = file.substring(file.lastIndexOf('.') + 1);

                    if ($.inArray(extension, options.allowedExtensions) == -1) {
                        options.error();
                        $(this).focus();
                    } else {
                        options.success();

                    }

                });

            });
        };

    })(jQuery);

    var uploadField = document.getElementById("formBukti");
    uploadField.onchange = function() {
        if(this.files[0].size > 5055650){
            new PNotify({
                    title: 'File Oversize',
                    text: 'Maaf, File Max 5MB ',
                    type: 'error'
            });
            console.log("file size = " + this.files[0].size + "/5055650")
            this.value = "";
        };
    };

    $(function() {
        $('#formBukti').checkFileType({
            allowedExtensions: ['jpg', 'jpeg','png'],
            error: function() {
                new PNotify({
                    title: 'File not Image',
                    text: 'Maaf, hanya type image yang diupload ',
                    type: 'error'
                });
                document.getElementById("formBukti").value = "";
            }
        });
    });
</script>
@endsection
