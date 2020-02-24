<script>
$(document).ready(function(){
$('.modal').css('margin-top', (Math.floor((window.innerHeight - $('.modal')[0].offsetHeight) / 2) + 'px'));
$('#identitas').focus();

function dataCall(){
var event = "{{request('kunci')}}";
    $.ajax({
        url: '{{ url("cekkehadiran") }}',
        type: "GET",
        data: {
            event: event,
        },
        success: function(data) {
            $('#CountKehadiran').html(data+' {{ trans("app.audience") }}');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            swal("Error!", "Gagal mengambil data!", "error");
        }
    });
};

$('#iconKehadiran').click(function(){
    dataCall();
    $('#identitas').focus();
});

$("#identitas").on({
  keydown: function(e) {
    if (e.which === 32)
      return false;
  },
  change: function() {
    this.value = this.value.replace(/\s/g, "");
  }
});

setInterval(function() {
date = new Date();
detik = date.getSeconds();
menit = date.getMinutes();
jam = date.getHours();
$('#time').html(jam+" : "+menit+" : "+detik);
}, 1000 );


document.getElementById('identitas').onkeypress = function(e){
    var input = $('#identitas').val();
    var event = "{{request('kunci')}}";
    var tipe = $('#tipeabsen').val();
    if (!e) e = window.event;
    var keyCode = e.keyCode || e.which;
    if (keyCode == '13'){

    // $('#modelLoading').modal('show');
      // Enter pressed
      $.get("{{ URL::to('/inputpresensi') }}", {
        //   _token : token,
	  	event: event,
	  	input: input,
        tipe : tipe
	  })
	  .done(function(result) {
	  		if (result == "Checked") {
                // $('#modelLoading').on('shown.bs.modal', function(e) {$("#modelLoading").modal("hide")});
                // $("#modelLoading").modal("hide");

                dataCall();

                new PNotify({
                    title: 'Checked',
                    text: 'Anda Sudah Presensi',
                    icon: 'icofont icofont-info-circle',
                    type: 'warning'
                });
                    $('#presensiName').html("# {{ trans('app.full_name') }}");
                    $('#presensiInstution').html("# {{ trans('app.identity') }}");
                    $('#presensiIdentity').html("# {{ trans('app.institution') }}");
                    $('#presensiDatang').html("# {{ trans('app.time') }}");
                    $('#presensiPulang').html("# {{ trans('app.time') }}");
                $('#identitas').val("");
                $('#identitas').focus();
	  		} else if(result == "Denied"){
                //   $('#modelLoading').on('shown.bs.modal', function(e) {$("#modelLoading").modal("hide")});
                $('#identitas').val("");
                $('#identitas').focus();
                dataCall();
                swal("{{trans('notif.access_denied')}}", "{{trans('notif.system_failed_validate')}}", "error");
	  		} else if(result == 'error'){
                // $('#modelLoading').on('shown.bs.modal', function(e) {$("#modelLoading").modal("hide")});
                // $("#modelLoading").modal("hide");
                new PNotify({
                    title: '{{ trans("notif.wrong_server") }}',
                    text: '{{ trans("notif.system_failed_validate") }}',
                    icon: 'icofont icofont-info-circle',
                    type: 'error'
                });
                $('#identitas').val("");
                $('#identitas').focus();
                dataCall();
            } else {
                // $('#modelLoading').on('shown.bs.modal', function(e) {$("#modelLoading").modal("hide")});
                // $("#modelLoading").modal("hide");

                $('#presensiName').html(result.nama);
                $('#presensiInstution').html(result.instansi);
                $('#presensiIdentity').html(input);
                $('#presensiDatang').html(result.datang);
                $('#presensiPulang').html(result.pulang);

                new PNotify({
                    title: '{{ trans("notif.success") }}!',
                    text:  'Anda Berhasil Presensi.',
                    icon: 'icofont icofont-businessman',
                    type: 'success'
                });

                $('#identitas').val("");
                $('#identitas').focus();
                dataCall();
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
    }
}




});

</script>
