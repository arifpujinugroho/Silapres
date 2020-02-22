@extends('layout.master')

@section('title')
{{ $e->nama_event }}
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
        <div class="col-md-12 col-sm-12 col-xl-12">
            <div class="card bg-c-green green-contain-card ">
                <div class="card-block-big p-t-20 p-b-20">
                    <h4 class="p-t-0">{{ $e->nama_event }}</h4>
                </div>
                <div class="card m-b-0 ">
                    <div class=" card-block-big p-t-20 p-b-20 ">
                        <span class="m-l-10 f-w-400 f-right "><i id="reload-tabel" data-toggle="tooltip" title="Refresh Tabel" class="icofont icofont-refresh"></i></span>
                        <div>
                            <table id="memberTable" class="table table-striped" width="100%">
                                <thead>
                                    <th>{{ trans('app.full_name') }}</th>
                                    <th>{{ trans('app.identity_number') }}</th>
                                    <th>{{ trans('auth.email') }}</th>
                                    <th>{{ trans('app.come') }}</th>
                                    <th>{{ trans('app.out') }}</th>
                                    <th>{{ trans('app.status') }}</th>
                                    <th>{{ trans('app.institution') }}</th>
                                    <th>{{ trans('app.action') }}</th>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
<!-- Page-body end -->
@endsection

@section('end')
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
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "{{ trans('app.all') }}"]],
        'buttons': [
            {
                extend: 'pageLength',
                className: 'btn-mini btn-inverse'
            },
            {
                extend: 'excelHtml5',
                className: 'btn-mini btn-inverse',
                exportOptions: {
                    columns: ':visible'
                }
            }, {
                extend: 'colvis',
                className: 'btn-mini btn-inverse',
                columnText: function ( dt, idx, title ) {
                return (idx+1)+': '+title;
                }
            }],
        'serverMethod': 'get',
        "paging": true,
        "processing": true,
        "ordering": true,
        'responsive':true,
        "info": true,
        "language": {
            'buttons': {
                pageLength:'{{trans("app.length_menu")}}',
                colvis: '{{ trans("app.column_visibility") }}'
                },
            "url": thisurl+'/assets/json/'+lang+'.json'
        },
        'ajax': {
            'url': thisurl+'/listdaftarhadir?kunci={{$e->keys_event}}',
            'dataSrc': '',
        },
        'columns': [
            {
                data: null,
                render: function(data, type, full, row) {
                    return '<tombol>';
                }
            },
            {
                data : 'nama'
            },
            {
                data: 'no_identitas'
            },
            {
                data : 'email'
            },
            {
                data: 'datang'
            },
            {
                data : 'pulang'
            },
            {
                data : 'status'
            },
            {
                data : 'instansi'
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
