<?php $strings = unserialize(STRINGTABLE);?>
	
		<form>
			<fieldset>
				<input type="hidden" name="case_id" id="case_id" value="<?= $the_case->id ?>" />
				<div class="grid_3"><label for="case_ve"><?= $strings['case.details.ve'] ?></label><input type="text" name="case_ve" id="case_ve" value="<?= $the_case->tenancy->tenancy_ve ?>" /></div>
				<div class="grid_3"><label for="case_nr"><?= $strings['case.details.nr'] ?></label><input type="text" name="case_nr" id="case_nr" value="<?= $the_case->case_nr ?>" /></div>
				<div class="grid_3">&nbsp;</div>
				<div class="grid_3"><label for="case_followup"><?= $strings['case.details.followup'] ?></label><input type="text" name="case_followup" id="case_followup" class="datepicker" value="<?= $the_case->case_followup ?>" /></div>
			</fieldset>
			<fieldset>
				<div class="grid_6">
					<label for="claimants_list"><?= $strings['case.details.claimants'] ?></label>
					<ul id="claimants_list" class="sublist">
						<?php foreach($the_case->claimants->find_all() as $claimant):?>
						<?php // print_r($claimant); ?>
						<li><a><?= $claimant->person_title.' '.$claimant->person_firstname.' '.$claimant->person_lastname ?><br/><span class="small"><?= $claimant->address->address_street.' '.$claimant->address->address_street_number.', '.$claimant->address->place->id.' '.$claimant->address->place->place_name ?></span></a></li>
						<?php endforeach;?>
					</ul>
					<div id="claimants_menu" class="menu ui-state-default"><button id="claimant_add_dialog_open"><span class="ui-icon ui-icon-circle-plus"></span><?= $strings['case.details.btn.addClaimant'] ?></button></div>
					<div id="claimant_add_dialog" title="<?= $strings['case.details.btn.addClaimant'] ?>">
						<div id="claimant_add_tabs"> 
							<ul>
								<li><a href="#claimant_add_1"><?= $strings['case.details.search'] ?></a></li>
								<li><a href="#claimant_add_2"><?= $strings['case.details.create'] ?></a></li>
							</ul>
							<div id="claimant_add_1">
								<p><?= $strings['case.details.claimantSearchInfo'] ?></p>
								<input type="text" name="claimant_search" id="claimant_search" />
							</div>
							<div id="claimant_add_2">
								<div class="container_12">
									<fieldset>
										<div class="grid_2"><label for="person_title"><?= $strings['case.details.form.title'] ?></label><input type="text" name="person_title" id="person_title" /></div>
										<div class="grid_5"><label for="person_firstname"><?= $strings['case.details.form.firstname'] ?></label><input type="text" name="person_firstname" id="person_firstname" /></div>
										<div class="grid_5"><label for="person_lastname"><?= $strings['case.details.form.lastname'] ?></label><input type="text" name="person_lastname" id="person_lastname" /></div>
									</fieldset>
									<fieldset>
										<div class="grid_10"><label for="address_street"><?= $strings['case.details.form.street'] ?></label><input type="text" name="address_street" id="address_street" /></div>
										<div class="grid_2"><label for="address_street_number"><?= $strings['case.details.form.streetNumber'] ?></label><input type="text" name="address_street_number" id="address_street_number" /></div>
									</fieldset>
									<fieldset>
										<div class="grid_4"><label for="zipcode"><?= $strings['case.details.form.zipcode'] ?></label><input type="text" name="zipcode" id="zipcode" /></div>
										<div class="grid_8"><label for="place_name"><?= $strings['case.details.form.place'] ?></label><input type="text" name="place_name" id="place_name" /></div>
									</fieldset>
									<fieldset>
										<div class="grid_4"><label for="address_phone_number"><?= $strings['case.details.form.phoneNumber'] ?></label><input type="text" name="address_phone_number" id="address_phone_number" /></div>
										<div class="grid_4"><label for="address_fax_number"><?= $strings['case.details.form.faxNumber'] ?></label><input type="text" name="address_fax_number" id="address_fax_number" /></div>
										<div class="grid_4"><label for="address_email"><?= $strings['case.details.form.email'] ?></label><input type="text" name="address_email" id="address_email" /></div>
									</fieldset>
									<fieldset>
										<input type="hidden" name="case_id" id="case_id" value="1" />
										<input type="hidden" name="add_as" id="add_as" value="Claimant" />
										<div class="grid_12"><button><?= $strings['case.details.form.btn.saveClaimant'] ?></button></div>
									</fieldset>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="grid_6">
					<label for="defendants_list"><?= $strings['case.details.defendants'] ?></label>
					<div id="defendants_list" class="sublist"></div>
					<div id="defendants_menu" class="menu ui-state-default"><button><span class="ui-icon ui-icon-circle-plus"></span><?= $strings['case.details.btn.addDefendant'] ?></button></div>
				</div>
			</fieldset>
			<fieldset>
				<div class="grid_9"><label for="case_reason"><?= $strings['case.details.caseReason'] ?></label><textarea name="case_reason" id="case_reason"><?= $the_case->case_reason ?></textarea></div>
				<div class="grid_3"><label for="case_type"><?= $strings['case.details.caseType'] ?></label><input type="text" name="case_type" id="case_type" value="<?= $the_case->casetype->type_name ?>" /></div>
			</fieldset>
			<fieldset>
				<div class="grid_3"><label for="cl_lawyer_name"><?= $strings['case.details.claimantLawyer'] ?></label><input type="text" name="cl_lawyer_name" id="cl_lawyer_name" /></div>
				<div class="grid_3"><label for="cl_lawyer_info_charged"><?= $strings['case.details.claimantCharged'] ?></label><input type="text" name="cl_lawyer_info_charged" id="cl_lawyer_info_charged" class="datepicker" /></div>
				<div class="grid_3"><label for="cl_lawyer_info_ref"><?= $strings['case.details.claimantRef'] ?></label><input type="text" name="cl_lawyer_info_ref" id="cl_lawyer_info_ref" /></div>
			</fieldset>
			<fieldset>
				<div class="grid_3"><label for="def_lawyer_name"><?= $strings['case.details.defendantLawyer'] ?></label><input type="text" name="def_lawyer_name" id="def_lawyer_name" /></div>
				<div class="grid_3"><label for="def_lawyer_info_ref"><?= $strings['case.details.defendantRef'] ?></label><input type="text" name="def_lawyer_info_ref" id="def_lawyer_info_ref" /></div>
			</fieldset>
			<fieldset>
				<div class="grid_12">
					<label for="events_list"><?= $strings['case.details.events'] ?></label>
					<div id="events_list" class="sublist"></div>
					<div id="events_menu" class="menu ui-state-default"><button><span class="ui-icon ui-icon-circle-plus"></span><?= $strings['case.details.btn.addEvent'] ?></button></div>
				</div>
			</fieldset>
			<fieldset>
				<div id="appointments" class="grid_12">
					<label for="appointments_list"><?= $strings['case.details.appointments'] ?></label>
					<div id="appointments_list" class="sublist"></div>
					<div id="appointments_menu" class="menu ui-state-default"><button><span class="ui-icon ui-icon-circle-plus"></span><?= $strings['case.details.btn.addAppointment'] ?></button></div>
				</div>
			</fieldset>
			<fieldset>
				<div class="grid_12">
					<label for="costs_list"><?= $strings['case.details.costs'] ?></label>
					<div id="costs_tabs"> 
						<ul>
							<li><a href="#costs_list_1"><?= $strings['case.details.costsList1'] ?></a></li>
							<li><a href="#costs_list_2"><?= $strings['case.details.costsList2'] ?></a></li>
						</ul>
						<div id="costs_list_1" class="sublist"></div>
						<div id="costs_list_2" class="sublist"></div>
					</div>
					<div id="costs_menu" class="menu ui-state-default"><button><span class="ui-icon ui-icon-circle-plus"></span><?= $strings['case.details.btn.addCosts'] ?></button></div>
				</div>
			</fieldset>
			<fieldset>
				<div class="grid_12">
					<label for="case_memo"><?= $strings['case.details.memo'] ?></label>
					<textarea name="case_memo" id="case_memo"></textarea>
				</div>
			</fieldset>
		</form>
	
