@extends('layout.master')

@section('title')
{{ trans('app.event') }}
@endsection

@section('header')
<!-- Data Table Css -->
<link rel="stylesheet" type="text/css" href="{{url('assets/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('assets/pages/data-table/css/buttons.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('assets/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('assets/pages/data-table/extensions/buttons/css/buttons.dataTables.min.css')}}">
@endsection

@section('content')
<!-- Page-body start -->
<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li id="reload-tabel" data-toggle="tooltip" title="Refresh Tabel"><i class="icofont icofont-refresh"></i></li>
                        </ul>
                    </div>
        </div>
        <div class="card-block">
            <div>
                <table id="memberTable" class="table table-striped" width="100%">
                    <thead>
                        <th>{{ trans('app.action') }}</th>
                        <th>{{ trans('app.event_name') }}</th>
                        <th>{{ trans('app.event_date') }}</th>
                        <th>{{ trans('app.event_location') }}</th>
                        <th>{{ trans('app.pic_event') }}</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <!-- Basic Button table end -->
</div>
</div>
</div>
<!-- Page-body end -->
@endsection

@section('end')
<!-- Modal -->
<div class="modal fade" id="lihatSurat" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="labellihatToko"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-mini btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection


@section('footer')
<!-- data-table js -->
<script>
$(document).ready(function() {
    var thisurl = $('#thisurl').val();

    var table = $('#memberTable').DataTable({
        'serverMethod': 'get',
        "paging": true,
        "processing": true,
        "ordering": true,
        'responsive':true,
        "info": true,
        //"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "language": {
            @if(Lang::locale() == 'kr')
            "url": "{{ url('assets/json/kr.json') }}"
            @elseif(Lang::locale() == 'en')
            "url": "{{ url('assets/json/en.json') }}"
            @elseif(Lang::locale() == 'id')
            "url": "{{ url('assets/json/id.json') }}"
            @elseif(Lang::locale() == 'jp')
            "url": "{{ url('assets/json/jp.json') }}"
            @endif
        },
        'ajax': {
            'url': thisurl+'/listevent',
            'dataSrc': '',
        },
        'columns': [
            {
                data: null,
                render: function(data, type, full, row) {
                    return '<img src="'+thisurl+'/files/pasfoto/'+data.foto+'" alt="foto '+data.name+'" data-file="'+data.foto+'" data-nama="'+data.name+'" class="pasfoto img img-rounded img-50"> '+data.name;
                }
            },
            {
                data : 'nama_event'
            },
            {
                data : 'tgl_event'
            },
            {
                data : 'lokasi_event'
            },
            {
                data : 'penanggung_jawab'
            },
        ]
    });

    $('#reload-tabel').click(function() {
        table.ajax.reload();
    });

    $('#memberTable tbody').on('click', '.pasfoto', function() {
        var file = $(this).data('file');
        var nama = $(this).data('nama');
        $('#labellihatToko').html('Lihat Foto '+nama);
        $('#lihatBody').html('<img class="img img-fluid" src="'+thisurl+'/files/pasfoto/'+file+'">');
        $('#lihatSurat').modal('show');
    });

    $('#memberTable tbody').on('click', '.lihatBukti', function() {
        var file = $(this).data('file');
        var nama = $(this).data('nama');
        $('#labellihatToko').html('Bukti Pembayaran '+nama);
        $('#lihatBody').html('<img class="img img-fluid" src="'+thisurl+'/files/bukti/'+file+'">');
        $('#lihatSurat').modal('show');
    });


    $('#memberTable tbody').on('click', '.accAnggota', function() {
        var id = $(this).data('id');
        var nama = $(this).data('nama');

        swal({
            title: "Terima "+nama+"??",
            text: "Apakah anda ingin menerima "+nama+" sebagai anggota?",
            type: "info",
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: "Terima",
            closeOnConfirm: false
        }, function() {
            $.ajax({
                url: thisurl+'/accanggota',
                type: "GET",
                data: {
                    id: id,
                },
                success: function() {
                    table.ajax.reload();
                    swal(" Diterima", "Anda berhasil menerima "+nama, "success");
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    swal("Error Diterima!", "Silakan Coba Lagi", "error");
                }
            });
        });
    });

    $('#memberTable tbody').on('click', '.resetAnggota', function() {
        var id = $(this).data('id');
        var nama = $(this).data('nama');

        swal({
            title: "Reset akun "+nama+"??",
            text: "Apakah anda ingin mereset akun "+nama+"?",
            type: "warning",
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: "Reset",
            closeOnConfirm: false
        }, function() {
            $.ajax({
                url: thisurl+'/resetanggota',
                type: "GET",
                data: {
                    id: id,
                },
                success: function() {
                    table.ajax.reload();
                    swal("Akun Direset", "Password akun "+nama+" sama dengan email", "success");
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    swal("Error Direset!", "Silakan Coba Lagi", "error");
                }
            });
        });
    });
});


</script>
<script src="{{url('assets/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('assets/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{url('assets/pages/data-table/js/jszip.min.js')}}"></script>
<script src="{{url('assets/pages/data-table/js/pdfmake.min.js')}}"></script>
<script src="{{url('assets/pages/data-table/js/vfs_fonts.js')}}"></script>
<script src="{{url('assets/pages/data-table/extensions/buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{url('assets/pages/data-table/extensions/buttons/js/buttons.flash.min.js')}}"></script>
<script src="{{url('assets/pages/data-table/extensions/buttons/js/jszip.min.js')}}"></script>
<script src="{{url('assets/pages/data-table/extensions/buttons/js/vfs_fonts.js')}}"></script>
<script src="{{url('assets/pages/data-table/extensions/buttons/js/buttons.colVis.min.js')}}"></script>
<script src="{{url('assets/bower_components/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{url('assets/bower_components/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{url('assets/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('assets/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('assets/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

<script src="{{url('assets/pages/data-table/extensions/buttons/js/extension-btns-custom.js')}}"></script>
@endsection
