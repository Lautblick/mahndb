
			<div class="container_12">
				<input type="hidden" id="event_id" name="event_id" value="<?= $event->id ?>" />
				<fieldset>
					<div class="grid_6"><label for="event_type_edit"><?= $STRINGTABLE['case.details.eventType'] ?></label><input type="text" name="event_type_edit" id="event_type_edit" value="<?= $event->eventtype->type_name ?>" /></div>
					<div class="grid_6"><label for="event_date_edit"><?= $STRINGTABLE['case.details.eventDate'] ?></label><input type="text" name="event_date_edit" id="event_date_edit" value="<?= $event->event_date ?>" /></div>
				</fieldset>
				<fieldset>
					<div class="grid_3">
					<input type="file" name="select_file_edit" id="select_file_edit" accept="application/pdf">
					</div>
					<div class="grid_9">
					<input type="text" name="event_file_edit" id="event_file_edit" readonly="readonly" value="<?= $event->event_file ?>" />
					</div>
			    </fieldset>
				<fieldset>
					<div class="grid_12"><label for="event_description"><?= $STRINGTABLE['case.details.eventDescription'] ?></label><textarea name="event_description" id="event_description"><?= $event->event_description ?></textarea></div>
				</fieldset>
				<fieldset>
					<div class="grid_12">
						<label for="case_status"><?= $STRINGTABLE['case.details.status'] ?></label>
						<select name="case_status" id="case_status">
							<option value=""><?= $STRINGTABLE['case.details.noChange'] ?></option>
							<?php foreach ($statuses as $status) { ?>
								<option value="<?= $status->id ?>"><?= $status->name ?></option>
							<?php } ?>
						</select>
					</div>
				</fieldset>
				<fieldset>
					<div class="grid_12"><button id="event_edit"><?= $STRINGTABLE['case.details.btn.saveEvent'] ?></button></div>
				</fieldset>
			</div>
			
<script type="text/javascript">

// -----------------------------------------------------------------------

$('#select_file_edit').uploadify({
	'uploader'  : '/js/uploadify/uploadify.swf',
	'script'    : '/js/uploadify/uploadify.php',
	'cancelImg' : '/js/uploadify/cancel.png',
	'folder'    : '/uploads',
	'auto'      : true,
	'onComplete': function(event, ID, fileObj, response, data) {
    	$('#event_file_edit').val(response);
    }
});

</script>