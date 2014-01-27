<?php
foreach ($upcoming_appointments as $appointment) {
	// $appointment->case = $appointment->case->find();
?>

<li class="<?= $appointment->case->id ?>">
	<a href="/case/show/<?= $appointment->case->id ?>">
		<span class="grid_6">VE-Nr. <?= $appointment->case->tenancy->tenancy_ve ?> (<?= $appointment->case->case_nr ?>/<?= date('Y', strtotime($appointment->case->case_created)) ?>)<br />
		<?= $appointment->case->casetype->type_name ?></span>
		<span class="grid_6 right"><?= date('d.m.Y', strtotime($appointment->appointment_datetime)) ?></span>
		<span class="grid_6 right"><?= date('H:i', strtotime($appointment->appointment_datetime)) ?> Uhr</span>
		<div class="clear"></div>
		<span class="grid_12 small"><?= $appointment->appointment_location ?></span>
		<div class="clear"></div>
		<span class="grid_12 small"><?= $appointment->appointment_description ?></span>
		<div class="clear"></div>
	</a>
</li>

<?php
}
?>