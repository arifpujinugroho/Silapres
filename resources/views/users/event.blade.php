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
                <input type="hidden" id="kode_event">
                <div class="form-group">
                  <label for="">{{trans('app.event_name')}}</label>
                  <input type="text" class="form-control" id="event_name" aria-describedby="helpId" placeholder="{{trans('app.event_name')}}">
                </div>
                <div class="form-group">
                  <label for="">{{trans('app.event_date')}}</label>
                  <input type="date" class="form-control" id="event_date" aria-describedby="helpId" placeholder="{{trans('app.event_date')}}">
                </div>
                <div class="form-group">
                  <label for="">{{trans('app.event_location')}}</label>
                  <input type="text" class="form-control" id="event_location" aria-describedby="helpId" placeholder="{{trans('app.event_location')}}">
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
@endsection


@section('footer')
<!-- data-table js -->
<script>
$(document).ready(function() {
    var thisurl = $('#thisurl').val();
    var token = $('#token').val();

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
            @if(Lang::locale() == 'kr')
            'url': '{{ url("assets/json/kr.json") }}'
            @elseif(Lang::locale() == 'en')
            'url': "{{ url('assets/json/en.json') }}"
            @elseif(Lang::locale() == 'id')
            "url": "{{ url('assets/json/id.json') }}"
            @elseif(Lang::locale() == 'jp')
            "url": "{{ url('assets/json/jp.json') }}"
            @endif
        },
        'ajax': {
            'url': '{{ url("/listevent") }}',
            'dataSrc': '',
        },
        'columns': [
            {
                data: null,
                render: function(data, type, full, row) {
                    return '<a href="'+thisurl+'/event/'+data.keys_event+'"><button class="btn btn-mini btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></button></a>';
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

    // $('#memberTable tbody').on('click', '.pasfoto', function() {
    //     var file = $(this).data('file');
    //     var nama = $(this).data('nama');
    //     $('#labellihatToko').html('Lihat Foto '+nama);
    //     $('#lihatBody').html('<img class="img img-fluid" src="'+thisurl+'/files/pasfoto/'+file+'">');
    //     $('#lihatSurat').modal('show');
    // });
    $('#btn_save_event').click(function(){
        var name = $('#event_name').val();
        var date = $('#event_date').val();
        var location = $('#event_location').val();
        var pic = $('#event_pic').val();

        if(name != "" && date != "" && location != ""){
                $.post("{{ URL::to('/addevent') }}", {
                    _token : token,
	            	name: name,
	            	date: date,
                    location: location,
                    pic : pic
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
