			
			<div class="container_12">
				<input type="hidden" id="cost_id" name="cost_id" value="<?= $cost->id ?>" />
				<fieldset>
					<div class="grid_6"><label for="cost_date_edit">Datum</label><input type="text" name="cost_date_edit" id="cost_date_edit" value="<?= date('d.m.Y', strtotime($cost->cost_date)) ?>" /></div>
					<div class="grid_6"><label for="cost_amount">Betrag</label><input type="text" name="cost_amount" id="cost_amount" value= "<?= number_format($cost->cost_amount, 2, ',', '.'); ?>" /></div>
				</fieldset>
				<fieldset>
					<div class="grid_6"><label for="cost_type_edit">Kostenart</label><input type="text" name="cost_type_edit" id="cost_type_edit" value="<?= $cost->costtype->type_name ?>" /></div>
				</fieldset>
				<fieldset>
					<div class="grid_3">
					<input type="file" name="cost_select_file_edit" id="cost_select_file_edit" accept="application/pdf">
					</div>
					<div class="grid_9">
					<input type="text" name="cost_file_edit" readonly="readonly" id="cost_file_edit" value="<?= $cost->cost_file ?>" />
					</div>
			    </fieldset>
				<fieldset>
					<div class="grid_12"><button id="cost_edit">Kosten speichern</button></div>
				</fieldset>
			</div>

<script type="text/javascript">

// -----------------------------------------------------------------------

$('#cost_select_file_edit').uploadify({
	'uploader'  : '/js/uploadify/uploadify.swf',
	'script'    : '/js/uploadify/uploadify.php',
	'cancelImg' : '/js/uploadify/cancel.png',
	'folder'    : '/uploads',
	'auto'      : true,
	'onComplete': function(event, ID, fileObj, response, data) {
    	$('#cost_file_edit').val(response);
    }
});

</script>