<li class="<?= $event->id ?>">
	<span class="grid_6"><?= $event->eventtype->type_name ?> <?= ($event->event_file != '')?'<a href="'.$event->event_file.'" target="_blank" class="download"><img src="img/icon-file-ffffff.png"/> Anhang</a>':'' ?></span>
	<span class="grid_6 right"><?= date('d.m.Y', strtotime($event->event_date)) ?></span>
	<div class="clear"></div>
	<span class="grid_12 small"><?= $event->event_description ?></span>
	<div class="clear"></div>
	</span><button class="event_edit" href=""><img src="img/icon_pencil.png" alt="icon_pencil" /><!-- </button><button class="event_delete" href=""><img src="img/icon_trash.png" alt="icon_trash" /></button> -->
</li>