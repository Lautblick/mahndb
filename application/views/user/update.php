<?php $strings = unserialize(STRINGTABLE);?>
<div class="col-xs-4">
<div class="well">

<form method="POST" class="form-horizontal">
<div class="page-header">
	<h3><?= $strings['user.update.header'] ?></h3>
</div>
<? if ($message) : ?>
	<div class="alert alert-warning">
		<?= $message; ?>
	</div>
<? endif; ?>

<div class="form-group">
	<label class="col-xs-4"><?= $strings['user.update.username'] ?></label>
	<div class="col-xs-8">
		<input autocomplete="off" type="text" name="username" class="form-control" value="<?= HTML::chars($user->username); ?>">
		<?php if (Arr::get($errors, 'username')) { ?>
			<div class="alert alert-danger">
				<?= Arr::get($errors, 'username'); ?>
			</div>
		<?php } ?>
	</div>
</div>

<div class="form-group">
	<label class="col-xs-4"><?= $strings['user.update.email'] ?></label>
	<div class="col-xs-8">
		<input autocomplete="off" type="email" name="email" class="form-control" value="<?= HTML::chars($user->email); ?>">
		<?php if (Arr::get($errors, 'email')) { ?>
			<div class="alert alert-danger">
				<?= Arr::get($errors, 'email'); ?>
			</div>
		<?php } ?>
	</div>
</div>

<div class="form-group">
	<label class="col-xs-4"><?= $strings['user.update.password'] ?></label>
	<div class="col-xs-8">
		<input autocomplete="off" type="password" name="password" class="form-control">
		<?php if (Arr::path($errors, '_external.password')) { ?>
			<div class="alert alert-danger">
				<?= Arr::path($errors, '_external.password'); ?>
			</div>
		<?php } ?>
	</div>
</div>

<div class="form-group">
	<label class="col-xs-4"><?= $strings['user.update.passwordRepeat'] ?></label>
	<div class="col-xs-8">
		<input autocomplete="off" type="password" name="password_confirm" class="form-control">
		<?php if (Arr::path($errors, '_external.password_confirm')) { ?>
			<div class="alert alert-danger">
				<?= Arr::path($errors, '_external.password_confirm'); ?>
			</div>
		<?php } ?>
	</div>
</div>

<div class="form-group">
	<label for="" class="col-xs-4"><?= $strings['user.update.roles'] ?></label>
	<div class="col-xs-8"><input autocomplete="off" type="checkbox" value="1" name="role_login" <?php if($user->has('roles', ORM::factory('role', array('name' => 'login')))) { echo 'checked="checked"'; }; ?>> Login</div>
	<div class="col-xs-8"><input autocomplete="off" type="checkbox" value="1" name="role_admin" <?php if($user->has('roles', ORM::factory('role', array('name' => 'admin')))) { echo 'checked="checked"'; }; ?>> Admin</div>
</div>

<div class="form-group">
	<label for="" class="col-xs-4"><?= $strings['user.update.commonNotification'] ?></label>
	<div class="col-xs-8"><input autocomplete="off" type="checkbox" value="1" name="common_note" <?php if(HTML::chars($user->common_note) == "1") { echo 'checked="checked"'; }; ?>></div>
</div>

<div class="form-group">
	<label for="" class="col-xs-4"><?= $strings['user.update.evictionNotification'] ?></label>
	<div class="col-xs-8"><input autocomplete="off" type="checkbox" value="1" name="eviction_note" <?php if(HTML::chars($user->eviction_note) == "1") { echo 'checked="checked"'; }; ?>></div>
</div>

<div class="form-group">
<div class="col-xs-8 col-md-offset-4"><input autocomplete="off" type="submit" class="btn btn-primary"></div>
</div>

<?= Form::close(); ?>
</div>
</div>