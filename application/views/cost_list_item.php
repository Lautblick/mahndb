<?php $strings = unserialize(STRINGTABLE);?>
<li class="<?= $cost->id ?>">
	<span class="grid_6"><?= date('d.m.Y', strtotime($cost->cost_date)) ?> (Session: <?= $cost->cost_session ?>) <?= ($cost->cost_file != '')?'<a href="'.$cost->cost_file.'" target="_blank" class="download"><img src="img/icon-file-ffffff.png"/> Anhang</a>':'' ?></span>
	<span class="grid_6 right amount"><?= number_format($cost->cost_amount, 2, ',', '.'); ?> €</span>
	<div class="clear"></div>
	<span class="grid_12 small"><?= $cost->costtype->type_name ?></span>
	<div class="clear"></div>
	</span><button class="cost_edit"><img src="img/icon_pencil.png" alt="icon_pencil" /></button><button class="cost_delete"><img src="img/icon_trash.png" alt="icon_trash" /></button>
</li>