<script>
function openFullscreen() {
  var elem = document.documentElement;
  if (elem.requestFullscreen) {
    elem.requestFullscreen();
  } else if (elem.mozRequestFullScreen) { /* Firefox */
    elem.mozRequestFullScreen();
  } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
    elem.webkitRequestFullscreen();
  } else if (elem.msRequestFullscreen) { /* IE/Edge */
    elem.msRequestFullscreen();
  }
}

function AudioTrue() {
    var sound = document.getElementById("audiotrue");
    sound.play();
}

function AudioFalse() {
    var sound = document.getElementById("audiofalse");
    sound.play();
}

$(document).ready(function(){
    openFullscreen();
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

function ResetInfo(){
    setTimeout(function() {
        $('#presensiName').html("# {{ trans('app.full_name') }}");
        $('#presensiInstution').html("# {{ trans('app.identity') }}");
        $('#presensiIdentity').html("# {{ trans('app.institution') }}");
        $('#presensiDatang').html("# {{ trans('app.time') }}");
        $('#presensiPulang').html("# {{ trans('app.time') }}");
    }, 8000);
}


document.getElementById('identitas').onkeypress = function(e){
    var input = $('#identitas').val();
    var event = "{{request('kunci')}}";
    var tipe = $('#tipeabsen').val();
    if (!e) e = window.event;
    var keyCode = e.keyCode || e.which;
    if (keyCode == '13'){
        if(input != ""){
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
                        AudioFalse();
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
                        AudioFalse();
                        dataCall();
                        swal("{{trans('notif.access_denied')}}", "Nama tidak tercantum di acara ini", "error");
	          		} else if(result == 'error'){
                        // $('#modelLoading').on('shown.bs.modal', function(e) {$("#modelLoading").modal("hide")});
                        // $("#modelLoading").modal("hide");
                        new PNotify({
                            title: '{{ trans("notif.wrong_server") }}',
                            text: 'Identitas tidak terdaftar di database',
                            icon: 'icofont icofont-info-circle',
                            type: 'error'
                        });
                        $('#identitas').val("");
                        $('#identitas').focus();
                        AudioFalse();
                        dataCall();
                    } else {
                        // $('#modelLoading').on('shown.bs.modal', function(e) {$("#modelLoading").modal("hide")});
                        // $("#modelLoading").modal("hide");
                        AudioTrue();

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
                        ResetInfo();
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
	            	type: 'warning'
	        });
        }
    }
}




});

</script>
