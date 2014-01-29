<?php require APPPATH.'config/myconf'.EXT; ?>			
			<div class="container_12">
				<input type="hidden" id="appointment_id" name="appointment_id" value="<?= $appointment->id ?>" />
				<fieldset>
					<div class="grid_6"><label for="appointment_date"><?= $STRINGTABLE['appointment_edit.date'] ?></label><input type="text" name="appointment_date_edit" id="appointment_date_edit" value="<?= date('d.m.Y', strtotime($appointment->appointment_datetime)) ?>" /></div>
					<div class="grid_3"><label for="appointment_hour"><?= $STRINGTABLE['appointment_edit.time'] ?></label><br/><input type="text" name="appointment_hour" id="appointment_hour" maxlength="2" style="width:30px;" value="<?= date('H', strtotime($appointment->appointment_datetime)) ?>" /> : <input type="text" name="appointment_minute" id="appointment_minute" maxlength="2" style="width:30px;" value="<?= date('i', strtotime($appointment->appointment_datetime)) ?>" /></div>
				</fieldset>
				<fieldset>
					<label for="appointment_location"><?= $STRINGTABLE['appointment_edit.place'] ?></label><input type="text" name="appointment_location" id="appointment_location" value="<?= $appointment->appointment_location ?>" />
				</fieldset>
				<fieldset>
					<div class="grid_12"><label for="appointment_description"><?= $STRINGTABLE['appointment_edit.description'] ?></label><textarea name="appointment_description" id="appointment_description"><?= $appointment->appointment_description ?></textarea></div>
				</fieldset>
				<fieldset>
					<div class="grid_12"><button id="appointment_edit"><?= $STRINGTABLE['appointment_edit.btn.edit'] ?></button></div>
				</fieldset>
			</div>