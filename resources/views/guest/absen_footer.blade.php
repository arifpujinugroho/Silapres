<script>
$(document).ready(function(){
$('.modal').css('margin-top', (Math.floor((window.innerHeight - $('.modal')[0].offsetHeight) / 2) + 'px'));

$('#identitas').focus();

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

});

document.getElementById('identitas').onkeypress = function(e){
    var input = $('#identitas').val();
    var event = "{{request('kunci')}}";
    var tipe = $('#tipeabsen').val();
    if (!e) e = window.event;
    var keyCode = e.keyCode || e.which;
    if (keyCode == '13'){

    $('#modelLoading').modal('show');
      // Enter pressed
      $.get("{{ URL::to('/inputpresensi') }}", {
        //   _token : token,
	  	event: event,
	  	input: input,
        tipe : tipe
	  })
	  .done(function(result) {
	  		if (result == "Checked") {
                  $('#modelLoading').on('shown.bs.modal', function(e) {$("#modelLoading").modal("hide")});
                swal("{{trans('error')}}", "{{trans('notif.checked')}}", "warning");
                $('#identitas').val("");
                $('#identitas').focus();
	  		} else if(result == "Denied"){
                  $('#modelLoading').on('shown.bs.modal', function(e) {$("#modelLoading").modal("hide")});
                  alert('Denied');
                $('#identitas').val("");
                $('#identitas').focus();
	  		} else if(result == 'error'){
                // $('#modelLoading').on('shown.bs.modal', function(e) {$("#modelLoading").modal("hide")});
                $("#modelLoading").modal("hide");
                    alert('Error');
                $('#identitas').val("");
                $('#identitas').focus();
            } else {
                  $('#modelLoading').on('shown.bs.modal', function(e) {$("#modelLoading").modal("hide")});
                $('#presensiName').html(result.nama);
                $('#presensiIntution').html(result.instansi);
                $('#presensiIdentity').html(input);
                $('#presensiDatang').html(result.datang);
                $('#presensiPulang').html(result.pulang);

                $('#identitas').val("");
                $('#identitas').focus();
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

</script>
