<?php foreach($cases as $case):

$list_class = '';

$followup = strtotime($case->case_followup);
$now = strtotime(date('Y-m-d'));

if ($followup-$now < 345600) {
	$list_class = 'urgent';
}

if($case->case_active == 0) {
	$list_class = 'notactive';
}

?>
<li id="<?= $case->id ?>" class="<?= $list_class ?>">
	<a href="/case/show/<?= $case->id ?>">
		<span class="grid_6">VE-Nr. <?= $case->tenancy->tenancy_ve ?> (<?= $case->case_nr ?>/<?= date('Y', strtotime($case->case_created)) ?>)<br />
		<?= $case->casetype->type_name ?></span>
		<span class="grid_6 right">
		<?php
		$total = 0;
		foreach($case->costs->where('cost_category', '=', 1)->find_all() as $cost):
			$total += $cost->cost_amount;
		endforeach;
		echo number_format($total, 2, ',', '');
		?> €</span>
		<div class="clear"></div>
		<span class="grid_12 small">Kläger: <?php foreach($case->claimants->find_all() as $claimant):?><?=$claimant->person_title.'&nbsp;'.$claimant->person_firstname . '&nbsp;' . $claimant->person_lastname?>, <?php endforeach;?><br />
		Beklagter: <?php foreach($case->defendants->find_all() as $defendant):?><?=$defendant->person_title.'&nbsp;'.$defendant->person_firstname.'&nbsp;'.$defendant->person_lastname?>, <?php endforeach;?></span>
		<div class="clear"></div>
		
		<div style="display:none;">
		<?= $case->cl_lawyer->person_title.' '.$case->cl_lawyer->person_firstname.' '.$case->cl_lawyer->person_lastname; ?>
		<?= $case->def_lawyer->person_title.' '.$case->def_lawyer->person_firstname.' '.$case->def_lawyer->person_lastname; ?>
		<?= $case->court_ref; ?>
		</div>
		
	</a>
</li>
<?php endforeach; ?>