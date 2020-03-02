@extends('layout.master')

@section('title')
{{ $e->nama_event }} ({{ $e->lokasi_event }})
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
        <div class="col-md-12 col-sm-12 col-xl-12">
            <div class="card bg-c-blue green-contain-card ">
                <div class="card-block-big p-t-20 p-b-20">
                    <h4 class="p-t-0">{{ $e->nama_event }} ({{ $e->lokasi_event }})</h4>
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
                                    <!-- <th>{{ trans('app.status') }}</th>
                                    <th>{{ trans('app.institution') }}</th> -->
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
                <input type="hidden" id="kode">
    	    	<div class="form-group" id="identity_form">
    	    		<div class="input-group">
    	    			<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
    	    			<input type="text" name="nim" id="nim" class="validate[required,custom[integer]] form-control" placeholder="{{ trans('app.identity_number') }} / {{trans('auth.email')}}">
    	    			<span class="input-group-addon cursor-hand" id="search">{{ trans('app.search') }}<i class="fa fa-search fa-fw"></i></span>
    	    			<span class="input-group-addon cursor-hand bg-warning" id="reset">{{ trans('auth.reset') }}<i class="fa fa-refresh fa-fw"></i></span>
    	    		</div><p class="help-block"><strong>Silahkan ketik NIM dan klik tombol cari terlebih dahulu.</strong></p>
    	    	</div>
                <fieldset id="utama_form">
    	    	    <div class="form-group">
    	    	    	<div class="input-group">
    	    	    		<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
    	    	    		<input type="text" id="peserta_identity" class="validate[required] form-control" placeholder="{{trans('app.identity_number')}}">
    	    	    	</div>
    	    	    </div>
    	    	    <div class="form-group">
    	    	    	<div class="input-group">
    	    	    		<span class="input-group-addon"><i class="fa fa-male fa-fw"></i></span>
    	    	    		<input type="text" id="nama" class="validate[required] form-control" placeholder="{{trans('app.full_name')}}">
    	    	    	</div>
    	    	    </div>
    	    	    <div class="form-group">
    	    	    	<div class="input-group">
    	    	    		<span class="input-group-addon"><i class="fa fa-university fa-fw"></i></span>
    	    	    		<input type="text" id="instansi" class="validate[required] form-control" placeholder="{{trans('app.institution')}}">
    	    	    	</div>
    	    	    </div>
                </fieldset>

                <fieldset id="kedua_form">
    	    	    <div class="form-group">
    	    	    	<div class="input-group">
    	    	    		<span class="input-group-addon"><i class="fa fa-at fa-fw"></i></span>
    	    	    		<input type="email" id="email" class="validate[required] form-control" placeholder="{{trans('auth.email')}}">
    	    	    	</div>
    	    	    </div>
    	    	    <div class="form-group">
    	    	    	<div class="input-group">
    	    	    		<span class="input-group-addon"><i class="fa fa-venus-mars fa-fw"></i></span>
                            <select class="form-control" id="jns_kel">
                              <option value="">-- {{ trans('app.gender') }} --</option>
                              <option value="L">{{ trans('app.male') }}</option>
                              <option value="P">{{ trans('app.female') }}</option>
                            </select>
    	    	    	</div>
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn_save_uny_peserta" class="btn btn-mini btn-primary">{{ trans('app.save') }}</button>
                <button type="button" id="btn_save_other_peserta" class="btn btn-mini btn-success">{{ trans('app.save') }}</button>
                <button type="button" id="btn_edit_peserta" class="btn btn-mini btn-warning">{{ trans('app.edit') }}</button>
                <button type="button" class="btn btn-mini btn-secondary" data-dismiss="modal">{{ trans('app.close') }}</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="editEvent" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="labellihatToko">{{trans("app.edit_event")}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="kode_event" value="{{ $e->keys_event }}">
                <div class="form-group">
                  <label for="">{{trans('app.event_name')}} <strong class="text-danger">*</strong></label>
                  <input type="text" class="form-control" id="event_name" aria-describedby="helpId" value="{{ $e->nama_event }}" placeholder="{{trans('app.event_name')}}">
                </div>
                <div class="form-group">
                  <label for="">{{trans('app.event_date')}} <strong class="text-danger">*</strong></label>
                  <input type="date" class="form-control" id="event_date" aria-describedby="helpId" value="{{ $e->tgl_event }}" placeholder="{{trans('app.event_date')}}">
                </div>
                <div class="form-group">
                  <label for="">{{trans('app.event_location')}} <strong class="text-danger">*</strong></label>
                  <input type="text" class="form-control" id="event_location" aria-describedby="helpId" value="{{ $e->lokasi_event }}" placeholder="{{trans('app.event_location')}}">
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
                  <input type="text" class="form-control" id="event_pic" aria-describedby="helpId" value="{{ $e->penanggung_jawab }}" placeholder="{{trans('app.pic_event')}}">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn_edit_event" class="btn btn-mini btn-warning">{{ trans('app.edit') }}</button>
                <button type="button" class="btn btn-mini btn-secondary" data-dismiss="modal">{{ trans('app.close') }}</button>
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
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "{{ trans('app.all') }}"]],
        'buttons': [
            {
                extend: 'collection',
                text: '{{ trans("app.add_Participant") }}',
                buttons: [
                    {
                        text: 'UNY',
                        //  className: 'btn-mini',
                        action: function(e, dt, node, config) {
                           $('#labellihatToko').html('{{ trans("app.add_Participant") }}');
                           $('#identity_form').show();
                           $('#nim').removeAttr('readonly');
                           $('#search').show();
                           $('#reset').hide();

                           $('#nama').val("");
                           $('#kode').val("");
                           $('#nim').val("");
                           $('#peserta_identity').val("");
                           $('#instansi').val("");
                           $('#email').val("");
                           $('#jns_kel').val("");


                           $('#utama_form').attr('disabled','disabled');
                           $('#kedua_form').attr('disabled','disabled');
                           $('#kedua_form').hide();
                           $('#btn_save_uny_peserta').attr('disabled','disabled');
                           $('#btn_save_uny_peserta').show();
                           $('#btn_save_other_peserta').hide();
                           $('#btn_edit_peserta').hide();
                           $('#lihatSurat').modal('show');
                           $('#nim').focus();
                        }
                    },
                    // {
                    //     text: '{{ trans("app.other") }}',
                    //     //  className: 'btn-mini',
                    //     action: function(e, dt, node, config) {
                    //        $('#labellihatToko').html('{{ trans("app.add_Participant") }}');
                    //        $('#identity_form').hide();

                    //        $('#nama').val("");
                    //        $('#kode').val("");
                    //        $('#nim').val("");
                    //        $('#peserta_identity').val("");
                    //        $('#instansi').val("");
                    //        $('#email').val("");
                    //        $('#jns_kel').val("");

                    //        $('#utama_form').removeAttr('disabled');
                    //        $('#kedua_form').removeAttr('disabled');
                    //        $('#kedua_form').show();
                    //        $('#btn_save_other_peserta').removeAttr('disabled');
                    //        $('#btn_save_other_peserta').show();
                    //        $('#btn_save_uny_peserta').hide();
                    //        $('#btn_edit_peserta').hide();
                    //        $('#lihatSurat').modal('show');
                    //     }
                    // },
                ]
            },
            {
                extend: 'collection',
                text: '{{ trans("app.other") }}',
                className: 'bg-inverse',
                buttons: [
                    {
                        text: '{{trans("app.open_attendance")}}',
                        // className: 'btn-mini btn-warning',
                        action: function(e, dt, node, config) {
                            var keys = $('#kode_event').val();
                            window.open(thisurl+'/presensi?kunci='+keys,'_blank');
                        }
                    },
                    {
                        text: '{{trans("app.share_event")}}',
                        // className: 'btn-mini btn-warning',
                        action: function(e, dt, node, config) {
                            $('#nomerWa').val('');
                            $('#waLink').modal('show');
                            $('#nomerWa').focus();
                        }
                    },
                    {
                        extend: 'pageLength',
                        // className: 'btn-mini btn-inverse'
                    },
                    {
                        extend: 'colvis',
                        // className: 'btn-mini btn-inverse',
                        columnText: function ( dt, idx, title ) {
                        return (idx+1)+': '+title;
                        }
                    },
                    {
                        text: '{{ trans("app.edit_event") }}',
                        // className: 'btn-mini btn-warning',
                        action: function(e, dt, node, config) {
                            $('#event_tipe').val("{{ $e->tipe_event }}");
                            $('#editEvent').modal('show');
                        }
                    },
                    {
                        extend: 'collection',
                        text: 'Export',
                        className: 'btn-primary',
                        buttons: [
                            // {
                            //     text: 'Print Daftar Hadir',
                            //     className: 'btn-mini btn-warning',
                            //     action: function(e, dt, node, config) {

                            //     }
                            // },
                            {
                                extend: 'excelHtml5',
                                className: 'btn-mini btn-inverse',
                                exportOptions: {
                                    columns: ':visible'
                                }
                            }
                        ]
                    },
                ]
            },
        ],
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
                data : 'nama'
            },
            {
                data: 'no_identitas'
            },
            {
                data : 'email'
            },
            {
                data: null,
                render: function(data, type, full, row) {
                    if(data.datang == "" || data.datang == null){
                        return "-";
                    }else{
                        var date = new Date(data.datang);
                        var tahun = date.getFullYear();
                        var bulan = date.getMonth();
                        var tanggal = date.getDate();
                        var hari = date.getDay();
                        var jam = date.getHours();
                        var menit = date.getMinutes();
                        var detik = date.getSeconds();
                        switch(hari) {
                         case 0: hari = "Minggu"; break;
                         case 1: hari = "Senin"; break;
                         case 2: hari = "Selasa"; break;
                         case 3: hari = "Rabu"; break;
                         case 4: hari = "Kamis"; break;
                         case 5: hari = "Jum'at"; break;
                         case 6: hari = "Sabtu"; break;
                        }
                        switch(bulan) {
                         case 0: bulan = "Januari"; break;
                         case 1: bulan = "Februari"; break;
                         case 2: bulan = "Maret"; break;
                         case 3: bulan = "April"; break;
                         case 4: bulan = "Mei"; break;
                         case 5: bulan = "Juni"; break;
                         case 6: bulan = "Juli"; break;
                         case 7: bulan = "Agustus"; break;
                         case 8: bulan = "September"; break;
                         case 9: bulan = "Oktober"; break;
                         case 10: bulan = "November"; break;
                         case 11: bulan = "Desember"; break;
                        }
                        var tampilTanggal = hari + ", " + tanggal + " " + bulan + " " + tahun;
                        var tampilWaktu = jam + ":" + menit;
                        return tampilWaktu;
                    }
                }
            },
            {
                data: null,
                render: function(data, type, full, row) {
                    if(data.pulang == "" || data.pulang == null){
                        return "-";
                    }else{
                        var date = new Date(data.pulang);
                        var jam = date.getHours();
                        var menit = date.getMinutes();
                        var detik = date.getSeconds();
                        return jam+":"+menit;
                    }
                }
            },
            {
                data: null,
                render: function(data, type, full, row) {
                    return '<button data-nama="'+data.nama+'" data-id="'+data.idnya+'" class="deletePeserta btn btn-mini btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>';
                }
            },
            // {
            //     data : 'status'
            // },
            // {
            //     data : 'instansi'
            // },
        ]
    });


    $('#reload-tabel').click(function() {
        table.ajax.reload();
    });

    $('#memberTable tbody').on('click', '.deletePeserta', function() {
        var event = "{{Crypt::encrypt($e->id)}}";
        var nama = $(this).data('nama');
        var user = $(this).data('id');
        swal({
            title: "Hapus "+nama,
            text: "Ingin menghapus peserta  "+nama+" ?",
            type: "warning",
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: "Hapus",
            closeOnConfirm: false
        }, function() {
            $.ajax({
                url: "{{url('/hapuspeserta')}}",
                type: "POST",
                data: {
                    _token: token,
                    event: event,
                    user: user
                },
                success: function() {
                    swal(" Dihapus!", "Anda berhasil menghapus peserta : "+nama, "success");
                    table.ajax.reload();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    swal("Error Dihapus!", "Silakan Coba Lagi", "error");
                }
            });
        });
    });

    // $('#memberTable tbody').on('click', '.editEvent', function() {
    //     $('#kode_event').val($(this).data('key'));
    //     $('#event_name').val($(this).data('nama'));
    //     $('#event_date').val($(this).data('tgl'));
    //     $('#event_location').val($(this).data('lokasi'));
    //     $('#event_pic').val($(this).data('pic'));
    //     $('#event_tipe').val($(this).data('tipe'));
    //     $('#labellihatToko').html('{{trans("app.edit_event")}}');

    //     $('#btn_save_event').hide();
    //     $('#btn_edit_event').show();
    //     $('#lihatSurat').modal('show');
    // });

    $('#reset').click(function(){
        $('#nim').removeAttr('readonly');
        $('#search').show();
        $('#reset').hide();

        $('#nama').val("");
        $('#kode').val("");
        $('#nim').val("");
        $('#peserta_identity').val("");
        $('#instansi').val("");
        $('#email').val("");
        $('#jns_kel').val("");

        $('#btn_save_uny_peserta').attr('disabled','disabled');
        $('#nim').focus();
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

    $('#btn_save_uny_peserta').click(function(){
        var event = "{{$e->keys_event}}";
        var user = $('#kode').val();

        if(event != "" && user != ""){
                $.post("{{ URL::to('/addpesertadb') }}", {
                    _token : token,
	            	event: event,
	            	user:user
	            })
	            .done(function(result) {
	            		if ($.isNumeric(result)) {
                            table.ajax.reload();
                            $('#lihatSurat').modal('hide');
                            new PNotify({
	                        	title: '{{trans("notif.success")}}',
	                        	text: '{{trans("notif.data_save")}}',
	                        	icon: 'icofont icofont-info-circle',
	                        	type: 'success'
                            });
                            // swal({title: "{{trans('notif.success')}}", text: "{{trans('notif.data_save')}}", type: "success"}, function() {window.location.reload();});
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
                            $('#editEvent').modal('hide');
                            swal({title: "{{trans('notif.success')}}", text: "{{trans('notif.data_edit')}}", type: "success"}, function() {window.location.reload();});
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



    $('#search').click(function() {
		var input = $('#nim').val();
		var event = "{{Crypt::encrypt($e->id)}}";
		if (nim != '') {
			var input_icon = $(this).parent().children().first().children();
			var input_help = $(this).parent().parent().children().last();

			input_icon.removeClass('fa-user').addClass('fa-spinner fa-spin');
			input_help.hide();

			$.get("{{ URL::to('/cekdb') }}", {
					input: input,
					event: event,
				})
				.done(function(result) {
					input_icon.removeClass('fa-spinner fa-spin').addClass('fa-user');
					if ($.isEmptyObject(result)) {
						new PNotify({
							title: 'Identitas tidak ditemukan!',
							text: 'Maaf, Identitas tersebut tidak terdaftar di DB.',
							icon: 'icofont icofont-info-circle',
							type: 'error'
						});
						input_icon.removeClass('fa-spinner fa-spin').addClass('fa-user');
						input_help.children().html('Silahkan ketik NIM dan klik tombol cari terlebih dahulu.');
						input_help.show();
						$('#btn_save_uny_peserta').attr('disabled', 'disabled');
					} else {
						if ($.isNumeric(result)) {
							new PNotify({
								title: 'Gagal Tambah Peserta!',
								text: 'Peserta dengan identitas : '+input+' sudah ada.',
								icon: 'icofont icofont-info-circle',
								type: 'error'
							});
							input_icon.removeClass('fa-spinner fa-spin').addClass('fa-user');
							input_help.children().html('Silahkan ketik NIM dan klik tombol cari terlebih dahulu.');
							input_help.show();
							$('#btn_save_uny_peserta').attr('disabled', 'disabled');
						} else {
							input_help.children().html('Identitas telah ditemukan');
							input_help.show();
							$('#nim').attr('readonly', 'readonly');
							$('#search').hide();
							$('#reset').show();
							$('#kode').val(result.kode);
							$('#nama').val(result.isi.nama);
							$('#peserta_identity').val(result.isi.no_identitas);
							$('#instansi').val(result.isi.instansi);
							$('#btn_save_uny_peserta').removeAttr('disabled');
						};
					}
				})
				.fail(function() {
                    new PNotify({
	                	title: '{{ trans("notif.wrong_server") }}',
	                	text: '{{ trans("notif.reload_page") }}',
	                	icon: 'icofont icofont-info-circle',
	                	type: 'error'
	                });
					input_icon.removeClass('fa-spinner fa-spin').addClass('fa-user');
					input_help.children().html('Silahkan ketik NIM dan klik tombol cari terlebih dahulu.');
					input_help.show();
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
