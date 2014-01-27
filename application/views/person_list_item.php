<li id="<?= $person->id ?>">
	<?= $person->person_title.' '.$person->person_firstname.' '.$person->person_lastname ?><br/>
	<span class="small">
		<?= $person->address->address_street.' '.$person->address->address_street_number.', '.$person->address->place->id.' '.$person->address->place->place_name ?><br>
		Telefon: <?= $person->address->address_phone_number; ?>, Handy: <?= $person->address->address_cellphone; ?>, E-Mail: <?= $person->address->address_email; ?>
	</span>
	<button class="person_edit" href=""><img src="img/icon_pencil.png" alt="icon_pencil" /><!-- </button><button class="<?= substr($add_as, 0, -1) ?>_delete" href=""><img src="img/icon_trash.png" alt="icon_trash" /></button> -->
</li>