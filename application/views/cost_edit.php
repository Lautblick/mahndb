<?php $strings = unserialize(STRINGTABLE);?>			
			<div class="container_12">
				<input type="hidden" id="cost_id" name="cost_id" value="<?= $cost->id ?>" />
				<fieldset>
					<div class="grid_6"><label for="cost_date_edit"><?= $strings['case.details.costDate'] ?></label><input type="text" name="cost_date_edit" id="cost_date_edit" value="<?= date('d.m.Y', strtotime($cost->cost_date)) ?>" /></div>
					<div class="grid_6"><label for="cost_amount"><?= $strings['case.details.costValue'] ?></label><input type="text" name="cost_amount" id="cost_amount" value= "<?= number_format($cost->cost_amount, 2, ',', '.'); ?>" /></div>
				</fieldset>
				<fieldset>
					<div class="grid_6"><label for="cost_type_edit"><?= $strings['case.details.costType'] ?></label><input type="text" name="cost_type_edit" id="cost_type_edit" value="<?= $cost->costtype->type_name ?>" /></div>
					<div class="grid_6"><input type="checkbox" name="cost_payment_edit" id="cost_payment_edit" value="1" <?php if($cost->cost_payment == 1) { echo 'checked="checked"'; } ?> /> <label for="cost_payment_edit"><?= $strings['case_details.costPayment'] ?></label></div>
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
					<div class="grid_12"><button id="cost_edit"><?= $strings['case.details.btn.saveCosts'] ?></button></div>
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