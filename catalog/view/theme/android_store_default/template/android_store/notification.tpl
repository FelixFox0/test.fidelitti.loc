<div id="modal-notification" class="modal">
    <div class="modal-dialog">
		<div class="modal-content">
		    <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><?php echo $notification_title; ?></h4>
		    </div>
		    <div class="modal-body"><?php echo $notification_extended_description; ?></div>
		</div>
    </div>
</div>

<script type="text/javascript"><!--
$('#modal-notification').modal('show');
//--></script>