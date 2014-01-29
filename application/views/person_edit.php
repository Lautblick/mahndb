<?php $strings = unserialize(STRINGTABLE);?>
			<div class="container_12">
				<fieldset>
					<input type="hidden" id="person_id" name="person_id" value="<?= $person->id ?>" />
					<div class="grid_2">
						<label for="person_title"><?= $strings['case.detail.form.title']; ?></label>
						<select name="person_title" id="person_title">
							<option value="" <?= ($person->person_title == '')?'selected="selected"':'' ?>></option>
							<option value="Herr" <?= ($person->person_title == 'Herr')?'selected="selected"':'' ?>>Herr</option>
							<option value="Frau" <?= ($person->person_title == 'Frau')?'selected="selected"':'' ?>>Frau</option>
						</select>
					</div>
					<div class="grid_5"><label for="person_firstname"><?= $strings['case.detail.form.firstname']; ?></label><input type="text" name="person_firstname" id="person_firstname" value="<?= $person->person_firstname ?>" /></div>
					<div class="grid_5"><label for="person_lastname"><?= $strings['case.detail.form.lastname']; ?></label><input type="text" name="person_lastname" id="person_lastname" value="<?= $person->person_lastname ?>" /></div>
				</fieldset>
				<fieldset>
					<div class="grid_10"><label for="address_street"><?= $strings['case.detail.form.street']; ?></label><input type="text" name="address_street" id="address_street" value="<?= $person->address->address_street ?>" /></div>
					<div class="grid_2"><label for="address_street_number"><?= $strings['case.detail.form.streetNumber']; ?></label><input type="text" name="address_street_number" id="address_street_number" value="<?= $person->address->address_street_number ?>" /></div>
				</fieldset>
				<fieldset>
					<div class="grid_4"><label for="zipcode"><?= $strings['case.detail.form.zipcode']; ?></label><input type="text" name="zipcode" id="zipcode" value="<?= $person->address->place->id ?>" /></div>
					<div class="grid_8"><label for="place_name"><?= $strings['case.detail.form.place']; ?></label><input type="text" name="place_name" id="place_name" value="<?= $person->address->place->place_name ?>" /></div>
				</fieldset>
				<fieldset>
					<div class="grid_3"><label for="address_phone_number"><?= $strings['case.detail.form.phoneNumber']; ?></label><input type="text" name="address_phone_number" id="address_phone_number" value="<?= $person->address->address_phone_number ?>" /></div>
					<div class="grid_3"><label for="address_fax_number"><?= $strings['case.detail.form.faxNumber']; ?></label><input type="text" name="address_fax_number" id="address_fax_number" value="<?= $person->address->address_fax_number ?>" /></div>
					<div class="grid_3"><label for="address_cellphone"><?= $strings['case.detail.form.mobileNumber']; ?></label><input type="text" name="address_cellphone" id="address_cellphone" value="<?= $person->address->address_cellphone ?>" /></div>
					<div class="grid_3"><label for="address_email"><?= $strings['case.detail.form.email']; ?></label><input type="text" name="address_email" id="address_email" value="<?= $person->address->address_email ?>" /></div>
				</fieldset>
				<fieldset>
					<div class="grid_4"><label for="person_dob"><?= $strings['case.detail.form.birthdate']; ?></label><input type="date" name="person_dob" id="person_dob" class="hasDatepicker" value="<?= $person->person_dob ?>"></div>
					<div class="grid_4"><label for="person_state"><?= $strings['case.detail.form.nationality']; ?></label><input type="text" name="person_state" id="person_state" value="<?= $person->person_state ?>"></div>
				</fieldset>
				<fieldset>
					<div class="grid_4"><label for="person_accountnumber"><?= $strings['case.detail.form.bankAccount']; ?></label><input type="text" name="person_accountnumber" id="person_accountnumber" value="<?= $person->person_accountnumber ?>"></div>
					<div class="grid_4"><label for="person_bankcode"><?= $strings['case.detail.form.bankNumber']; ?></label><input type="text" name="person_bankcode" id="person_bankcode" value="<?= $person->person_bankcode ?>"></div>
				</fieldset>
				<?php if(in_array('admin', $roles)) { ?>
					<fieldset>
						<div class="grid_4">
							<label for="user_id">Auftraggeber</label>
							<select name="user_id" id="user_id">
								<option value="" <?= ($person->user_id == '')?'selected="selected"':'' ?>></option>
								<?php foreach ($users as $user) { ?>
									<option value="<?= $user->id ?>" <?= ($person->user_id == $user->id)?'selected="selected"':'' ?>><?= $user->username ?></option>
								<?php } ?>
							</select>
						</div>
					</fieldset>
				<?php } ?>
				<fieldset>
					<div class="grid_12"><button id="person_edit"><?= $strings['case.detail.form.title']; ?></button></div>
				</fieldset>
			</div>