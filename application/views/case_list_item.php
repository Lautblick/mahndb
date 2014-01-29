<?php $strings = unserialize(STRINGTABLE);?>
<?php

$list_class = 'current';

$followup = strtotime($the_case->case_followup);
$now = strtotime(date('Y-m-d'));

if ($followup-$now < 345600) {
	$list_class = 'current urgent';
}

if($the_case->case_active == 0) {
	// $list_class = 'notactive';
	$list_class = 'current';
}

?>
<li id="<?= $the_case->id ?>" class="<?= $list_class ?>">
	<a href="/case/show/<?= $the_case->id ?>">
		<span class="grid_6"><?= $strings['case.details.ve'] ?> <?= $the_case->tenancy->tenancy_ve ?> (<?= $the_case->case_nr ?>/<?= date('Y', strtotime($the_case->case_created)) ?>)<br />
		<?= $the_case->casetype->type_name ?></span>
		<span class="grid_6 right">
		<?php
		$total = 0;
		foreach($the_case->costs->where('cost_category', '=', 1)->find_all() as $cost):
			$total += $cost->cost_amount;
		endforeach;
		echo number_format($total, 2, ',', '');
		?> €</span>
		<div class="clear"></div>
		<span class="grid_12 small">Status: <?= $the_case->status->name ?><br>
		<?= $strings['case.details.claimant'] ?>: <?php foreach($the_case->claimants->find_all() as $claimant):?><?=$claimant->person_title.'&nbsp;'.$claimant->person_firstname . '&nbsp;' . $claimant->person_lastname?>, <?php endforeach;?><br />
		<?= $strings['case.details.defendant'] ?>: <?php foreach($the_case->defendants->find_all() as $defendant):?><?=$defendant->person_title.'&nbsp;'.$defendant->person_firstname.'&nbsp;'.$defendant->person_lastname?>, <?php endforeach;?></span>
		<div class="clear"></div>
		
		<div style="display:none;">
		<?= $the_case->cl_lawyer->person_title.' '.$the_case->cl_lawyer->person_firstname.' '.$the_case->cl_lawyer->person_lastname; ?>
		<?= $the_case->def_lawyer->person_title.' '.$the_case->def_lawyer->person_firstname.' '.$the_case->def_lawyer->person_lastname; ?>
		<?= $the_case->court_ref; ?>
		</div>
		
	</a>
	</span><!-- <button class="case_delete" href=""><img src="img/icon_trash.png" alt="icon_trash" /></button> -->
</li>
