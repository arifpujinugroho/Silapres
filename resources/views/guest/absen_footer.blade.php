<script>
$(document).ready(function(){
    $('#identitas').focus();

setInterval(function() {
date = new Date();
detik = date.getSeconds();
menit = date.getMinutes();
jam = date.getHours();
$('#time').html(jam+" : "+menit+" : "+detik);
}, 1000 );
});

document.getElementById('identitas').onkeypress = function(e){
    var id = $('#identitas').val();
    if (!e) e = window.event;
    var keyCode = e.keyCode || e.which;
    if (keyCode == '13'){
      // Enter pressed
      alert(id);
    }
}

</script>
