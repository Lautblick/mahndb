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