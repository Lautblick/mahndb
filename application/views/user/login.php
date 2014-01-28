<div class="grid_4 prefix_4">
<h2><?= $STRINGTABLE['user.login.header'] ?></h2>
<? if ($message) : ?>
	<p class="message">
		<?= $message; ?>
	</p>
<? endif; ?>

<?= Form::open('user/login'); ?>

	<p>
		<?= Form::label('username', $STRINGTABLE['user.login.username']); ?>
		<?= Form::input('username', HTML::chars(Arr::get($_POST, 'username'))); ?>
	</p>

	<p>
		<?= Form::label('password', $STRINGTABLE['user.login.password']); ?>
		<?= Form::password('password'); ?>
	</p>

	<p>
		<?= Form::submit('login', $STRINGTABLE['user.login.btn.login']); ?>
	</p>

<?= Form::close(); ?>

<p>Or <?= HTML::anchor('user/create', $STRINGTABLE['user.login.createUser']); ?></p>
</div>