<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


				 </div>
</div>
<div class="footer">
		<!-- <div class="pull-right">
				10GB of <strong>250GB</strong> Free.
		</div> -->
		<div>
				<strong>Derechos reservados</strong> American BUS &copy; <?php echo date("Y");?>
		</div>
</div>

</div>
</div>




<script>


$(document).ajaxStart(function(event, jqXHR, settings) {
	$('#msjload').fadeIn();
});

$(document).ajaxComplete(function(event, jqXHR, settings) {
	$('#msjload').fadeOut();
});


</script>
