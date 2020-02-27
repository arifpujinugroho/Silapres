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
<input type="hidden" id="thisyear" value="{{request('tahun')}}">
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
                        <th>{{ trans('app.event_tipe') }}</th>
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
                <input type="hidden" id="kode_event">
                <div class="form-group">
                  <label for="">{{trans('app.event_name')}} <strong class="text-danger">*</strong></label>
                  <input type="text" class="form-control" id="event_name" aria-describedby="helpId" placeholder="{{trans('app.event_name')}}">
                </div>
                <div class="form-group">
                  <label for="">{{trans('app.event_date')}} <strong class="text-danger">*</strong></label>
                  <input type="date" class="form-control" id="event_date" aria-describedby="helpId" placeholder="{{trans('app.event_date')}}">
                </div>
                <div class="form-group">
                  <label for="">{{trans('app.event_location')}} <strong class="text-danger">*</strong></label>
                  <input type="text" class="form-control" id="event_location" aria-describedby="helpId" placeholder="{{trans('app.event_location')}}">
                </div>
                <div class="form-group">
                  <label for="event_tipe">{{trans('app.event_tipe')}} <strong class="text-danger">*</strong></label>
                  <select class="form-control" name="event_tipe" id="event_tipe">
                    <option value="">-- {{trans('app.event_tipe')}} --</option>
                    <option value="1">{{trans('app.event_open')}}</option>
                    <option value="2">{{trans('app.event_spesial')}}</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="">{{trans('app.pic_event')}}</label>
                  <input type="text" class="form-control" id="event_pic" aria-describedby="helpId" placeholder="{{trans('app.pic_event')}}">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn_save_event" class="btn btn-mini btn-success">{{ trans('app.save') }}</button>
                <button type="button" id="btn_edit_event" class="btn btn-mini btn-warning">{{ trans('app.edit') }}</button>
                <button type="button" class="btn btn-mini btn-secondary" data-dismiss="modal">{{ trans('app.close') }}</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="shareLink" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{trans('app.open_attendance')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body text-center">
                <h5 class="namaEvent"></h5><hr>

                <button class="btn btn-mini btn-primary" id="btn_open_tab"><i class="fa fa-user" aria-hidden="true"></i>{{trans('app.open_newtab')}}</button>
                <button class="btn btn-mini btn-default" id="btn_share_modal"><i class="fa fa-share-alt" aria-hidden="true"></i>{{trans('app.share_event')}}</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="waLink" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{trans('app.open_attendance')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body text-center">
                <div class="form-group">
                  <label for="">{{ trans('app.wa_number') }}</label>
                  <input type="number" class="form-control" id="nomerWa" aria-describedby="helpId" placeholder="{{trans('app.example')}} : 62858859945XX">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-mini btn-default" id="btn_share_wa"><i class="fa fa-share-alt" aria-hidden="true"></i>{{trans('app.share_event')}}</button>
            </div>
        </div>
    </div>
</div>
@endsection


@section('footer')
<!-- data-table js -->
<script>
$(document).ready(function() {
    var token       = $('#token').val();
    var thisurl     = $('#thisurl').val();
    var datenow     = $('#datenow').val();
    var lang        = $('#language').val();
    var thisyear    = $('#thisyear').val();

    var table = $('#memberTable').DataTable({
        'dom': 'Bfrtip',
        'buttons': [
            {
                text: '{{ trans("app.add_event") }}',
                className: 'btn-mini',
                action: function(e, dt, node, config) {
                   $('#labellihatToko').html('{{trans("app.add_event")}}');
                   $('#kode_event').val('');
                   $('#event_name').val('');
                   $('#event_date').val('');
                   $('#event_location').val('');
                   $('#event_pic').val('');
                   $('#event_tipe').val('');

                   $('#btn_save_event').show();
                   $('#btn_edit_event').hide();
                   $('#lihatSurat').modal('show');
                }
            },
        ],
        'serverMethod': 'get',
        "paging": true,
        "processing": true,
        "ordering": true,
        'responsive':true,
        "info": true,
        //"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "language": {
            "url": thisurl+'/assets/json/'+lang+'.json'
        },
        'ajax': {
            'url': thisurl+'/listevent?tahun='+thisyear,
            'dataSrc': '',
        },
        'columns': [
            {
                data: null,
                render: function(data, type, full, row) {
                    return '<a data-toggle="tooltip" title="{{trans("app.event")}}" href="'+thisurl+'/event/'+data.keys_event+'"><button class="btn btn-mini btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></button></a>'+
                    '<button data-toggle="tooltip" title="{{trans("app.edit_event")}}" data-key="'+data.keys_event+'" data-nama="'+data.nama_event+'" data-tgl="'+data.tgl_event+'" data-lokasi="'+data.lokasi_event+'" data-pic="'+data.penanggung_jawab+'" data-tipe="'+data.tipe_event+'" class="editEvent btn btn-mini btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></button>'+
                    '<button data-toggle="tooltip" title="{{trans("app.open_attendance")}}" data-key="'+data.keys_event+'"  data-nama="'+data.nama_event+'" class="shareEvent btn btn-mini btn-secondary"><i class="fa fa-share" aria-hidden="true"></i></button></a>';
                }
            },
            {
                data : 'nama_event'
            },
            {
                data: null,
                render: function(data, type, full, row) {
                    if(data.tgl_event == datenow){
                    return data.tgl_event+' <i class="fa fa-circle text-success"></i>';
                    }else{
                    return data.tgl_event+' <i class="fa fa-circle text-danger"></i>';
                    }
                }
            },
            {
                data : 'lokasi_event'
            },
            {
                data: null,
                render: function(data, type, full, row) {
                    if(data.tipe_event == 1){
                    return "{{trans('app.event_open')}}";
                    }else{
                        return "{{trans('app.event_spesial')}}";
                    }
                }
            },
            {
                data : 'penanggung_jawab'
            },
        ]
    });


    $('#reload-tabel').click(function() {
        table.ajax.reload();
    });

    $('#memberTable tbody').on('click', '.shareEvent', function() {
        var key = $(this).data('key');
        var nama = $(this).data('nama');
        $('#shareLink .namaEvent').html(nama);
        $('#kode_event').val(key);
        $('#shareLink').modal('show');
    });

    $('#memberTable tbody').on('click', '.editEvent', function() {
        $('#kode_event').val($(this).data('key'));
        $('#event_name').val($(this).data('nama'));
        $('#event_date').val($(this).data('tgl'));
        $('#event_location').val($(this).data('lokasi'));
        $('#event_pic').val($(this).data('pic'));
        $('#event_tipe').val($(this).data('tipe'));
        $('#labellihatToko').html('{{trans("app.edit_event")}}');

        $('#btn_save_event').hide();
        $('#btn_edit_event').show();
        $('#lihatSurat').modal('show');
    });

    $('#btn_open_tab').click(function(){
        var keys = $('#kode_event').val();
        $('#shareLink').modal('hide');
        window.open(thisurl+'/presensi?kunci='+keys,'_blank');
    });

    $('#btn_share_modal').click(function(){
        $('#nomerWa').val('');
        $('#shareLink').modal('hide');
        $('#waLink').modal('show');
    });

    $('#btn_share_wa').click(function(){
        var keys = $('#kode_event').val();
        var wa = $('#nomerWa').val();
        if(wa == ""){
            new PNotify({
	        	title: '{{ trans("notif.form_empty") }}',
	        	text: '{{ trans("notif.form_check") }}',
	        	icon: 'icofont icofont-info-circle',
	        	type: 'error'
	        });
        }else{
            $('#waLink').modal('hide');
            window.open('https://api.whatsapp.com/send?phone='+wa+'&text='+encodeURI(thisurl)+'%2Fpresensi?kunci='+keys,'_blank');
        }
    });

    $('#btn_save_event').click(function(){
        var name = $('#event_name').val();
        var date = $('#event_date').val();
        var location = $('#event_location').val();
        var pic = $('#event_pic').val();
        var tipe = $('#event_tipe').val();

        if(name != "" && date != "" && location != "" && tipe != ""){
                $.post("{{ URL::to('/addevent') }}", {
                    _token : token,
	            	name: name,
	            	date: date,
                    location: location,
                    pic : pic,
                    tipe : tipe
	            })
	            .done(function(result) {
	            		if ($.isNumeric(result)) {
                            $('#lihatSurat').modal('hide');
                            table.ajax.reload();
                            swal("{{trans('notif.success')}}", "{{trans('notif.data_save')}}", "success");
	            		} else {
                            new PNotify({
	                        	title: '{{ trans("notif.wrong_server") }}',
	                        	text: '{{ trans("notif.reload_page") }}',
	                        	icon: 'icofont icofont-info-circle',
	                        	type: 'error'
	                        });
	            		};
	            })
	            .fail(function() {
                    new PNotify({
	                	title: '{{ trans("notif.wrong_server") }}',
	                	text: '{{ trans("notif.reload_page") }}',
	                	icon: 'icofont icofont-info-circle',
	                	type: 'error'
	                });
                });
        }else{
            new PNotify({
	        	title: '{{ trans("notif.form_empty") }}',
	        	text: '{{ trans("notif.form_check") }}',
	        	icon: 'icofont icofont-info-circle',
	        	type: 'error'
	        });
        }
    });

    $('#btn_edit_event').click(function(){
        var key =$('#kode_event').val();
        var name = $('#event_name').val();
        var date = $('#event_date').val();
        var location = $('#event_location').val();
        var pic = $('#event_pic').val();
        var tipe = $('#event_tipe').val();

        if(name != "" && date != "" && location != "" && tipe != ""){
                $.post("{{ URL::to('/editevent') }}", {
                    _token : token,
	            	key: key,
	            	name: name,
	            	date: date,
                    location: location,
                    pic : pic,
                    tipe : tipe
	            })
	            .done(function(result) {
	            		if ($.isNumeric(result)) {
                            $('#lihatSurat').modal('hide');
                            table.ajax.reload();
                            swal("{{trans('notif.success')}}", "{{trans('notif.data_edit')}}", "success");
	            		} else {
                            new PNotify({
	                        	title: '{{ trans("notif.wrong_server") }}',
	                        	text: '{{ trans("notif.reload_page") }}',
	                        	icon: 'icofont icofont-info-circle',
	                        	type: 'error'
	                        });
	            		};
	            })
	            .fail(function() {
                    new PNotify({
	                	title: '{{ trans("notif.wrong_server") }}',
	                	text: '{{ trans("notif.reload_page") }}',
	                	icon: 'icofont icofont-info-circle',
	                	type: 'error'
	                });
                });
        }else{
            new PNotify({
	        	title: '{{ trans("notif.form_empty") }}',
	        	text: '{{ trans("notif.form_check") }}',
	        	icon: 'icofont icofont-info-circle',
	        	type: 'error'
	        });
        }
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
