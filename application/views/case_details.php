		<form>
			<fieldset>
				<input type="hidden" name="case_id" id="case_id" rel="case" value="<?= $the_case->id ?>" />
				<div class="grid_3"><label for="tenancy_ve">VE-Nr.</label><input type="text" name="tenancy_ve" id="tenancy_ve" rel="case" value="<?= $the_case->tenancy->tenancy_ve ?>" /></div>
				<div class="grid_3"><label for="case_nr">lfd. Klagenummer</label><input type="text" name="case_nr" id="case_nr" disabled="disabled" value="<?= $the_case->case_nr ?>/<?= date('Y', strtotime($the_case->case_created)) ?>" /></div>
				<div class="grid_3"><label for="case_active">Fall aktiv</label><br /><input type="checkbox" name="case_active" id="case_active" rel="case" value="1" <?= ($the_case->case_active == '1')?'checked="checked"':'' ?> /></div>
				<div class="grid_3"><label for="case_followup">Wiedervorlage</label><input type="text" name="case_followup" id="case_followup" rel="case" class="datepicker" value="<?= date('d.m.Y', strtotime($the_case->case_followup)) ?>" /></div>
			</fieldset>
			<fieldset>
				<div class="grid_6">
					<label for="claimants_list">Kläger</label>
					<ul id="claimants_list" class="sublist">
						<?php foreach($the_case->claimants->order_by('person_lastname', 'asc')->find_all() as $claimant):?>
						<li id="<?= $claimant->id; ?>"><a><?= $claimant->person_title.' '.$claimant->person_firstname.' '.$claimant->person_lastname ?><br/><span class="small"><?= $claimant->address->address_street.' '.$claimant->address->address_street_number.', '.$claimant->address->place->id.' '.$claimant->address->place->place_name ?></span></a></span><button class="person_edit" href=""><img src="img/icon_pencil.png" alt="icon_pencil" /><!-- </button><button class="claimant_delete" href=""><img src="img/icon_trash.png" alt="icon_trash" /></button> --></li>
						<?php endforeach;?>
					</ul>
					<div id="claimants_menu" class="menu ui-state-default"><button id="claimant_add_dialog_open"><span class="ui-icon ui-icon-circle-plus"></span>Kläger hinzufügen</button></div>
					<div id="claimant_add_dialog" title="Kläger hinzufügen">
						<div id="claimant_add_tabs"> 
							<ul>
								<li><a href="#claimant_add_1">Suchen</a></li>
								<li><a href="#claimant_add_2">Neu anlegen</a></li>
							</ul>
							<div id="claimant_add_1">
								<div class="container_12">
									<fieldset>
										<div class="grid_12">
											<p>Nutzen Sie das Suchfeld, um nach bestehenden Personen zu suchen.</p>
											<input type="text" name="claimant_search" id="claimant_search" />
										</div>
									</fieldset>
								</div>
							</div>
							<div id="claimant_add_2">
								<div class="container_12">
									<fieldset>
										<div class="grid_2"><label for="person_title">Anrede</label><select name="person_title" id="person_title">
											<option value=""></option>
											<option value="Herr">Herr</option>
											<option value="Frau">Frau</option>
										</select></div>
										<div class="grid_5"><label for="person_firstname">Vorname</label><input type="text" name="person_firstname" id="person_firstname" /></div>
										<div class="grid_5"><label for="person_lastname">Nachname</label><input type="text" name="person_lastname" id="person_lastname" /></div>
									</fieldset>
									<fieldset>
										<div class="grid_10"><label for="address_street">Straße</label><input type="text" name="address_street" id="address_street" /></div>
										<div class="grid_2"><label for="address_street_number">Haus-Nr.</label><input type="text" name="address_street_number" id="address_street_number" /></div>
									</fieldset>
									<fieldset>
										<div class="grid_4"><label for="zipcode">Postleitzahl</label><input type="text" name="zipcode" id="zipcode" /></div>
										<div class="grid_8"><label for="place_name">Ort</label><input type="text" name="place_name" id="place_name" /></div>
									</fieldset>
									<fieldset>
										<div class="grid_4"><label for="address_phone_number">Telefon</label><input type="text" name="address_phone_number" id="address_phone_number" /></div>
										<div class="grid_4"><label for="address_fax_number">Faxnummer</label><input type="text" name="address_fax_number" id="address_fax_number" /></div>
										<div class="grid_4"><label for="address_email">E-Mail</label><input type="text" name="address_email" id="address_email" /></div>
									</fieldset>
									<fieldset>
										<div class="grid_12"><button id="claimant_add">Kläger speichern</button></div>
									</fieldset>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="grid_6">
					<label for="defendants_list">Beklagter</label>
					<ul id="defendants_list" class="sublist">
						<?php foreach($the_case->defendants->order_by('person_lastname', 'asc')->find_all() as $defendant):?>
						<li id="<?= $defendant->id; ?>"><a><?= $defendant->person_title.' '.$defendant->person_firstname.' '.$defendant->person_lastname ?><br/><span class="small"><?= $defendant->address->address_street.' '.$defendant->address->address_street_number.', '.$defendant->address->place->id.' '.$defendant->address->place->place_name ?></span></a></span><button class="person_edit" href=""><img src="img/icon_pencil.png" alt="icon_pencil" /><!-- </button><button class="defendant_delete" href=""><img src="img/icon_trash.png" alt="icon_trash" /></button> --></li>
						<?php endforeach;?>
					</ul>
					<div id="defendants_menu" class="menu ui-state-default"><button id="defendant_add_dialog_open"><span class="ui-icon ui-icon-circle-plus"></span>Beklagten hinzufügen</button></div>
					<div id="defendant_add_dialog" title="Beklagten hinzufügen">
						<div id="defendant_add_tabs"> 
							<ul>
								<li><a href="#defendant_add_1">Suchen</a></li>
								<li><a href="#defendant_add_2">Neu anlegen</a></li>
							</ul>
							<div id="defendant_add_1">
								<div class="container_12">
									<fieldset>
										<div class="grid_12">
											<p>Nutzen Sie das Suchfeld, um nach bestehenden Personen zu suchen.</p>
											<input type="text" name="defendant_search" id="defendant_search" />
										</div>
									</fieldset>
								</div>
							</div>
							<div id="defendant_add_2">
								<div class="container_12">
									<fieldset>
										<div class="grid_2"><label for="person_title">Anrede</label><select name="person_title" id="person_title">
											<option value=""></option>
											<option value="Herr">Herr</option>
											<option value="Frau">Frau</option>
										</select></div>
										<div class="grid_5"><label for="person_firstname">Vorname</label><input type="text" name="person_firstname" id="person_firstname" /></div>
										<div class="grid_5"><label for="person_lastname">Nachname</label><input type="text" name="person_lastname" id="person_lastname" /></div>
									</fieldset>
									<fieldset>
										<div class="grid_10"><label for="address_street">Straße</label><input type="text" name="address_street" id="address_street" /></div>
										<div class="grid_2"><label for="address_street_number">Haus-Nr.</label><input type="text" name="address_street_number" id="address_street_number" /></div>
									</fieldset>
									<fieldset>
										<div class="grid_4"><label for="zipcode">Postleitzahl</label><input type="text" name="zipcode" id="zipcode" /></div>
										<div class="grid_8"><label for="place_name">Ort</label><input type="text" name="place_name" id="place_name" /></div>
									</fieldset>
									<fieldset>
										<div class="grid_4"><label for="address_phone_number">Telefon</label><input type="text" name="address_phone_number" id="address_phone_number" /></div>
										<div class="grid_4"><label for="address_fax_number">Faxnummer</label><input type="text" name="address_fax_number" id="address_fax_number" /></div>
										<div class="grid_4"><label for="address_email">E-Mail</label><input type="text" name="address_email" id="address_email" /></div>
									</fieldset>
									<fieldset>
										<div class="grid_12"><button id="defendant_add">Beklagten speichern</button></div>
									</fieldset>
								</div>
							</div>
						</div>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<div class="grid_9"><label for="case_reason">Klagegrund</label><textarea name="case_reason" id="case_reason" rel="case"><?= $the_case->case_reason ?></textarea></div>
				<div class="grid_3"><label for="case_type">Klageart</label><input type="text" name="case_type" id="case_type" value="<?= $the_case->casetype->type_name ?>"/></div>
			</fieldset>
			<fieldset>
				<div class="grid_6" id="<?= $the_case->cl_lawyer_id; ?>"><label for="cl_lawyer_name">Anwalt</label><br /><input type="text" style="width:80%;" name="cl_lawyer_name" id="cl_lawyer_name" value="<?= $the_case->cl_lawyer->person_title.' '.$the_case->cl_lawyer->person_firstname.' '.$the_case->cl_lawyer->person_lastname ?>" /><button class="person_edit inline"><img src="img/icon_pencil.png" /></button></div>
				<div class="grid_3"><label for="cl_lawye_charged">beauftragt am</label><input type="text" name="cl_lawyer_charged" id="cl_lawyer_charged" rel="case" class="datepicker" value="<?= date('d.m.Y', strtotime($the_case->cl_lawyer_charged)) ?>" /></div>
				<div class="grid_3"><label for="cl_lawyer_ref">Aktenzeichen Anw.</label><input type="text" name="cl_lawyer_ref" id="cl_lawyer_ref" rel="case" value="<?= $the_case->cl_lawyer_ref ?>" /></div>
				<div id="cl_lawyer_add_dialog" title="Anwalt hinzufügen">
					<div id="cl_lawyer_add_tabs"> 
						<ul>
							<li><a href="#cl_lawyer_add_1">Suchen</a></li>
							<li><a href="#cl_lawyer_add_2">Neu anlegen</a></li>
						</ul>
						<div id="cl_lawyer_add_1">
							<div class="container_12">
								<fieldset>
									<div class="grid_12">
										<p>Nutzen Sie das Suchfeld, um nach bestehenden Personen zu suchen.</p>
										<input type="text" name="cl_lawyer_search" id="cl_lawyer_search" />
									</div>
								</fieldset>
							</div>
						</div>
						<div id="cl_lawyer_add_2">
							<div class="container_12">
								<fieldset>
									<div class="grid_2"><label for="person_title">Anrede</label><select name="person_title" id="person_title">
										<option value=""></option>
										<option value="Herr">Herr</option>
										<option value="Frau">Frau</option>
									</select></div>
									<div class="grid_5"><label for="person_firstname">Vorname</label><input type="text" name="person_firstname" id="person_firstname" /></div>
									<div class="grid_5"><label for="person_lastname">Nachname</label><input type="text" name="person_lastname" id="person_lastname" /></div>
								</fieldset>
								<fieldset>
									<div class="grid_10"><label for="address_street">Straße</label><input type="text" name="address_street" id="address_street" /></div>
									<div class="grid_2"><label for="address_street_number">Haus-Nr.</label><input type="text" name="address_street_number" id="address_street_number" /></div>
								</fieldset>
								<fieldset>
									<div class="grid_4"><label for="zipcode">Postleitzahl</label><input type="text" name="zipcode" id="zipcode" /></div>
									<div class="grid_8"><label for="place_name">Ort</label><input type="text" name="place_name" id="place_name" /></div>
								</fieldset>
								<fieldset>
									<div class="grid_4"><label for="address_phone_number">Telefon</label><input type="text" name="address_phone_number" id="address_phone_number" /></div>
									<div class="grid_4"><label for="address_fax_number">Faxnummer</label><input type="text" name="address_fax_number" id="address_fax_number" /></div>
									<div class="grid_4"><label for="address_email">E-Mail</label><input type="text" name="address_email" id="address_email" /></div>
								</fieldset>
								<fieldset>
									<div class="grid_12"><button id="cl_lawyer_add">Anwalt speichern</button></div>
								</fieldset>
							</div>
						</div>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<div class="grid_6" id="<?= $the_case->def_lawyer_id; ?>"><label for="def_lawyer_name">Anwalt Gegenseite</label><br /><input type="text" style="width:80%;" name="def_lawyer_name" id="def_lawyer_name" value="<?= $the_case->def_lawyer->person_title.' '.$the_case->def_lawyer->person_firstname.' '.$the_case->def_lawyer->person_lastname ?>" /><button class="person_edit inline"><img src="img/icon_pencil.png" /></button></div>
				<div class="grid_3"><label for="def_lawyer_ref">Aktenzeichen Anw. Geg.</label><input type="text" name="def_lawyer_ref" id="def_lawyer_ref" rel="case" value="<?= $the_case->def_lawyer_ref ?>" /></div>
				<div id="def_lawyer_add_dialog" title="Anwalt Gegenseite hinzufügen">
					<div id="def_lawyer_add_tabs"> 
						<ul>
							<li><a href="#def_lawyer_add_1">Suchen</a></li>
							<li><a href="#def_lawyer_add_2">Neu anlegen</a></li>
						</ul>
						<div id="def_lawyer_add_1">
							<div class="container_12">
								<fieldset>
									<div class="grid_12">
										<p>Nutzen Sie das Suchfeld, um nach bestehenden Personen zu suchen.</p>
										<input type="text" name="def_lawyer_search" id="def_lawyer_search" />
									</div>
								</fieldset>
							</div>
						</div>
						<div id="def_lawyer_add_2">
							<div class="container_12">
								<fieldset>
									<div class="grid_2"><label for="person_title">Anrede</label><select name="person_title" id="person_title">
										<option value=""></option>
										<option value="Herr">Herr</option>
										<option value="Frau">Frau</option>
									</select></div>
									<div class="grid_5"><label for="person_firstname">Vorname</label><input type="text" name="person_firstname" id="person_firstname" /></div>
									<div class="grid_5"><label for="person_lastname">Nachname</label><input type="text" name="person_lastname" id="person_lastname" /></div>
								</fieldset>
								<fieldset>
									<div class="grid_10"><label for="address_street">Straße</label><input type="text" name="address_street" id="address_street" /></div>
									<div class="grid_2"><label for="address_street_number">Haus-Nr.</label><input type="text" name="address_street_number" id="address_street_number" /></div>
								</fieldset>
								<fieldset>
									<div class="grid_4"><label for="zipcode">Postleitzahl</label><input type="text" name="zipcode" id="zipcode" /></div>
									<div class="grid_8"><label for="place_name">Ort</label><input type="text" name="place_name" id="place_name" /></div>
								</fieldset>
								<fieldset>
									<div class="grid_4"><label for="address_phone_number">Telefon</label><input type="text" name="address_phone_number" id="address_phone_number" /></div>
									<div class="grid_4"><label for="address_fax_number">Faxnummer</label><input type="text" name="address_fax_number" id="address_fax_number" /></div>
									<div class="grid_4"><label for="address_email">E-Mail</label><input type="text" name="address_email" id="address_email" /></div>
								</fieldset>
								<fieldset>
									<div class="grid_12"><button id="def_lawyer_add">Anwalt Gegenseite speichern</button></div>
								</fieldset>
							</div>
						</div>
					</div>
				</div>
				<div class="grid_3"><label for="court_ref">Aktenzeichen Gericht</label><input type="text" name="court_ref" id="court_ref" rel="case" value="<?= $the_case->court_ref ?>" /></div>
			</fieldset>
			<fieldset>
				<div class="grid_12">
					<label for="events_list">Ereignisse</label>
					<ul id="events_list" class="sublist">
						<?php foreach($the_case->events->order_by('event_date', 'asc')->find_all() as $event):?>
						<li class="<?= $event->id ?>">
							<span class="grid_6"><?= $event->eventtype->type_name ?> <?= ($event->event_file != '')?'<a href="'.$event->event_file.'" target="_blank" class="download"><img src="img/icon-file-ffffff.png"/> Anhang</a>':'' ?></span>
							<span class="grid_6 right"><?= date('d.m.Y', strtotime($event->event_date)) ?></span>
							<div class="clear"></div>
							<span class="grid_12 small"><?= $event->event_description ?></span>
							<div class="clear"></div>
							</span><button class="event_edit"><img src="img/icon_pencil.png" alt="icon_pencil" /><!-- </button><button class="event_delete"><img src="img/icon_trash.png" alt="icon_trash" /></button> -->
						</li>
						<?php endforeach;?>
					</ul>
					<div id="events_menu" class="menu ui-state-default"><button id="event_add_dialog_open"><span class="ui-icon ui-icon-circle-plus"></span>Neues Ereignis</button></div>
					<div id="event_add_dialog" title="Neues Ereignis erfassen">
						<div class="container_12">
							<fieldset>
								<div class="grid_6"><label for="event_type">Art des Ereignisses</label><input type="text" name="event_type" id="event_type" /></div>
								<div class="grid_6"><label for="event_date">Datum</label><input type="text" name="event_date" id="event_date" /></div>
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
								<div class="grid_12"><label for="event_description">Beschreibung (optional)</label><textarea name="event_description" id="event_description"></textarea></div>
							</fieldset>
							<fieldset>
								<div class="grid_12"><button id="event_add">Ereignis speichern</button></div>
							</fieldset>
						</div>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<div id="appointments" class="grid_12">
					<label for="appointments_list">Termine</label>
					<ul id="appointments_list" class="sublist">
						<?php foreach($the_case->appointments->order_by('appointment_datetime', 'asc')->find_all() as $appointment):?>
						<li class="<?= $appointment->id ?>">
							<span class="grid_6"><?= date('d.m.Y', strtotime($appointment->appointment_datetime)) ?></span>
							<span class="grid_6 right"><?= date('H:i', strtotime($appointment->appointment_datetime)) ?> Uhr</span>
							<div class="clear"></div>
							<span class="grid_12"><?= $appointment->appointment_location ?></span>
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
								<div class="grid_6"><label for="appointment_date">Datum</label><input type="text" name="appointment_date" id="appointment_date" /></div>
								<div class="grid_3"><label for="appointment_hour">Zeit</label><br/><input type="text" name="appointment_hour" id="appointment_hour" maxlength="2" style="width:30px;" /> : <input type="text" name="appointment_minute" id="appointment_minute" maxlength="2" style="width:30px;" /></div>
							</fieldset>
							<fieldset>
								<label for="appointment_location">Ort</label><input type="text" name="appointment_location" id="appointment_location" />
							</fieldset>
							<fieldset>
								<div class="grid_12"><label for="appointment_description">Beschreibung</label><textarea name="appointment_description" id="appointment_description"></textarea></div>
							</fieldset>
							<fieldset>
								<div class="grid_12"><button id="appointment_add">Termin speichern</button></div>
							</fieldset>
						</div>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<div class="grid_12">
					<label for="costs_list">Kosten</label>
					<div id="costs_tabs"> 
						<ul>
							<li><a href="#costs_list_1">Anwalts-/ Gerichtskosten</a></li>
							<li><a href="#costs_list_2">Klage-/ Streitwert</a></li>
							<li><a href="#costs_list_3">Zinsen</a></li>
						</ul>
						<ul id="costs_list_1" class="sublist">
							<?php 
							$cost_amount = 0;
							foreach($the_case->costs->where('cost_category', '=', '0')->order_by('cost_date', 'asc')->find_all() as $cost):
							$cost_amount = $cost_amount+$cost->cost_amount ?>
							<li class="<?= $cost->id ?>">
								<span class="grid_6"><?= date('d.m.Y', strtotime($cost->cost_date)) ?> <?= ($cost->cost_file != '')?'<a href="'.$cost->cost_file.'" target="_blank" class="download"><img src="img/icon-file-ffffff.png"/> Anhang</a>':'' ?></span>
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
						<ul id="costs_list_2" class="sublist">
							<?php 
							$cost_amount = 0;
							foreach($the_case->costs->where('cost_category', '=', '1')->order_by('cost_date', 'asc')->find_all() as $cost):
							$cost_amount = $cost_amount+$cost->cost_amount ?>
							<li class="<?= $cost->id ?>">
								<span class="grid_6"><?= date('d.m.Y', strtotime($cost->cost_date)) ?> <?= ($cost->cost_file != '')?'<a href="'.$cost->cost_file.'" target="_blank" class="download"><img src="img/icon-file-ffffff.png"/> Anhang</a>':'' ?></span>
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
						<ul id="costs_list_3" class="sublist">
							<?php 
							$cost_amount = 0;
							foreach($the_case->costs->where('cost_category', '=', '2')->order_by('cost_date', 'asc')->find_all() as $cost):
							$cost_amount = $cost_amount+$cost->cost_amount ?>
							<li class="<?= $cost->id ?>">
								<span class="grid_6"><?= date('d.m.Y', strtotime($cost->cost_date)) ?> <?= ($cost->cost_file != '')?'<a href="'.$cost->cost_file.'" target="_blank" class="download"><img src="img/icon-file-ffffff.png"/> Anhang</a>':'' ?></span>
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
					<div id="cost_add_dialog" title="Neue Kosten erfassen">
						<div class="container_12">
							<fieldset>
								<div class="grid_6"><label for="cost_date">Datum</label><input type="text" name="cost_date" id="cost_date" /></div>
								<div class="grid_6"><label for="cost_amount">Betrag</label><input type="text" name="cost_amount" id="cost_amount" /></div>
							</fieldset>
							<fieldset>
								<div class="grid_6"><label for="cost_type">Kostenart</label><input type="text" name="cost_type" id="cost_type" /></div>
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
								<div class="grid_12"><button id="cost_add">Kosten speichern</button></div>
							</fieldset>
						</div>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<div class="grid_12">
					<label for="case_memo">Sonstige Bemerkungen</label>
					<textarea name="case_memo" id="case_memo" rel="case"><?= $the_case->case_memo ?></textarea>
				</div>
			</fieldset>
			<fieldset>
				<div class="grid_12">
					<button name="case_update" id="case_update">Speichern</button>
				</div>
			</fieldset>
		</form>
		
		<div id="person_edit_dialog" title="Person bearbeiten">Person bearbeiten</div>
		<div id="event_edit_dialog" title="Ereignis bearbeiten">Ereignis bearbeiten</div>
		<div id="appointment_edit_dialog" title="Termin bearbeiten">Termin bearbeiten</div>
		<div id="cost_edit_dialog" title="Kosten bearbeiten">Kosten bearbeiten</div>
		
		