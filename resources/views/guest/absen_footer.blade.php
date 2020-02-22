<script>
$(document).ready(function(){

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
    var id = $('#identitas').val();
    var tipe = $('#tipeasen').val();
    if (!e) e = window.event;
    var keyCode = e.keyCode || e.which;
    if (keyCode == '13'){
      // Enter pressed
      alert(id);
    }
}

</script>
