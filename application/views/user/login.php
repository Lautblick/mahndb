<div class="grid_4 prefix_4">
<h2>Login</h2>
<? if ($message) : ?>
	<p class="message">
		<?= $message; ?>
	</p>
<? endif; ?>

<?= Form::open('user/login'); ?>

	<p>
		<?= Form::label('username', 'Username'); ?>
		<?= Form::input('username', HTML::chars(Arr::get($_POST, 'username'))); ?>
	</p>

	<p>
		<?= Form::label('password', 'Password'); ?>
		<?= Form::password('password'); ?>
	</p>

	<p>
		<?= Form::submit('login', 'Login'); ?>
	</p>

<?= Form::close(); ?>

<p>Or <?= HTML::anchor('user/create', 'create a new account'); ?></p>
</div>