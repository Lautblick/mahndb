<?php $strings = unserialize(STRINGTABLE);?>
		<form>
			<fieldset>
				<input type="hidden" name="case_id" id="case_id" rel="case" value="<?= $the_case->id ?>" />
				<div class="grid_2"><label for="tenancy_ve"><?= $strings['case.details.ve']; ?></label><input type="text" name="tenancy_ve" id="tenancy_ve" rel="case" value="<?= $the_case->tenancy->tenancy_ve ?>" /></div>
				<div class="grid_2"><label for="case_nr"><?= $strings['case.details.nr']; ?></label><input type="text" name="case_nr" id="case_nr" disabled="disabled" value="<?= $the_case->case_nr ?>/<?= date('Y', strtotime($the_case->case_created)) ?>" /></div>
				<div class="grid_1"><label for="case_session">Session</label><input type="text" name="case_session" id="case_session" rel="case" value="<?= $the_case->case_session ?>" /></div>
				<div class="grid_1"><label for="case_active">Fall aktiv</label><br /><input type="checkbox" name="case_active" id="case_active" rel="case" value="1" <?= ($the_case->case_active == '1')?'checked="checked"':'' ?> /></div>
				<div class="grid_4"><label>Status</label><input type="text" disabled rel="case" id="case_status" value="<?= $the_case->status->name ?>" /></div>
				<div class="grid_2"><label for="case_followup"><?= $strings['case.details.followup']; ?></label><input type="text" name="case_followup" id="case_followup" rel="case" class="datepicker" value="<?= date('d.m.Y', strtotime($the_case->case_followup)) ?>" /></div>
			</fieldset>
			<fieldset>
				<div class="grid_3"><label for="tenancy_street"><?= $strings['case.details.form.street']; ?></label><input type="text" name="tenancy_street" id="tenancy_street" rel="case" value="<?= $the_case->tenancy->address->address_street ?>" /></div>
				<div class="grid_3"><label for="tenancy_zip"><?= $strings['case.details.form.zipcode']; ?></label><input type="text" name="tenancy_zip" id="tenancy_zip" value="<?= $the_case->tenancy->address->place_id ?>" /></div>
				<div class="grid_3"><label for="tenancy_city"><?= $strings['case.details.form.place']; ?></label><input type="text" name="tenancy_city" id="tenancy_city" value="<?= $the_case->tenancy->address->place->place_name ?>" /></div>
				<div class="grid_3"><label for="tenancy_position">Lage</label><input type="text" name="tenancy_position" id="tenancy_position" value="<?= $the_case->tenancy->tenancy_position ?>" /></div>
			</fieldset>
			<fieldset>
				<div class="grid_6">
					<label for="claimants_list"><?= $strings['case.details.claimants']; ?></label>
					<ul id="claimants_list" class="sublist">
						<?php foreach($the_case->claimants->order_by('person_lastname', 'asc')->find_all() as $claimant):?>
						<li id="<?= $claimant->id; ?>">
							<?= $claimant->person_title.' '.$claimant->person_firstname.' '.$claimant->person_lastname ?><br/>
							<span class="small">
								<?= $claimant->address->address_street.' '.$claimant->address->address_street_number.', '.$claimant->address->place->id.' '.$claimant->address->place->place_name ?><br>
								Telefon: <?= $claimant->address->address_phone_number; ?>, Handy: <?= $claimant->address->address_cellphone; ?>, E-Mail: <?= $claimant->address->address_email; ?>
							</span>
							<button class="person_edit" href=""><img src="img/icon_pencil.png" alt="icon_pencil" />
						</li>
						<?php endforeach;?>
					</ul>
					<div id="claimants_menu" class="menu ui-state-default"><button id="claimant_add_dialog_open"><span class="ui-icon ui-icon-circle-plus"></span>Kläger hinzufügen</button></div>
					<div id="claimant_add_dialog" title="<?= $strings['case.details.btn.addClaimant']; ?>">
						<div id="claimant_add_tabs"> 
							<ul>
								<li><a href="#claimant_add_1"><?= $strings['case.details.search']; ?></a></li>
								<li><a href="#claimant_add_2"><?= $strings['case.details.create']; ?></a></li>
							</ul>
							<div id="claimant_add_1">
								<div class="container_12">
									<fieldset>
										<div class="grid_12">
											<p><?= $strings['case.details.claimantSearchInfo']; ?></p>
											<input type="text" name="claimant_search" id="claimant_search" />
										</div>
									</fieldset>
								</div>
							</div>
							<div id="claimant_add_2">
								<div class="container_12">
									<fieldset>
										<div class="grid_2"><label for="person_title"><?= $strings['case.details.form.title']; ?></label><select name="person_title" id="person_title">
											<option value=""></option>
											<option value="Herr">Herr</option>
											<option value="Frau">Frau</option>
										</select></div>
										<div class="grid_5"><label for="person_firstname"><?= $strings['case.details.form.firstname']; ?></label><input type="text" name="person_firstname" id="person_firstname" /></div>
										<div class="grid_5"><label for="person_lastname"><?= $strings['case.details.form.lastname']; ?></label><input type="text" name="person_lastname" id="person_lastname" /></div>
									</fieldset>
									<fieldset>
										<div class="grid_10"><label for="address_street"><?= $strings['case.details.form.street']; ?></label><input type="text" name="address_street" id="address_street" /></div>
										<div class="grid_2"><label for="address_street_number"><?= $strings['case.details.form.streetNumber']; ?></label><input type="text" name="address_street_number" id="address_street_number" /></div>
									</fieldset>
									<fieldset>
										<div class="grid_4"><label for="zipcode"><?= $strings['case.details.form.zipcode']; ?></label><input type="text" name="zipcode" id="zipcode" /></div>
										<div class="grid_8"><label for="place_name"><?= $strings['case.details.form.place']; ?></label><input type="text" name="place_name" id="place_name" /></div>
									</fieldset>
									<fieldset>
										<div class="grid_4"><label for="address_phone_number"><?= $strings['case.details.form.phoneNumber']; ?></label><input type="text" name="address_phone_number" id="address_phone_number" /></div>
										<div class="grid_4"><label for="address_fax_number"><?= $strings['case.details.form.faxNumber']; ?></label><input type="text" name="address_fax_number" id="address_fax_number" /></div>
										<div class="grid_4"><label for="address_cellphone"><?= $strings['case.details.form.mobileNumber']; ?></label><input type="text" name="address_cellphone" id="address_cellphone" /></div>
										<div class="grid_4"><label for="address_email"><?= $strings['case.details.form.email']; ?></label><input type="text" name="address_email" id="address_email" /></div>
									</fieldset>
									<fieldset>
										<div class="grid_4"><label for="person_dob"><?= $strings['case.details.form.birthdate']; ?></label><input type="text" name="person_dob" id="person_dob"></div>
										<div class="grid_4"><label for="person_state"><?= $strings['case.details.form.nationality']; ?></label><input type="text" name="person_state" id="person_state"></div>
										<div class="grid_4"><label for="person_accountnumber"><?= $strings['case.details.form.bankAccount']; ?></label><input type="text" name="person_accountnumber" id="person_accountnumber"></div>
										<div class="grid_4"><label for="person_bankcode"><?= $strings['case.details.form.bankNumber']; ?></label><input type="text" name="person_bankcode" id="person_bankcode"></div>
									</fieldset>
									<?php if(in_array('admin', $roles)) { ?>
										<fieldset>
											<div class="grid_4">
												<label for="user_id">Auftraggeber</label>
												<select name="user_id" id="user_id">
													<option value=""></option>
													<?php foreach ($users as $user) { ?>
														<option value="<?= $user->id ?>"><?= $user->username ?></option>
													<?php } ?>
												</select>
											</div>
										</fieldset>
									<?php } ?>
									<fieldset>
										<div class="grid_12"><button id="claimant_add"><?= $strings['case.details.form.btn.saveClaimant']; ?></button></div>
									</fieldset>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="grid_6">
					<label for="defendants_list"><?= $strings['case.details.defendants']; ?></label>
					<ul id="defendants_list" class="sublist">
						<?php foreach($the_case->defendants->order_by('person_lastname', 'asc')->find_all() as $defendant):?>
						<li id="<?= $defendant->id; ?>">
							<?= $defendant->person_title.' '.$defendant->person_firstname.' '.$defendant->person_lastname ?><br/>
							<span class="small">
								<?= $defendant->address->address_street.' '.$defendant->address->address_street_number.', '.$defendant->address->place->id.' '.$defendant->address->place->place_name ?><br>
								Telefon: <?= $defendant->address->address_phone_number; ?>, Handy: <?= $defendant->address->address_cellphone; ?>, E-Mail: <?= $defendant->address->address_email; ?>
							</span>
							<button class="person_edit" href=""><img src="img/icon_pencil.png" alt="icon_pencil" />
						</li>
						<?php endforeach;?>
					</ul>
					<div id="defendants_menu" class="menu ui-state-default"><button id="defendant_add_dialog_open"><span class="ui-icon ui-icon-circle-plus"></span>Beklagten hinzufügen</button></div>
					<div id="defendant_add_dialog" title="Beklagten hinzufügen">
						<div id="defendant_add_tabs"> 
							<ul>
								<li><a href="#defendant_add_1"><?= $strings['case.details.search']; ?></a></li>
								<li><a href="#defendant_add_2"><?= $strings['case.details.create']; ?></a></li>
							</ul>
							<div id="defendant_add_1">
								<div class="container_12">
									<fieldset>
										<div class="grid_12">
											<p><?= $strings['case.details.claimantSearchInfo']; ?></p>
											<input type="text" name="defendant_search" id="defendant_search" />
										</div>
									</fieldset>
								</div>
							</div>
							<div id="defendant_add_2">
								<div class="container_12">
									<fieldset>
										<div class="grid_2"><label for="person_title"><?= $strings['case.details.form.title']; ?></label><select name="person_title" id="person_title">
											<option value=""></option>
											<option value="Herr">Herr</option>
											<option value="Frau">Frau</option>
										</select></div>
										<div class="grid_5"><label for="person_firstname"><?= $strings['case.details.form.firstname']; ?></label><input type="text" name="person_firstname" id="person_firstname" /></div>
										<div class="grid_5"><label for="person_lastname"><?= $strings['case.details.form.lastname']; ?></label><input type="text" name="person_lastname" id="person_lastname" /></div>
									</fieldset>
									<fieldset>
										<div class="grid_10"><label for="address_street"><?= $strings['case.details.form.street']; ?></label><input type="text" name="address_street" id="address_street" /></div>
										<div class="grid_2"><label for="address_street_number"><?= $strings['case.details.form.streetNumber']; ?></label><input type="text" name="address_street_number" id="address_street_number" /></div>
									</fieldset>
									<fieldset>
										<div class="grid_4"><label for="zipcode"><?= $strings['case.details.form.zipcode']; ?></label><input type="text" name="zipcode" id="zipcode" /></div>
										<div class="grid_8"><label for="place_name"><?= $strings['case.details.form.place']; ?></label><input type="text" name="place_name" id="place_name" /></div>
									</fieldset>
									<fieldset>
										<div class="grid_4"><label for="address_phone_number"><?= $strings['case.details.form.phoneNumber']; ?></label><input type="text" name="address_phone_number" id="address_phone_number" /></div>
										<div class="grid_4"><label for="address_fax_number"><?= $strings['case.details.form.faxNumber']; ?></label><input type="text" name="address_fax_number" id="address_fax_number" /></div>
										<div class="grid_4"><label for="address_cellphone"><?= $strings['case.details.form.mobileNumber']; ?></label><input type="text" name="address_cellphone" id="address_cellphone" /></div>
										<div class="grid_4"><label for="address_email"><?= $strings['case.details.form.email']; ?></label><input type="text" name="address_email" id="address_email" /></div>
									</fieldset>
									<fieldset>
										<div class="grid_4"><label for="person_dob2"><?= $strings['case.details.form.birthdate']; ?></label><input type="text" name="person_dob" id="person_dob2" class="hasDatepicker"></div>
										<div class="grid_4"><label for="person_state"><?= $strings['case.details.form.nationality']; ?></label><input type="text" name="person_state" id="person_state"></div>
										<div class="grid_4"><label for="person_accountnumber"><?= $strings['case.details.form.bankAccount']; ?></label><input type="text" name="person_accountnumber" id="person_accountnumber"></div>
										<div class="grid_4"><label for="person_bankcode"><?= $strings['case.details.form.bankNumber']; ?></label><input type="text" name="person_bankcode" id="person_bankcode"></div>
									</fieldset>
									<?php if(in_array('admin', $roles)) { ?>
										<fieldset>
											<div class="grid_4">
												<label for="user_id">Auftraggeber</label>
												<select name="user_id" id="user_id">
													<option value=""></option>
													<?php foreach ($users as $user) { ?>
														<option value="<?= $user->id ?>"><?= $user->username ?></option>
													<?php } ?>
												</select>
											</div>
										</fieldset>
									<?php } ?>
									<fieldset>
										<div class="grid_12"><button id="defendant_add"><?= $strings['case.details.btn.saveDefendant']; ?></button></div>
									</fieldset>
								</div>
							</div>
						</div>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<div class="grid_9"><label for="case_reason"><?= $strings['case.details.caseReason']; ?></label><textarea name="case_reason" id="case_reason" rel="case"><?= $the_case->case_reason ?></textarea></div>
				<div class="grid_3"><label for="case_type"><?= $strings['case.details.caseType']; ?></label><input type="text" name="case_type" id="case_type" value="<?= $the_case->casetype->type_name ?>"/></div>
			</fieldset>
			<fieldset>
				<div class="grid_6" id="<?= $the_case->cl_lawyer_id; ?>"><label for="cl_lawyer_name"><?= $strings['case.details.claimantLawyer']; ?></label><br /><input type="text" style="width:80%;" name="cl_lawyer_name" id="cl_lawyer_name" value="<?= $the_case->cl_lawyer->person_title.' '.$the_case->cl_lawyer->person_firstname.' '.$the_case->cl_lawyer->person_lastname ?>" /><button class="person_edit inline"><img src="img/icon_pencil.png" /></button></div>
				<div class="grid_3"><label for="cl_lawye_charged"><?= $strings['case.details.claimantCharged']; ?></label><input type="text" name="cl_lawyer_charged" id="cl_lawyer_charged" rel="case" class="datepicker" value="<?= date('d.m.Y', strtotime($the_case->cl_lawyer_charged)) ?>" /></div>
				<div class="grid_3"><label for="cl_lawyer_ref"><?= $strings['case.details.claimantRef']; ?></label><input type="text" name="cl_lawyer_ref" id="cl_lawyer_ref" rel="case" value="<?= $the_case->cl_lawyer_ref ?>" /></div>
				<div id="cl_lawyer_add_dialog" title="Anwalt hinzufügen">
					<div id="cl_lawyer_add_tabs"> 
						<ul>
							<li><a href="#cl_lawyer_add_1"><?= $strings['case.details.search']; ?></a></li>
							<li><a href="#cl_lawyer_add_2"><?= $strings['case.details.create']; ?></a></li>
						</ul>
						<div id="cl_lawyer_add_1">
							<div class="container_12">
								<fieldset>
									<div class="grid_12">
										<p><?= $strings['case.details.claimantSearchInfo']; ?></p>
										<input type="text" name="cl_lawyer_search" id="cl_lawyer_search" />
									</div>
								</fieldset>
							</div>
						</div>
						<div id="cl_lawyer_add_2">
							<div class="container_12">
								<fieldset>
									<div class="grid_2"><label for="person_title"><?= $strings['case.details.form.title']; ?></label><select name="person_title" id="person_title">
										<option value=""></option>
										<option value="Herr">Herr</option>
										<option value="Frau">Frau</option>
									</select></div>
									<div class="grid_5"><label for="person_firstname"><?= $strings['case.details.form.firstname']; ?></label><input type="text" name="person_firstname" id="person_firstname" /></div>
									<div class="grid_5"><label for="person_lastname"><?= $strings['case.details.form.lastname']; ?></label><input type="text" name="person_lastname" id="person_lastname" /></div>
								</fieldset>
								<fieldset>
									<div class="grid_10"><label for="address_street"><?= $strings['case.details.form.street']; ?></label><input type="text" name="address_street" id="address_street" /></div>
									<div class="grid_2"><label for="address_street_number"><?= $strings['case.details.form.streetNumber']; ?></label><input type="text" name="address_street_number" id="address_street_number" /></div>
								</fieldset>
								<fieldset>
									<div class="grid_4"><label for="zipcode"><?= $strings['case.details.form.zipcode']; ?></label><input type="text" name="zipcode" id="zipcode" /></div>
									<div class="grid_8"><label for="place_name"><?= $strings['case.details.form.place']; ?></label><input type="text" name="place_name" id="place_name" /></div>
								</fieldset>
								<fieldset>
									<div class="grid_4"><label for="address_phone_number"><?= $strings['case.details.form.phoneNumber']; ?></label><input type="text" name="address_phone_number" id="address_phone_number" /></div>
									<div class="grid_4"><label for="address_fax_number"><?= $strings['case.details.form.faxNumber']; ?></label><input type="text" name="address_fax_number" id="address_fax_number" /></div>
									<div class="grid_4"><label for="address_email"><?= $strings['case.details.form.email']; ?></label><input type="text" name="address_email" id="address_email" /></div>
								</fieldset>
								<?php if(in_array('admin', $roles)) { ?>
									<fieldset>
										<div class="grid_4">
											<label for="user_id">Auftraggeber</label>
											<select name="user_id" id="user_id">
												<option value=""></option>
												<?php foreach ($users as $user) { ?>
													<option value="<?= $user->id ?>"><?= $user->username ?></option>
												<?php } ?>
											</select>
										</div>
									</fieldset>
								<?php } ?>
								<fieldset>
									<div class="grid_12"><button id="cl_lawyer_add"><?= $strings['case.details.form.btn.saveClaimant']; ?></button></div>
								</fieldset>
							</div>
						</div>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<div class="grid_6" id="<?= $the_case->def_lawyer_id; ?>"><label for="def_lawyer_name"><?= $strings['case.details.defendantLawyer']; ?></label><br /><input type="text" style="width:80%;" name="def_lawyer_name" id="def_lawyer_name" value="<?= $the_case->def_lawyer->person_title.' '.$the_case->def_lawyer->person_firstname.' '.$the_case->def_lawyer->person_lastname ?>" /><button class="person_edit inline"><img src="img/icon_pencil.png" /></button></div>
				<div class="grid_3"><label for="def_lawyer_ref"><?= $strings['case.details.defendantRef']; ?></label><input type="text" name="def_lawyer_ref" id="def_lawyer_ref" rel="case" value="<?= $the_case->def_lawyer_ref ?>" /></div>
				<div id="def_lawyer_add_dialog" title="Anwalt Gegenseite hinzufügen">
					<div id="def_lawyer_add_tabs"> 
						<ul>
							<li><a href="#def_lawyer_add_1"><?= $strings['case.details.search']; ?></a></li>
							<li><a href="#def_lawyer_add_2"><?= $strings['case.details.create']; ?></a></li>
						</ul>
						<div id="def_lawyer_add_1">
							<div class="container_12">
								<fieldset>
									<div class="grid_12">
										<p><?= $strings['case.details.claimantSearchInfo']; ?></p>
										<input type="text" name="def_lawyer_search" id="def_lawyer_search" />
									</div>
								</fieldset>
							</div>
						</div>
						<div id="def_lawyer_add_2">
							<div class="container_12">
								<fieldset>
									<div class="grid_2"><label for="person_title"><?= $strings['case.details.form.title']; ?></label><select name="person_title" id="person_title">
										<option value=""></option>
										<option value="Herr">Herr</option>
										<option value="Frau">Frau</option>
									</select></div>
									<div class="grid_5"><label for="person_firstname"><?= $strings['case.details.form.firstname']; ?></label><input type="text" name="person_firstname" id="person_firstname" /></div>
									<div class="grid_5"><label for="person_lastname"><?= $strings['case.details.form.lastname']; ?></label><input type="text" name="person_lastname" id="person_lastname" /></div>
								</fieldset>
								<fieldset>
									<div class="grid_10"><label for="address_street"><?= $strings['case.details.form.street']; ?></label><input type="text" name="address_street" id="address_street" /></div>
									<div class="grid_2"><label for="address_street_number"><?= $strings['case.details.form.streetNumber']; ?></label><input type="text" name="address_street_number" id="address_street_number" /></div>
								</fieldset>
								<fieldset>
									<div class="grid_4"><label for="zipcode"><?= $strings['case.details.form.zipcode']; ?></label><input type="text" name="zipcode" id="zipcode" /></div>
									<div class="grid_8"><label for="place_name"><?= $strings['case.details.form.place']; ?></label><input type="text" name="place_name" id="place_name" /></div>
								</fieldset>
								<fieldset>
									<div class="grid_4"><label for="address_phone_number"><?= $strings['case.details.form.phoneNumber']; ?></label><input type="text" name="address_phone_number" id="address_phone_number" /></div>
									<div class="grid_4"><label for="address_fax_number"><?= $strings['case.details.form.faxNumber']; ?></label><input type="text" name="address_fax_number" id="address_fax_number" /></div>
									<div class="grid_4"><label for="address_email"><?= $strings['case.details.form.email']; ?></label><input type="text" name="address_email" id="address_email" /></div>
								</fieldset>
								<?php if(in_array('admin', $roles)) { ?>
									<fieldset>
										<div class="grid_4">
											<label for="user_id">Auftraggeber</label>
											<select name="user_id" id="user_id">
												<option value=""></option>
												<?php foreach ($users as $user) { ?>
													<option value="<?= $user->id ?>"><?= $user->username ?></option>
												<?php } ?>
											</select>
										</div>
									</fieldset>
								<?php } ?>
								<fieldset>
									<div class="grid_12"><button id="def_lawyer_add"><?= $strings['case_details.saveDefendantLawyer']; ?></button></div>
								</fieldset>
							</div>
						</div>
					</div>
				</div>
				<div class="grid_3"><label for="court_ref"><?= $strings['case_details.courtRef']; ?></label><input type="text" name="court_ref" id="court_ref" rel="case" value="<?= $the_case->court_ref ?>" /></div>
			</fieldset>
			<fieldset>
				<div class="grid_6" id="<?= $the_case->bailiff_id; ?>"><label for="bailiff_name"><?= $strings['case_details.bailiff']; ?></label><br /><input type="text" style="width:80%;" name="bailiff_name" id="bailiff_name" value="<?= $the_case->bailiff->person_title.' '.$the_case->bailiff->person_firstname.' '.$the_case->bailiff->person_lastname ?>" /><button class="person_edit inline"><img src="img/icon_pencil.png" /></button></div>
				<div class="grid_3"><label for="bailiff_charged"><?= $strings['case_details.bailiffCharged']; ?></label><input type="text" name="bailiff_charged" id="bailiff_charged" rel="case" class="datepicker" value="<?= date('d.m.Y', strtotime($the_case->bailiff_charged)) ?>" /></div>
				<div class="grid_3"><label for="bailiff_ref"><?= $strings['case_details.bailiffRef']; ?></label><input type="text" name="bailiff_ref" id="bailiff_ref" rel="case" value="<?= $the_case->bailiff_ref ?>" /></div>
				<div id="bailiff_add_dialog" title="Gerichtsvollzieher hinzufügen">
					<div id="bailiff_add_tabs"> 
						<ul>
							<li><a href="#bailiff_add_1"><?= $strings['case.details.search']; ?></a></li>
							<li><a href="#bailiff_add_2"><?= $strings['case.details.create']; ?></a></li>
						</ul>
						<div id="bailiff_add_1">
							<div class="container_12">
								<fieldset>
									<div class="grid_12">
										<p><?= $strings['case.details.claimantSearchInfo']; ?></p>
										<input type="text" name="bailiff_search" id="bailiff_search" />
									</div>
								</fieldset>
							</div>
						</div>
						<div id="bailiff_add_2">
							<div class="container_12">
								<fieldset>
									<div class="grid_2"><label for="person_title"><?= $strings['case.details.form.title']; ?></label><select name="person_title" id="person_title">
										<option value=""></option>
										<option value="Herr">Herr</option>
										<option value="Frau">Frau</option>
									</select></div>
									<div class="grid_5"><label for="person_firstname"><?= $strings['case.details.form.firstname']; ?></label><input type="text" name="person_firstname" id="person_firstname" /></div>
									<div class="grid_5"><label for="person_lastname"><?= $strings['case.details.form.lastname']; ?></label><input type="text" name="person_lastname" id="person_lastname" /></div>
								</fieldset>
								<fieldset>
									<div class="grid_10"><label for="address_street"><?= $strings['case.details.form.street']; ?></label><input type="text" name="address_street" id="address_street" /></div>
									<div class="grid_2"><label for="address_street_number"><?= $strings['case.details.form.streetNumber']; ?></label><input type="text" name="address_street_number" id="address_street_number" /></div>
								</fieldset>
								<fieldset>
									<div class="grid_4"><label for="zipcode"><?= $strings['case.details.form.zipcode']; ?></label><input type="text" name="zipcode" id="zipcode" /></div>
									<div class="grid_8"><label for="place_name"><?= $strings['case.details.form.place']; ?></label><input type="text" name="place_name" id="place_name" /></div>
								</fieldset>
								<fieldset>
									<div class="grid_4"><label for="address_phone_number"><?= $strings['case.details.form.phoneNumber']; ?></label><input type="text" name="address_phone_number" id="address_phone_number" /></div>
									<div class="grid_4"><label for="address_fax_number"><?= $strings['case.details.form.faxNumber']; ?></label><input type="text" name="address_fax_number" id="address_fax_number" /></div>
									<div class="grid_4"><label for="address_email"><?= $strings['case.details.form.email']; ?></label><input type="text" name="address_email" id="address_email" /></div>
								</fieldset>
								<?php if(in_array('admin', $roles)) { ?>
									<fieldset>
										<div class="grid_4">
											<label for="user_id">Auftraggeber</label>
											<select name="user_id" id="user_id">
												<option value=""></option>
												<?php foreach ($users as $user) { ?>
													<option value="<?= $user->id ?>"><?= $user->username ?></option>
												<?php } ?>
											</select>
										</div>
									</fieldset>
								<?php } ?>
								<fieldset>
									<div class="grid_12"><button id="bailiff_add"><?= $strings['case_details.saveBailiff']; ?></button></div>
								</fieldset>
							</div>
						</div>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<div class="grid_6" id="<?= $the_case->syndicate_id; ?>"><label for="syndicate_name">ARGE</label><br /><input type="text" style="width:80%;" name="syndicate_name" id="syndicate_name" value="<?= $the_case->syndicate->person_title.' '.$the_case->syndicate->person_firstname.' '.$the_case->syndicate->person_lastname ?>" /><button class="person_edit inline"><img src="img/icon_pencil.png" /></button></div>
				<div class="grid_3"><label for="syndicate_bgnr">BG-Nr. ARGE</label><input type="text" name="syndicate_bgnr" id="syndicate_bgnr" rel="case" value="<?= $the_case->syndicate_bgnr ?>" /></div>
				<div class="grid_3"><label for="syndicate_ref">Aktenzeichen ARGE</label><input type="text" name="syndicate_ref" id="syndicate_ref" rel="case" value="<?= $the_case->syndicate_ref ?>" /></div>
				<div id="syndicate_add_dialog" title="<?= $strings['case.details.btn.addSyndicate']; ?>">
					<div id="syndicate_add_tabs"> 
						<ul>
							<li><a href="#syndicate_add_1"><?= $strings['case.details.search']; ?></a></li>
							<li><a href="#syndicate_add_2"><?= $strings['case.details.create']; ?></a></li>
						</ul>
						<div id="syndicate_add_1">
							<div class="container_12">
								<fieldset>
									<div class="grid_12">
										<p><?= $strings['case.details.claimantSearchInfo']; ?></p>
										<input type="text" name="syndicate_search" id="syndicate_search" />
									</div>
								</fieldset>
							</div>
						</div>
						<div id="syndicate_add_2">
							<div class="container_12">
								<fieldset>
									<div class="grid_2"><label for="person_title"><?= $strings['case.details.form.title']; ?></label><select name="person_title" id="person_title">
										<option value=""></option>
										<option value="Herr">Herr</option>
										<option value="Frau">Frau</option>
									</select></div>
									<div class="grid_5"><label for="person_firstname"><?= $strings['case.details.form.firstname']; ?></label><input type="text" name="person_firstname" id="person_firstname" /></div>
									<div class="grid_5"><label for="person_lastname"><?= $strings['case.details.form.lastname']; ?></label><input type="text" name="person_lastname" id="person_lastname" /></div>
								</fieldset>
								<fieldset>
									<div class="grid_10"><label for="address_street"><?= $strings['case.details.form.street']; ?></label><input type="text" name="address_street" id="address_street" /></div>
									<div class="grid_2"><label for="address_street_number"><?= $strings['case.details.form.streetNumber']; ?></label><input type="text" name="address_street_number" id="address_street_number" /></div>
								</fieldset>
								<fieldset>
									<div class="grid_4"><label for="zipcode"><?= $strings['case.details.form.zipcode']; ?></label><input type="text" name="zipcode" id="zipcode" /></div>
									<div class="grid_8"><label for="place_name"><?= $strings['case.details.form.place']; ?></label><input type="text" name="place_name" id="place_name" /></div>
								</fieldset>
								<fieldset>
									<div class="grid_4"><label for="address_phone_number"><?= $strings['case.details.form.phoneNumber']; ?></label><input type="text" name="address_phone_number" id="address_phone_number" /></div>
									<div class="grid_4"><label for="address_fax_number"><?= $strings['case.details.form.faxNumber']; ?></label><input type="text" name="address_fax_number" id="address_fax_number" /></div>
									<div class="grid_4"><label for="address_email"><?= $strings['case.details.form.email']; ?></label><input type="text" name="address_email" id="address_email" /></div>
								</fieldset>
								<?php if(in_array('admin', $roles)) { ?>
									<fieldset>
										<div class="grid_4">
											<label for="user_id">Auftraggeber</label>
											<select name="user_id" id="user_id">
												<option value=""></option>
												<?php foreach ($users as $user) { ?>
													<option value="<?= $user->id ?>"><?= $user->username ?></option>
												<?php } ?>
											</select>
										</div>
									</fieldset>
								<?php } ?>
								<fieldset>
									<div class="grid_12"><button id="syndicate_add"><?= $strings['case.details.btn.addSyndicate']; ?></button></div>
								</fieldset>
							</div>
						</div>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<div class="grid_6" id="<?= $the_case->club_id; ?>"><label for="club_name"><?= $strings['case.details.clubName']; ?></label><br /><input type="text" style="width:80%;" name="club_name" id="club_name" value="<?= $the_case->club->person_title.' '.$the_case->club->person_firstname.' '.$the_case->club->person_lastname ?>" /><button class="person_edit inline"><img src="img/icon_pencil.png" /></button></div>
				<div class="grid_3"><label for="club_ref"><?= $strings['case.details.clubRef']; ?></label><input type="text" name="club_ref" id="club_ref" rel="case" value="<?= $the_case->club_ref ?>" /></div>
				<div id="club_add_dialog" title="<?= $strings['case.details.clubAdd']; ?>">
					<div id="club_add_tabs"> 
						<ul>
							<li><a href="#club_add_1"><?= $strings['case.details.search']; ?></a></li>
							<li><a href="#club_add_2"><?= $strings['case.details.create']; ?></a></li>
						</ul>
						<div id="club_add_1">
							<div class="container_12">
								<fieldset>
									<div class="grid_12">
										<p><?= $strings['case.details.claimantSearchInfo']; ?></p>
										<input type="text" name="club_search" id="club_search" />
									</div>
								</fieldset>
							</div>
						</div>
						<div id="club_add_2">
							<div class="container_12">
								<fieldset>
									<div class="grid_2"><label for="person_title"><?= $strings['case.details.form.title']; ?></label><select name="person_title" id="person_title">
										<option value=""></option>
										<option value="Herr">Herr</option>
										<option value="Frau">Frau</option>
									</select></div>
									<div class="grid_5"><label for="person_firstname"><?= $strings['case.details.form.firstname']; ?></label><input type="text" name="person_firstname" id="person_firstname" /></div>
									<div class="grid_5"><label for="person_lastname"><?= $strings['case.details.form.lastname']; ?></label><input type="text" name="person_lastname" id="person_lastname" /></div>
								</fieldset>
								<fieldset>
									<div class="grid_10"><label for="address_street"><?= $strings['case.details.form.street']; ?></label><input type="text" name="address_street" id="address_street" /></div>
									<div class="grid_2"><label for="address_street_number"><?= $strings['case.details.form.streetNumber']; ?></label><input type="text" name="address_street_number" id="address_street_number" /></div>
								</fieldset>
								<fieldset>
									<div class="grid_4"><label for="zipcode"><?= $strings['case.details.form.zipcode']; ?></label><input type="text" name="zipcode" id="zipcode" /></div>
									<div class="grid_8"><label for="place_name"><?= $strings['case.details.form.place']; ?></label><input type="text" name="place_name" id="place_name" /></div>
								</fieldset>
								<fieldset>
									<div class="grid_4"><label for="address_phone_number"><?= $strings['case.details.form.phoneNumber']; ?></label><input type="text" name="address_phone_number" id="address_phone_number" /></div>
									<div class="grid_4"><label for="address_fax_number"><?= $strings['case.details.form.faxNumber']; ?></label><input type="text" name="address_fax_number" id="address_fax_number" /></div>
									<div class="grid_4"><label for="address_email"><?= $strings['case.details.form.email']; ?></label><input type="text" name="address_email" id="address_email" /></div>
								</fieldset>
								<?php if(in_array('admin', $roles)) { ?>
									<fieldset>
										<div class="grid_4">
											<label for="user_id">Auftraggeber</label>
											<select name="user_id" id="user_id">
												<option value=""></option>
												<?php foreach ($users as $user) { ?>
													<option value="<?= $user->id ?>"><?= $user->username ?></option>
												<?php } ?>
											</select>
										</div>
									</fieldset>
								<?php } ?>
								<fieldset>
									<div class="grid_12"><button id="club_add"><?= $strings['case.details.btn.saveClub']; ?></button></div>
								</fieldset>
							</div>
						</div>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<div class="grid_12">
					<label for="events_list"><?= $strings['case.details.events']; ?></label>
					<ul id="events_list" class="sublist">
						<?php foreach($the_case->events->order_by('event_date', 'asc')->find_all() as $event):?>
						<li class="<?= $event->id ?>">
							<span class="grid_6"><?= $event->eventtype->type_name ?> <?= ($event->event_file != '')?'<a href="'.$event->event_file.'" target="_blank" class="download"><img src="img/icon-file-ffffff.png"/> Anhang</a>':'' ?></span>
							<span class="grid_6 right"><?= date('d.m.Y', strtotime($event->event_date)) ?> (Session: <?= $event->event_session ?>)</span>
							<div class="clear"></div>
							<span class="grid_12 small"><?= $event->event_description ?></span>
							<div class="clear"></div>
							</span><button class="event_edit"><img src="img/icon_pencil.png" alt="icon_pencil" /><!-- </button><button class="event_delete"><img src="img/icon_trash.png" alt="icon_trash" /></button> -->
						</li>
						<?php endforeach;?>
					</ul>
					<div id="events_menu" class="menu ui-state-default"><button id="event_add_dialog_open"><span class="ui-icon ui-icon-circle-plus"></span><?= $strings['case.details.btn.addEvent']; ?></button></div>
					<div id="event_add_dialog" title="Neues Ereignis erfassen">
						<div class="container_12">
							<fieldset>
								<div class="grid_6"><label for="event_type"><?= $strings['case.details.eventType']; ?></label><input type="text" name="event_type" id="event_type" /></div>
								<div class="grid_6"><label for="event_date"><?= $strings['case.details.eventDate']; ?></label><input type="text" name="event_date" id="event_date" /></div>
							</fieldset>
							<fieldset>
								<div class="grid_3">
								<input type="file" name="select_file" id="select_file" accept="application/pdf">
								</div>
								<div class="grid_9">
								<input type="text" name="event_file" readonly="readonly" id="event_file" />
								</div>
						    </fieldset>
							<fieldset>
								<div class="grid_12"><label for="event_description"><?= $strings['case.details.eventDescription']; ?></label><textarea name="event_description" id="event_description"></textarea></div>
							</fieldset>
							<fieldset>
								<div class="grid_12">
									<label for="case_status">Status des Falles</label>
									<select name="case_status" id="case_status">
										<option value=""><?= $strings['case.details.noChange']; ?></option>
										<?php foreach ($statuses as $status) { ?>
											<option value="<?= $status->id ?>"><?= $status->name ?></option>
										<?php } ?>
									</select>
								</div>
							</fieldset>
							<fieldset>
								<div class="grid_12"><button id="event_add"><?= $strings['case.details.btn.saveEvent']; ?></button></div>
							</fieldset>
						</div>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<div id="appointments" class="grid_12">
					<label for="appointments_list"><?= $strings['case.details.appointments']; ?></label>
					<ul id="appointments_list" class="sublist">
						<?php foreach($the_case->appointments->order_by('appointment_datetime', 'asc')->find_all() as $appointment):?>
						<li class="<?= $appointment->id ?>">
							<span class="grid_6"><?= date('d.m.Y', strtotime($appointment->appointment_datetime)) ?> (Session: <?= $appointment->appointment_session ?>)</span>
							<span class="grid_6 right"><?= date('H:i', strtotime($appointment->appointment_datetime)) ?><?= $strings['appointment_list.oclock']; ?></span>
							<div class="clear"></div>
							<span class="grid_6"><?= $appointment->appointment_location ?></span>
							<span class="grid_6 right"><?= ($appointment->appointment_eviction) ? $strings['appointment_list.evictionDone'] : '' ?></span>
							<div class="clear"></div>
							<span class="grid_12 small"><?= $appointment->appointment_description ?></span>
							<div class="clear"></div>
							</span><button class="appointment_edit"><img src="img/icon_pencil.png" alt="icon_pencil" /><!-- </button><button class="appointment_delete"><img src="img/icon_trash.png" alt="icon_trash" /></button> -->
						</li>
						<?php endforeach;?>
					</ul>
					<div id="appointments_menu" class="menu ui-state-default"><button id="appointment_add_dialog_open"><span class="ui-icon ui-icon-circle-plus"></span>Neuer Termin</button></div>
					<div id="appointment_add_dialog" title="Neuen Termin erfassen">
						<div class="container_12">
							<fieldset>
								<div class="grid_6"><label for="appointment_date"><?= $strings['appointment_edit.date']; ?></label><input type="text" name="appointment_date" id="appointment_date" /></div>
								<div class="grid_3"><label for="appointment_hour"><?= $strings['appointment_edit.time']; ?></label><br/><input type="text" name="appointment_hour" id="appointment_hour" maxlength="2" style="width:30px;" /> : <input type="text" name="appointment_minute" id="appointment_minute" maxlength="2" style="width:30px;" /></div>
							</fieldset>
							<fieldset>
								<label for="appointment_location"><?= $strings['appointment_edit.location']; ?></label><input type="text" name="appointment_location" id="appointment_location" />
							</fieldset>
							<fieldset>
								<label for="appointment_eviction"><?= $strings['appointment_edit.evictionDone']; ?></label> <input type="checkbox" name="appointment_eviction" id="appointment_eviction" />
							</fieldset>
							<fieldset>
								<div class="grid_12"><label for="appointment_description"><?= $strings['appointment_edit.description']; ?></label><textarea name="appointment_description" id="appointment_description"></textarea></div>
							</fieldset>
							<fieldset>
								<div class="grid_12"><button id="appointment_add"><?= $strings['appointment_edit.btn.edit']; ?></button></div>
							</fieldset>
						</div>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<div class="grid_12">
					<div id="costs_tabs"> 
						<ul class="reiter">
							<li><a href="#costs_list_1"><?= $strings['case.details.costsList1']; ?></a></li>
							<li><a href="#costs_list_2"><?= $strings['case.details.costsList2']; ?></a></li>
							<li><a href="#costs_list_3"><?= $strings['case.details.costsList3']; ?></a></li>
							<li><a href="#costs_list_4"><?= $strings['case.details.costsList4']; ?></a></li>
						</ul>
						<label class="costs_headine"><?= $strings['case.details.costsList1']; ?></label>
						<ul id="costs_list_1" class="sublist">
							<?php 
							$cost_amount = 0;
							foreach($the_case->costs->where('cost_category', '=', '0')->order_by('cost_date', 'asc')->find_all() as $cost):
							$cost_amount = $cost_amount+$cost->cost_amount ?>
							<li class="<?= $cost->id ?>">
								<span class="grid_6"><?= date('d.m.Y', strtotime($cost->cost_date)) ?> (Session: <?= $cost->cost_session ?>) <?= ($cost->cost_file != '')?'<a href="'.$cost->cost_file.'" target="_blank" class="download"><img src="img/icon-file-ffffff.png"/> Anhang</a>':'' ?></span>
								<span class="grid_6 right amount"><?= number_format($cost->cost_amount, 2, ',', '.'); ?> €</span>
								<div class="clear"></div>
								<span class="grid_12 small"><?= $cost->costtype->type_name ?></span>
								</span><button class="cost_edit"><img src="img/icon_pencil.png" alt="icon_pencil" /></button><button class="cost_delete"><img src="img/icon_trash.png" alt="icon_trash" /></button>
								<div class="clear"></div>
							</li>
							<?php endforeach;?>
							<li class="cost_total">
								<span class="grid_6 right"><strong><?= number_format($cost_amount, 2, ',', '.'); ?> €</strong></span>
								<div class="clear"></div>
							</li>
						</ul>
						<label class="costs_headine"><?= $strings['case.details.costsList2']; ?></label>
						<ul id="costs_list_2" class="sublist">
							<?php 
							$cost_amount = 0;
							foreach($the_case->costs->where('cost_category', '=', '1')->order_by('cost_date', 'asc')->find_all() as $cost):
							$cost_amount = $cost_amount+$cost->cost_amount ?>
							<li class="<?= $cost->id ?>">
								<span class="grid_6"><?= date('d.m.Y', strtotime($cost->cost_date)) ?> (Session: <?= $cost->cost_session ?>) <?= ($cost->cost_file != '')?'<a href="'.$cost->cost_file.'" target="_blank" class="download"><img src="img/icon-file-ffffff.png"/> Anhang</a>':'' ?></span>
								<span class="grid_6 right amount"><?= number_format($cost->cost_amount, 2, ',', '.'); ?> €</span>
								<div class="clear"></div>
								<span class="grid_12 small"><?= $cost->costtype->type_name ?></span>
								</span><button class="cost_edit"><img src="img/icon_pencil.png" alt="icon_pencil" /></button><button class="cost_delete"><img src="img/icon_trash.png" alt="icon_trash" /></button>
								<div class="clear"></div>
							</li>
							<?php endforeach;?>
							<li class="cost_total">
								<span class="grid_6 right"><strong><?= number_format($cost_amount, 2, ',', '.'); ?> €</strong></span>
								<div class="clear"></div>
							</li>
						</ul>
						<label class="costs_headine"><?= $strings['case.details.costsList3']; ?></label>
						<ul id="costs_list_3" class="sublist">
							<?php 
							$cost_amount = 0;
							foreach($the_case->costs->where('cost_category', '=', '2')->order_by('cost_date', 'asc')->find_all() as $cost):
							$cost_amount = $cost_amount+$cost->cost_amount ?>
							<li class="<?= $cost->id ?>">
								<span class="grid_6"><?= date('d.m.Y', strtotime($cost->cost_date)) ?> (Session: <?= $cost->cost_session ?>) <?= ($cost->cost_file != '')?'<a href="'.$cost->cost_file.'" target="_blank" class="download"><img src="img/icon-file-ffffff.png"/> Anhang</a>':'' ?></span>
								<span class="grid_6 right amount"><?= number_format($cost->cost_amount, 2, ',', '.'); ?> €</span>
								<div class="clear"></div>
								<span class="grid_12 small"><?= $cost->costtype->type_name ?></span>
								</span><button class="cost_edit"><img src="img/icon_pencil.png" alt="icon_pencil" /></button><button class="cost_delete"><img src="img/icon_trash.png" alt="icon_trash" /></button>
								<div class="clear"></div>
							</li>
							<?php endforeach;?>
							<li class="cost_total">
								<span class="grid_6 right"><strong><?= number_format($cost_amount, 2, ',', '.'); ?> €</strong></span>
								<div class="clear"></div>
							</li>
						</ul>
						<label class="costs_headine"><?= $strings['case.details.costsList4']; ?></label>
						<ul id="costs_list_4" class="sublist">
							<?php 
							$cost_amount = 0;
							foreach($the_case->costs->where('cost_payment', '=', '1')->order_by('cost_date', 'asc')->find_all() as $cost):
							$cost_amount = $cost_amount+$cost->cost_amount ?>
							<li class="<?= $cost->id ?>">
								<span class="grid_6"><?= date('d.m.Y', strtotime($cost->cost_date)) ?> (Session: <?= $cost->cost_session ?>) <?= ($cost->cost_file != '')?'<a href="'.$cost->cost_file.'" target="_blank" class="download"><img src="img/icon-file-ffffff.png"/> Anhang</a>':'' ?></span>
								<span class="grid_6 right amount"><?= number_format($cost->cost_amount, 2, ',', '.'); ?> €</span>
								<div class="clear"></div>
								<span class="grid_12 small"><?= $cost->costtype->type_name ?></span>
								</span><button class="cost_edit"><img src="img/icon_pencil.png" alt="icon_pencil" /></button><button class="cost_delete"><img src="img/icon_trash.png" alt="icon_trash" /></button>
								<div class="clear"></div>
							</li>
							<?php endforeach;?>
							<li class="cost_total">
								<span class="grid_6 right"><strong><?= number_format($cost_amount, 2, ',', '.'); ?> €</strong></span>
								<div class="clear"></div>
							</li>
						</ul>
					</div>
					<div id="costs_menu" class="menu ui-state-default"><button id="cost_add_dialog_open"><span class="ui-icon ui-icon-circle-plus"></span>Neue Kosten</button></div>
					<div id="cost_add_dialog" title="<?= $strings['case.details.btn.addCosts']; ?>">
						<div class="container_12">
							<fieldset>
								<div class="grid_6"><label for="cost_date"><?= $strings['case.details.costDate']; ?></label><input type="text" name="cost_date" id="cost_date" /></div>
								<div class="grid_6"><label for="cost_amount"><?= $strings['case.details.costValue']; ?></label><input type="text" name="cost_amount" id="cost_amount" /></div>
							</fieldset>
							<fieldset>
								<div class="grid_6"><label for="cost_type"><?= $strings['case.details.costType']; ?></label><input type="text" name="cost_type" id="cost_type" /></div>
								<div class="grid_6"><input type="checkbox" name="cost_payment" id="cost_payment" value="1" /> <label for="cost_payment">Zahlung</label></div>
							</fieldset>
							<fieldset>
								<div class="grid_3">
								<input type="file" name="cost_select_file" id="cost_select_file" accept="application/pdf">
								</div>
								<div class="grid_9">
								<input type="text" name="cost_file" readonly="readonly" id="cost_file" />
								</div>
						    </fieldset>
							<fieldset>
								<div class="grid_12"><button id="cost_add"><?= $strings['case.details.btn.saveCosts']; ?></button></div>
							</fieldset>
						</div>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<div class="grid_12">
					<label for="case_memo"><?= $strings['case.details.memo']; ?></label>
					<textarea name="case_memo" id="case_memo" rel="case"><?= $the_case->case_memo ?></textarea>
				</div>
			</fieldset>
			<fieldset>
				<div class="grid_12">
					<button name="case_update" id="case_update"><?= $strings['case.details.btn.save']; ?></button>
					<button name="send_mail" id="send_mail" style="background-color: #ba0034; color: white; float: right;">E-Mail-Aktualisierung senden</button>
				</div>
			</fieldset>
		</form>
		
		<div id="person_edit_dialog" title="Person bearbeiten"><?= $strings['case_details.editPerson']; ?></div>
		<div id="event_edit_dialog" title="Ereignis bearbeiten"><?= $strings['case_details.editEvent']; ?></div>
		<div id="appointment_edit_dialog" title="Termin bearbeiten"><?= $strings['case_details.editAppointment']; ?></div>
		<div id="cost_edit_dialog" title="Kosten bearbeiten"><?= $strings['case_details.editCost']; ?></div>
		
		