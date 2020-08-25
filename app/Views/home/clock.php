

<div class="card bg-danger text-white">
<h3 class="card-title text-center">
<a><span class="badge hours"></span></a> :
<a><span class="badge min"></span></a> :
<a><span class="badge sec"></span></a>

</h3>

</div>



<script>
$(document).ready(function() {
setInterval( function() {
var hours = new Date().getHours();
$(".hours").html(( hours < 10 ? "0" : "" ) + hours);
}, 1000);
setInterval( function() {
var minutes = new Date().getMinutes();
$(".min").html(( minutes < 10 ? "0" : "" ) + minutes);
},1000);
setInterval( function() {
var seconds = new Date().getSeconds();
$(".sec").html(( seconds < 10 ? "0" : "" ) + seconds);
},1000);
});
</script>
